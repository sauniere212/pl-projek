<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>{{ $berita->judul }} - DISPERUMKIM Kota Bogor</title>
    <meta name="description" content="{{ Str::limit(strip_tags($berita->isi), 160) }}">
    <meta name="keywords" content="DISPERUMKIM, Kota Bogor, {{ $berita->kategori }}, {{ $berita->judul }}">
</head>
<body>
    <!-- Navbar -->
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
                            @foreach($menu->sub_menu as $sub)
                                <a href="#">{{ $sub }}</a>
                            @endforeach
                        </div>
                    </li>
                @else
                    <li><a href="#">{{ $menu->nama }}</a></li>
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
                        <img src="{{ $carousel->image_url }}" class="d-block w-100" alt="{{ $carousel->judul }}" style="height: 400px; object-fit: cover;">
                    </div>
                @endforeach
            @else
                <div class="carousel-item active">
                    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 400px; display: flex; align-items: center; justify-content: center; color: white; text-align: center;">
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

    <!-- Breadcrumb -->
    <div class="container" style="margin-bottom: 20px; max-width: 1000px;">
        <nav aria-label="breadcrumb" style="background: #f8f9fa; padding: 10px 15px; border-radius: 5px; border-left: 4px solid #007bff;">
            <ol class="breadcrumb mb-0" style="font-size: 14px;">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" style="text-decoration: none; color: #007bff; font-weight: 500;">
                        <i class="fas fa-home me-1"></i>Beranda
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('berita') }}" style="text-decoration: none; color: #007bff; font-weight: 500;">
                        <i class="fas fa-newspaper me-1"></i>Berita
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page" style="color: #6c757d; font-weight: 500;">
                    <i class="fas fa-tag me-1"></i>{{ $berita->kategori }}
                </li>
            </ol>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="container" style="max-width: 1000px;">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                                 <article class="card" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                     <!-- Article Header - Judul di atas -->
                     <div class="card-header" style="background: #f8f9fa; border-bottom: 2px solid #007bff; padding: 25px;">
                         <h1 class="card-title mb-0" style="color: #333; font-weight: bold; font-size: 1.8rem; line-height: 1.3;">
                             {{ $berita->judul }}
                         </h1>
                     </div>

                     <!-- Article Image -->
                     @if($berita->gambar)
                     <div class="card-img-top" style="height: 400px; overflow: hidden;">
                         @if(str_starts_with($berita->gambar, 'data:'))
                             <img src="{{ $berita->gambar }}" 
                                  alt="{{ $berita->judul }}" 
                                  class="w-100 h-100" 
                                  style="object-fit: cover;">
                         @else
                             <img src="{{ asset('storage/' . $berita->gambar) }}" 
                                  alt="{{ $berita->judul }}" 
                                  class="w-100 h-100" 
                                  style="object-fit: cover;">
                         @endif
                     </div>
                     @endif

                     <!-- Kategori dan Tanggal di bawah gambar -->
                     <div class="card-body" style="padding: 20px 30px 10px 30px;">
                         <div class="d-flex justify-content-between align-items-center mb-3">
                             <span class="badge bg-primary fs-6 px-3 py-2">{{ $berita->kategori }}</span>
                             <small class="text-muted fs-6">
                                 <i class="fas fa-calendar-alt me-1"></i>
                                 {{ \Carbon\Carbon::parse($berita->tanggal)->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
                             </small>
                         </div>
                     </div>

                     <!-- Article Content -->
                     <div class="card-body" style="padding: 10px 30px 30px 30px;">
                         <div class="article-content" style="font-size: 16px; line-height: 1.8; color: #333;">
                             {!! nl2br(e($berita->isi)) !!}
                         </div>
                     </div>

                    <!-- Article Footer -->
                    <div class="card-footer" style="background: #f8f9fa; border-top: 1px solid #e9ecef;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">
                                    <i class="fas fa-user me-1"></i>
                                    Admin DISPERUMKIM Kota Bogor
                                </small>
                            </div>
                            <div>
                                <small class="text-muted">
                                    <i class="fas fa-clock me-1"></i>
                                    Dipublikasikan {{ \Carbon\Carbon::parse($berita->created_at)->locale('id')->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                    </div>
                </article>

                
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Related News -->
                @if($relatedBeritas->count() > 0)
                <div class="card mb-4" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <div class="card-header" style="background: #f8f9fa; border-bottom: 2px solid #28a745;">
                        <h5 class="mb-0" style="color: #333; font-weight: bold;">
                            <i class="fas fa-newspaper me-2" style="color: #28a745;"></i>
                            Berita Terkait
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach($relatedBeritas as $relatedBerita)
                        <div class="mb-3 pb-3" style="border-bottom: 1px solid #e9ecef;">
                            <div class="d-flex">
                                                                 @if($relatedBerita->gambar)
                                 <div class="flex-shrink-0 me-3">
                                     @if(str_starts_with($relatedBerita->gambar, 'data:'))
                                         <img src="{{ $relatedBerita->gambar }}" 
                                              alt="{{ $relatedBerita->judul }}" 
                                              style="width: 80px; height: 60px; object-fit: cover; border-radius: 5px;">
                                     @else
                                         <img src="{{ asset('storage/' . $relatedBerita->gambar) }}" 
                                              alt="{{ $relatedBerita->judul }}" 
                                              style="width: 80px; height: 60px; object-fit: cover; border-radius: 5px;">
                                     @endif
                                 </div>
                                 @endif
                                <div class="flex-grow-1">
                                    <h6 class="mb-1" style="font-size: 14px; line-height: 1.4;">
                                        <a href="{{ route('berita.show', $relatedBerita->id) }}" 
                                           style="text-decoration: none; color: #333; font-weight: 600;">
                                            {{ Str::limit($relatedBerita->judul, 60) }}
                                        </a>
                                    </h6>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ \Carbon\Carbon::parse($relatedBerita->tanggal)->format('d M Y') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
