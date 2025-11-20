<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>{{ $templatePage->judul_halaman }} - DISPERUMKIM Kota Bogor</title>
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

    <!-- Breadcrumb -->
    <div class="container-fluid" style="max-width: 1200px; margin: 0 auto; padding: 20px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Berita</li>
            </ol>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="container-fluid" style="max-width: 1200px; margin: 0 auto; padding: 20px;">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="card" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <div class="card-body">
                        @if($templatePage->gambar)
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $templatePage->gambar) }}" alt="{{ $templatePage->judul_content }}" 
                                     class="img-fluid rounded" style="width: 100%; height: 300px; object-fit: cover;">
                            </div>
                        @endif

                        <div class="mb-4">
                            <h1 style="color: #000; font-weight: 600;">{{ $templatePage->judul_content }}</h1>
                        </div>

                        <div class="mb-4" style="line-height: 1.8; font-size: 16px; color: #333;">
                            {!! nl2br(e($templatePage->isi_content)) !!}
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-calendar-alt text-primary me-2"></i>
                                    <span><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($templatePage->tanggal)->format('d F Y') }}</span>
                                </div>
                                @if($templatePage->kategori)
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-tag text-success me-2"></i>
                                        <span><strong>Kategori:</strong> {{ $templatePage->kategori }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card" style="border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <div class="card-header" style="background: #f8f9fa; border-bottom: 2px solid #007bff;">
                        <h5 class="mb-0" style="color: #333; font-weight: bold;">
                            <i class="fas fa-info-circle me-2" style="color: #007bff;"></i>
                            Informasi
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6 style="color: #333; font-weight: 600;">Tanggal Publikasi</h6>
                            <p style="color: #666; margin-bottom: 0;">{{ \Carbon\Carbon::parse($templatePage->tanggal)->format('d F Y') }}</p>
                        </div>

                        @if($templatePage->kategori)
                            <div class="mb-3">
                                <h6 style="color: #333; font-weight: 600;">Kategori</h6>
                                <p style="color: #666; margin-bottom: 0;">{{ $templatePage->kategori }}</p>
                            </div>
                        @endif

                        <div class="mt-4">
                            <a href="{{ route('home') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-home me-1"></i> Kembali ke Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>