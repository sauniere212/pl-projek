<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>DISPERUMKIM Kota Bogor</title>
</head>
<body>
    <nav class="navbar" id="mainNavbar">
        <ul>
            {{-- Hardcode menu --}}
            <li>
                <a href="{{ route('home') }}"><i class="fa fa-home icon-home"></i></a>
            </li>
            <li class="dropdown">
                <a href="#">Profil <span class="arrow">&#9660;</span></a>
                <div class="dropdown-content">
                    <a href="{{ route('sambutan') }}">Sambutan</a>
                    <a href="{{ route('visi-misi') }}">Visi dan Misi</a>
                    <a href="{{ route('data-pejabat') }}">Data Pejabat</a>
                    <a href="{{ route('struktur') }}">Struktur Organisasi</a>
                </div>
            </li>
            <li>
                <a href="{{ route('berita') }}">Berita</a>
            </li>
            <li>
                <a href="{{ route('dokumen') }}">Dokumen</a>
            </li>
            <li class="dropdown">
                <a href="#">Galeri <span class="arrow">&#9660;</span></a>
                <div class="dropdown-content">
                    <a href="{{ route('galeri-foto') }}">Galeri Foto</a>
                    <a href="{{ route('galeri-video') }}">Galeri Video</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="#">Kontak <span class="arrow">&#9660;</span></a>
                <div class="dropdown-content">
                    <a href="{{ route('kontak') }}">Kontak kami</a>
                    <a href="#">Whatsapp</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="#">Pengaduan <span class="arrow">&#9660;</span></a>
                <div class="dropdown-content">
                    <a href="{{ route('sibadra') }}">SiBadra</a>
                    <a href="{{ route('sp4n-lapor') }}">SP4N Lapor</a>
                </div>
            </li>

            {{-- Dynamic menu dari database --}}
            @foreach($navbars as $menu)
                @if($menu->is_dropdown && $menu->sub_menu)
                    <li class="dropdown">
                        <a href="#">{{ $menu->nama }} <span class="arrow">&#9660;</span></a>
                        <div class="dropdown-content">
                            @foreach($menu->sub_menu as $index => $sub)
                                @if($menu->templatePage && $menu->templatePage->slug)
                                    <a href="{{ route('template.show', $menu->templatePage->slug) }}" 
                                       title="Klik untuk melihat halaman template">
                                        <i class="fas fa-file-alt me-1"></i>{{ $sub }}
                                    </a>
                                @else
                                    <a href="#" title="Submenu belum memiliki template">
                                        <i class="fas fa-circle me-1" style="font-size: 0.5em;"></i>{{ $sub }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </li>
                @else
                    @if($menu->templatePage && $menu->templatePage->slug)
                        <li>
                            <a href="{{ route('template.show', $menu->templatePage->slug) }}" 
                               title="Klik untuk melihat halaman template">
                                <i class="fas fa-file-alt me-1"></i>{{ $menu->nama }}
                            </a>
                        </li>
                    @else
                        <li><a href="#" title="Menu belum memiliki template">{{ $menu->nama }}</a></li>
                    @endif
                @endif
            @endforeach
        </ul>
    </nav>

    <!-- Carousel Section -->
    <div id="carouselCovid" class="carousel slide" data-bs-ride="carousel" style="margin-top: 10px; margin-bottom: 20px;">
        <div class="carousel-inner" id="carouselInner">
            @if($carousels->count() > 0)
                @foreach($carousels as $index => $carousel)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ $carousel->image_url }}" class="d-block w-100" alt="{{ $carousel->judul }}" style="height: 200px; object-fit: cover;">
                    </div>
                @endforeach
            @else
                <div class="carousel-item active">
                    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 200px; display: flex; align-items: center; justify-content: center; color: white; text-align: center;">
                        <div>
                            <h3>Selamat Datang di DISPERUMKIM Kota Bogor</h3>
                            <p>Silakan kelola carousel melalui halaman admin</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        @if($carousels->count() > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselCovid" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Sebelumnya</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselCovid" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Berikutnya</span>
            </button>
        @endif
    </div>

    <!-- Sambutan Section (Full Width) -->
    @if($sambutan)
    <div class="container-fluid" style="max-width: 1200px; margin: 0 auto; padding: 20px;">
        <div class="card mb-4" style="border: 1px solid #000; box-shadow: none;">
            <div class="card-body" style="padding: 30px;">
                <div class="row align-items-center">
                    <div class="col-md-3 text-center">
                        @if($sambutan && $sambutan->foto_pejabat)
                            <img src="{{ asset('storage/' . $sambutan->foto_pejabat) }}" alt="Foto Pejabat" 
                                 style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
                        @else
                            <div style="width: 200px; height: 200px; border-radius: 50%; background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); display: flex; flex-direction: column; align-items: center; justify-content: center; margin: 0 auto; color: white; text-align: center; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
                                <i class="fas fa-user-tie fa-4x mb-2"></i>
                                <span style="font-size: 12px; font-weight: bold;">FOTO PEJABAT</span>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-9">
                        <div style="padding: 20px;">
                            <h3 class="mb-2" style="color: #333; font-weight: bold; font-size: 24px;">
                                {{ $sambutan->nama_pejabat ?? 'IR. H. CHUSNUL ROZAQI, M.M' }}
                            </h3>
                            <h5 style="color: #333; font-weight: 600; margin-bottom: 20px; font-size: 16px;">
                                {{ $sambutan->jabatan ?? 'KEPALA DISPERUMKIM KOTA BOGOR' }}
                            </h5>
                            <hr style="border: 1px solid #ddd; margin: 20px 0;">
                            <p style="color: #333; line-height: 1.6; margin-bottom: 20px; font-size: 16px; text-align: left;">
                                <strong>Assalamu'alaikum wr.wb.</strong><br>
                                {{ Str::limit($sambutan->isi_sambutan ?? 'Rasa syukur terbesar selalu terhaturkan kepada Allah SWT, karena nikmat kesehatan dan kesempatan dari-Nya, masyarakat Kota Bogor tetap bersemangat menuju hidup sehat. Selamat datang di situs resmi Website Dinas Perumahan dan Permukiman Kota Bogor. Website Dinas Perumahan dan Permukiman ini memuat Profil Dinas Perumahan dan Permukiman dan informasi terkini seputar program-program unggulan yang telah, sedang dan akan dilaksanakan.', 300) }}
                            </p>
                            <div class="text-left">
                                <a href="{{ route('sambutan') }}" class="btn btn-primary" style="background-color: #007bff; border: none; padding: 10px 20px; border-radius: 5px;">
                                    Lihat Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Main Content Section -->
    <div class="container-fluid" style="max-width: 1200px; margin: 0 auto; padding: 20px;">
        <div class="row">
            <!-- Left Content - News -->
            <div class="col-lg-8">
                <!-- News Section -->
                <div class="card" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <div class="card-header" style="background: #f8f9fa; border-bottom: 2px solid #007bff;">
                        <h5 class="mb-0" style="color: #333; font-weight: bold;">
                            <i class="fas fa-newspaper me-2" style="color: #007bff;"></i>
                            Berita Terbaru
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- News Tabs -->
                        <ul class="nav nav-tabs mb-3" id="newsTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="disperumkim-tab" data-bs-toggle="tab" data-bs-target="#disperumkim" type="button" role="tab">
                                    Berita DISPERUMKIM Kota Bogor
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="kota-tab" data-bs-toggle="tab" data-bs-target="#kota" type="button" role="tab">
                                    Berita Kota Bogor
                                </button>
                            </li>
                        </ul>

                        <!-- News Content -->
                        <div class="tab-content" id="newsTabContent">
                            <div class="tab-pane fade show active" id="disperumkim" role="tabpanel">
                                <div class="row">
                                    @forelse($beritas as $index => $berita)
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100" style="border: 1px solid #e9ecef; transition: transform 0.2s;">
                                            <div style="height: 200px; overflow: hidden;">
                                                @if($berita->gambar)
                                                    <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top" alt="{{ $berita->judul }}" 
                                                         style="height: 100%; object-fit: cover; transition: transform 0.3s;">
                                                @else
                                                    <div style="height: 100%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white;">
                                                        <i class="fas fa-image fa-3x"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="card-body d-flex flex-column">
                                                <h6 class="card-title" style="font-size: 14px; font-weight: bold; color: #000; line-height: 1.4;">
                                                    {{ Str::limit($berita->judul, 60) }}
                                                </h6>
                                                <p class="card-text flex-grow-1" style="font-size: 12px; color: #666; line-height: 1.4;">
                                                    {{ Str::limit(strip_tags($berita->isi), 80) }}
                                                </p>
                                                <div class="mt-auto">
                                                    <small class="text-muted">{{ \Carbon\Carbon::parse($berita->created_at)->format('d M Y') }}</small>
                                                    <a href="{{ route('berita.show', $berita->id) }}" class="btn btn-sm btn-outline-primary float-end" style="font-size: 11px;">
                                                        Baca Selengkapnya
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="col-12 text-center py-4">
                                        <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Belum ada berita tersedia</p>
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="tab-pane fade" id="kota" role="tabpanel">
                                <div class="text-center py-4">
                                    <i class="fas fa-city fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Berita Kota Bogor akan segera hadir</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Galeri Foto Section -->
                <div class="card mt-4" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <div class="card-header" style="background: #f8f9fa; border-bottom: 2px solid #17a2b8;">
                        <h5 class="mb-0" style="color: #333; font-weight: bold;">
                            <i class="fas fa-camera me-2" style="color: #17a2b8;"></i>
                            Foto Terbaru
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @forelse($galeris as $index => $galeri)
                                @if($index < 6) {{-- Tampilkan maksimal 6 foto --}}
                                <div class="col-md-4 mb-3">
                                    <div class="card" style="border: 1px solid #e9ecef; transition: transform 0.2s;">
                                        <div style="height: 150px; overflow: hidden;">
                                            @if($galeri->foto)
                                                <img src="{{ asset('storage/' . $galeri->foto) }}" class="card-img-top" alt="{{ $galeri->judul_album }}" 
                                                     style="height: 100%; object-fit: cover; transition: transform 0.3s;">
                                            @else
                                                <div style="height: 100%; background: linear-gradient(135deg, #17a2b8 0%, #138496 100%); display: flex; align-items: center; justify-content: center; color: white;">
                                                    <i class="fas fa-image fa-2x"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="card-body p-2">
                                            <h6 class="card-title" style="font-size: 12px; font-weight: bold; color: #333; line-height: 1.3;">
                                                {{ Str::limit($galeri->judul_album, 40) }}
                                            </h6>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($galeri->tanggal)->format('d M Y') }}</small>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @empty
                            <div class="col-12 text-center py-4">
                                <i class="fas fa-camera fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada foto tersedia</p>
                            </div>
                            @endforelse
                        </div>
                        @if($galeris->count() > 0)
                        <div class="text-center mt-3">
                            <a href="{{ route('galeri-foto') }}" class="btn btn-outline-info btn-sm">
                                <i class="fas fa-images"></i> Lihat Semua Foto
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Galeri Video Section -->
                <div class="card mt-4" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <div class="card-header" style="background: #f8f9fa; border-bottom: 2px solid #dc3545;">
                        <h5 class="mb-0" style="color: #333; font-weight: bold;">
                            <i class="fas fa-video me-2" style="color: #dc3545;"></i>
                            Video Terbaru
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @forelse($videos as $index => $video)
                                @if($index < 4) {{-- Tampilkan maksimal 4 video --}}
                                <div class="col-md-6 mb-3">
                                    <div class="card video-card" style="border: 1px solid #e9ecef; transition: transform 0.2s; cursor: pointer;" 
                                         data-video-id="{{ $video->video_id }}" data-video-title="{{ $video->judul }}"
                                         onclick="openVideoModal('{{ $video->video_id }}', '{{ $video->judul }}')"
                                         onmouseover="this.style.transform='scale(1.02)'" 
                                         onmouseout="this.style.transform='scale(1)'">
                                        <div style="height: 120px; overflow: hidden; position: relative;">
                                            @if($video->video_id)
                                                <img src="https://img.youtube.com/vi/{{ $video->video_id }}/mqdefault.jpg" 
                                                     alt="{{ $video->judul }}" 
                                                     style="height: 100%; width: 100%; object-fit: cover;">
                                            @else
                                                <div style="height: 100%; background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); display: flex; align-items: center; justify-content: center; color: white;">
                                                    <i class="fas fa-play-circle fa-3x"></i>
                                                </div>
                                            @endif
                                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(0,0,0,0.7); border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-play text-white"></i>
                                            </div>
                                        </div>
                                        <div class="card-body p-2">
                                            <h6 class="card-title" style="font-size: 12px; font-weight: bold; color: #333; line-height: 1.3;">
                                                {{ Str::limit($video->judul, 50) }}
                                            </h6>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($video->tanggal)->format('d M Y') }}</small>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @empty
                            <div class="col-12 text-center py-4">
                                <i class="fas fa-video fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada video tersedia</p>
                            </div>
                            @endforelse
                        </div>
                        @if($videos->count() > 0)
                        <div class="text-center mt-3">
                            <a href="{{ route('galeri-video') }}" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-video"></i> Lihat Semua Video
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="col-lg-4">
                <!-- Calendar Section -->
                <div class="card mb-4" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <div class="card-header" style="background: #f8f9fa; border-bottom: 2px solid #28a745;">
                        <h5 class="mb-0" style="color: #333; font-weight: bold;">
                            <i class="fas fa-calendar-alt me-2" style="color: #28a745;"></i>
                            Kalendar
                        </h5>
                    </div>
                    <div class="card-body">
                        @forelse($calendars as $calendar)
                        <div class="d-flex align-items-center mb-2 p-2" style="background: #f8f9fa; border-radius: 5px;">
                            <div class="me-3">
                                <i class="fas fa-calendar-day text-success"></i>
                            </div>
                            <div>
                                <div style="font-weight: 600; color: #333; font-size: 14px;">{{ $calendar->hari }}, {{ \Carbon\Carbon::parse($calendar->tanggal)->format('d F Y') }}</div>
                                <div style="font-size: 12px; color: #666;">{{ $calendar->kegiatan }}</div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-3">
                            <i class="fas fa-calendar-alt fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">Belum ada agenda calendar</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Agenda Section -->
                <div class="card" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <div class="card-header" style="background: #f8f9fa; border-bottom: 2px solid #ffc107;">
                        <h5 class="mb-0" style="color: #333; font-weight: bold;">
                            <i class="fas fa-tasks me-2" style="color: #ffc107;"></i>
                            Agenda
                        </h5>
                    </div>
                    <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                        @forelse($agendas as $agenda)
                        <div class="mb-3 p-3" style="background: #f8f9fa; border-radius: 8px; border-left: 4px solid #ffc107;">
                            <div style="font-weight: 600; color: #333; font-size: 14px; margin-bottom: 5px;">
                                {{ $agenda->kegiatan }}
                            </div>
                            <div class="d-flex align-items-center mb-1">
                                <i class="fas fa-map-marker-alt text-danger me-2" style="font-size: 12px;"></i>
                                <span style="font-size: 12px; color: #666;">{{ $agenda->tempat }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-clock text-primary me-2" style="font-size: 12px;"></i>
                                <span style="font-size: 12px; color: #666;">
                                    {{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y') }} | {{ \Carbon\Carbon::parse($agenda->waktu)->format('H:i') }}
                                </span>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-3">
                            <i class="fas fa-tasks fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">Belum ada agenda tersedia</p>
                        </div>
                        @endforelse
                        
                        <!-- Instagram Link -->
                        <div class="mt-3 pt-3" style="border-top: 1px solid #e9ecef;">
                            <a href="https://www.instagram.com/disperumkimkotabogor/" target="_blank" class="text-decoration-none d-flex align-items-center">
                                <i class="fab fa-instagram text-danger me-2"></i>
                                <span style="color: #666; font-size: 14px;">Instagram DISPERUMKIM Kota Bogor</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Instagram Feed Section -->
                <div class="card mt-4" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <div class="card-header" style="background: #f8f9fa; border-bottom: 2px solid #e4405f;">
                        <h5 class="mb-0" style="color: #333; font-weight: bold;">
                            <i class="fab fa-instagram me-2" style="color: #e4405f;"></i>
                            Instagram DISPERUMKIM Kota Bogor
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- Instagram Embed -->
                        <div class="instagram-embed">
                            <blockquote class="instagram-media" data-instgrm-permalink="https://www.instagram.com/disperumkimkotabogor/" data-instgrm-version="14" style="background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
                                <div style="padding:16px;">
                                    <a href="https://www.instagram.com/disperumkimkotabogor/" style="background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank">
                                        <div style="display: flex; flex-direction: row; align-items: center;">
                                            <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div>
                                            <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;">
                                                <div style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div>
                                                <div style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div>
                                            </div>
                                        </div>
                                        <div style="padding: 19% 0;"></div>
                                        <div style="display:block; height:50px; margin:0 auto 12px; width:50px;">
                                            <svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <g transform="translate(-511.000000, -20.000000)" fill="#000000">
                                                        <g>
                                                            <path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </div>
                                        <div style="padding-top: 8px;">
                                            <div style="color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this profile on Instagram</div>
                                        </div>
                                        <div style="padding: 12.5% 0;"></div>
                                        <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;">
                                            <div>
                                                <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div>
                                                <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div>
                                                <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div>
                                            </div>
                                            <div style="margin-left: 8px;">
                                                <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div>
                                                <div style="width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div>
                                            </div>
                                            <div style="margin-left: auto;">
                                                <div style="width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div>
                                                <div style="background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div>
                                                <div style="width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div>
                                            </div>
                                        </div>
                                        <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;">
                                            <div style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div>
                                            <div style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div>
                                        </div>
                                        <p style="color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;">
                                            <a href="https://www.instagram.com/disperumkimkotabogor/" style="color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">DISPERUMKIM Kota Bogor (@disperumkimkotabogor)</a>
                                        </p>
                                    </a>
                                </div>
                            </blockquote>
                        </div>
                    </div>
                </div>

                <!-- Banner Section -->
                @if($banners->count() > 0)
                <div class="card mt-4" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <div class="card-header" style="background: #f8f9fa; border-bottom: 2px solid #6f42c1;">
                        <h5 class="mb-0" style="color: #333; font-weight: bold;">
                            <i class="fas fa-image me-2" style="color: #6f42c1;"></i>
                            Banner
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach($banners as $banner)
                        <div class="mb-3">
                            <div class="card" style="border: 1px solid #e9ecef;">
                                @if($banner->gambar)
                                    <img src="{{ asset('storage/' . $banner->gambar) }}" class="card-img-top" alt="{{ $banner->judul }}" 
                                         style="height: 150px; object-fit: cover;">
                                @else
                                    <div style="height: 150px; background: linear-gradient(135deg, #6f42c1 0%, #e83e8c 100%); display: flex; align-items: center; justify-content: center; color: white;">
                                        <i class="fas fa-image fa-3x"></i>
                                    </div>
                                @endif
                                <div class="card-body p-3">
                                    <!-- Hanya menampilkan gambar, tanpa judul, deskripsi, dan urutan -->
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Survey Section -->
                <div class="card mt-4" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <div class="card-header" style="background: #f8f9fa; border-bottom: 2px solid #28a745;">
                        <h5 class="mb-0" style="color: #333; font-weight: bold;">
                            <i class="fas fa-poll me-2" style="color: #28a745;"></i>
                            Survey Kepuasan
                        </h5>
                    </div>
                    <div class="card-body">
                        <a href="https://docs.google.com/forms/d/e/1FAIpQLSeS18zoVWWOSKElmnz8JSIoWO-p_DITkEqJQKktXkJ6eXqj9Q/viewform" target="_blank" class="text-decoration-none">
                            <div class="card" style="border: 1px solid #e9ecef; transition: transform 0.2s; cursor: pointer;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
                                <div style="height: 120px; background: linear-gradient(135deg, #28a745 0%, #20c997 100%); display: flex; align-items: center; justify-content: center; color: white; position: relative; overflow: hidden;">
                                    <!-- Background Pattern -->
                                    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.1;">
                                        <div style="position: absolute; top: 20px; left: 20px; width: 40px; height: 40px; border: 2px solid white; border-radius: 50%;"></div>
                                        <div style="position: absolute; top: 60px; right: 30px; width: 30px; height: 30px; border: 2px solid white; border-radius: 50%;"></div>
                                        <div style="position: absolute; bottom: 20px; left: 50px; width: 25px; height: 25px; border: 2px solid white; border-radius: 50%;"></div>
                                        <div style="position: absolute; bottom: 40px; right: 20px; width: 35px; height: 35px; border: 2px solid white; border-radius: 50%;"></div>
                                    </div>
                                    <!-- Content -->
                                    <div class="text-center">
                                        <i class="fas fa-poll fa-3x mb-2"></i>
                                        <h6 class="mb-1" style="font-weight: bold; font-size: 16px;">Survey Kepuasan Masyarakat</h6>
                                        <p class="mb-0" style="font-size: 12px; opacity: 0.9;">DISPERUMKIM Kota Bogor 2025</p>
                                    </div>
                                </div>
                                <div class="card-body p-3 text-center">
                                    <p class="mb-2" style="color: #666; font-size: 13px; line-height: 1.4;">
                                        Bantu kami meningkatkan kualitas pelayanan dengan mengisi survey kepuasan masyarakat
                                    </p>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <i class="fas fa-external-link-alt me-2" style="color: #28a745; font-size: 12px;"></i>
                                        <span style="color: #28a745; font-size: 12px; font-weight: 600;">Klik untuk Mengisi Survey</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Video Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel">Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="ratio ratio-16x9">
                        <iframe id="videoIframe" src="" title="Video" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script async src="//www.instagram.com/embed.js"></script>
    
    <script>
        function openVideoModal(videoId, videoTitle) {
            const modal = new bootstrap.Modal(document.getElementById('videoModal'));
            const videoIframe = document.getElementById('videoIframe');
            const modalTitle = document.getElementById('videoModalLabel');
            
            // Set video title
            modalTitle.textContent = videoTitle;
            
            // Set video URL
            const videoUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1`;
            videoIframe.src = videoUrl;
            
            // Show modal
            modal.show();
        }
        
        // Clear iframe src when modal is hidden to stop video playback
        document.getElementById('videoModal').addEventListener('hidden.bs.modal', function () {
            document.getElementById('videoIframe').src = '';
        });
    </script>
</body>

<footer style="background: #f7f7f7; border-top: 1px solid #e0e0e0; margin-top: 40px; padding: 36px 0 18px 0; font-family: Arial, sans-serif; font-size: 15px; color: #333;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <div style="display: flex; flex-wrap: wrap; justify-content: space-between; border-bottom: 1px solid #d3d3d3; padding-bottom: 24px;">
                <!-- Pengunjung Website -->
                <div style="flex: 1 1 220px; min-width: 220px; margin-bottom: 18px;">
                    <b style="font-size: 15px;">Pengunjung Website</b>
                    <ul style="list-style: none; padding: 0; margin: 16px 0 0 0; color: #444; font-size: 14px;">
                        <li>Hari Ini : <span>1 Kunjungan</span></li>
                        <li>Bulan Ini : <span>10 Kunjungan</span></li>
                        <li>Bulan Lalu : <span>6 Kunjungan</span></li>
                        <li>Total Kunjungan : <span>10030 Kunjungan</span></li>
                    </ul>
                </div>
                <!-- Kategori Berita -->
                <div style="flex: 1 1 260px; min-width: 220px; margin-bottom: 18px;">
                    <b style="font-size: 15px;">Kategori Berita</b>
                    <ul style="list-style: none; padding: 0; margin: 16px 0 0 0; color: #444; font-size: 14px;">
                        <li>Pemerintah, Pembangunan, dan Pemerintahan</li>
                        <li>Ekonomi, Wisata dan Sosial Masyarakat</li>
                        <li>Kesehatan dan Olahraga</li>
                        <li>Pendidikan</li>
                        <li>Umum</li>
                    </ul>
                </div>
                <!-- DISPERUMKIM Kota Bogor -->
                <div style="flex: 1 1 340px; min-width: 320px; margin-bottom: 18px; border-left: 1px solid #d3d3d3; padding-left: 32px;">
                    <b style="font-size: 15px;">DISPERUMKIM Kota Bogor</b>
                    <div style="margin: 16px 0 18px 0; color: #444; font-size: 14px; line-height: 1.6;">
                        Dinas Perumahan dan Permukiman Kota Bogor merupakan unsur pelaksana pemerintah daerah di bidang Kesatuan Bangsa, Pembinaan Politik dan Kewaspadaan Dini Daerah yang dipimpin oleh seorang Kepala Badan yang berkedudukan dibawah dan bertanggung jawab kepada Walikota melalui Sekretaris Daerah.
                    </div>
                    <b style="font-size: 15px;">Kontak Kami</b>
                    <div style="margin: 12px 0 0 0; color: #444; font-size: 14px;">
                        <div style="margin-bottom: 6px;">
                            <span style="display: inline-block; width: 18px;"><i class="fa fa-map-marker-alt"></i></span>
                            Jl. Pengadilan No.8a, RT.03/RW.01, Pabaton, Kecamatan Bogor Tengah, Kota Bogor
                        </div>
                        <div style="margin-bottom: 6px;">
                            <span style="display: inline-block; width: 18px;"><i class="fa fa-envelope"></i></span>
                            disperumkimkotabgr@gmail.com
                        </div>
                        <div style="margin-bottom: 6px;">
                            <span style="display: inline-block; width: 18px;"><i class="fa fa-phone"></i></span>
                            (0251) 8332775
                        </div>
                        <div style="margin-bottom: 6px;">
                            <span style="display: inline-block; width: 18px;"><i class="fa fa-fax"></i></span>
                            (0251) 8332775
                        </div>
                    </div>
                </div>
            </div>
            <div style="padding-top: 18px; font-size: 14px; color: #888;">
                &copy; 2025 DISPERUMKIM Kota Bogor. All rights reserved.
            </div>
        </div>
    </footer>
</html>
