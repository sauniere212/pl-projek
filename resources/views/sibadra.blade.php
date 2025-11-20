<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Sibadra - DISPERUMKIM Kota Bogor</title>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar" id="mainNavbar">
        <ul>
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
            <li><a href="{{ route('berita') }}">Berita</a></li>
            <li><a href="{{ route('dokumen') }}">Dokumen</a></li>
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
        </ul>
    </nav>

    <!-- Carousel Section -->
    <div id="carouselCovid" class="carousel slide" data-bs-ride="carousel" style="margin-top: 10px; margin-bottom: 20px;">
        <div class="carousel-inner" id="carouselInner">
            @if($carousels->count() > 0)
                @foreach($carousels as $index => $carousel)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $carousel->gambar) }}" class="d-block w-100" alt="{{ $carousel->judul }}" style="height: 200px; object-fit: cover;">
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
                <span class="visually-hidden">Selanjutnya</span>
            </button>
        @endif
    </div>

    <!-- Main Content -->
    <div class="container" style="max-width: 1200px; margin: 0 auto;">
        <div class="row">
            <!-- Breadcrumb -->
            <div class="col-12 mb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-primary text-white py-2 px-3">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">HOME</a></li>
                        <li class="breadcrumb-item"><a href="#" class="text-white">PENGADUAN</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">SIBADRA</li>
                    </ol>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">PENGADUAN SIBADRA</h5>
                    </div>
                    <div class="card-body">
                        <h4>Pengaduan SiBadra</h4>
                        <p>SiBadra (Sistem Informasi Berbagi Aduan dan Saran) adalah media bagi Masyarakat Kota Bogor untuk mempermudah dalam menyampaikan pengaduan, saran, dan permintaan layanan publik serta kegawatdaruratan kepada Pemerintah Kota Bogor secara real time.</p>
                        
                        <p class="mt-4">Sampaikan pengaduan atau saran mengenai Pemerintah Kota Bogor melalui link berikut :</p>
                        
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body text-center">
                                            <i class="fab fa-android fa-3x text-success mb-3"></i>
                                            <h5>Android (Google Play)</h5>
                                            <a href="https://play.google.com/store/apps/details?id=com.bogor.aspirasi&hl=en&gl=US" 
                                               target="_blank" 
                                               class="btn btn-success mt-2">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body text-center">
                                            <i class="fab fa-apple fa-3x text-dark mb-3"></i>
                                            <h5>iOS (Apple Store)</h5>
                                            <a href="https://apps.apple.com/id/app/sibadra/id1484986803" 
                                               target="_blank" 
                                               class="btn btn-dark mt-2">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">BERITA TERBARU</h5>
                    </div>
                    <div class="card-body">
                        @foreach($beritas as $berita)
                        <div class="d-flex mb-3 pb-3 border-bottom">
                            @if($berita->foto)
                            <img src="{{ asset('storage/' . $berita->foto) }}" 
                                 class="me-3" 
                                 alt="{{ $berita->judul }}" 
                                 style="width: 64px; height: 64px; object-fit: cover;">
                            @endif
                            <div>
                                <h6 class="mb-1">
                                    <a href="{{ route('berita.show', $berita->id) }}" class="text-dark text-decoration-none">
                                        {{ Str::limit($berita->judul, 50) }}
                                    </a>
                                </h6>
                                <small class="text-muted">
                                    {{ $berita->created_at->format('d/m/Y') }} | {{ $berita->kategori }}
                                </small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Footer -->
    <footer style="background-color: #f8f9fa; padding: 40px 0; margin-top: 50px; border-top: 1px solid #e9ecef;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
            <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 20px;">
                <!-- Link Terkait -->
                <div style="flex: 1 1 300px; min-width: 280px; margin-bottom: 18px;">
                    <b style="font-size: 15px;">Link Terkait</b>
                    <ul style="list-style: none; padding: 0; margin: 16px 0 0 0; color: #444; font-size: 14px; line-height: 1.8;">
                        <li><a href="https://bogorkota.go.id" target="_blank" style="color: #444; text-decoration: none;">Pemerintah Kota Bogor</a></li>
                        <li><a href="https://bogorkota.go.id" target="_blank" style="color: #444; text-decoration: none;">Portal Resmi Kota Bogor</a></li>
                        <li><a href="https://bogorkota.go.id" target="_blank" style="color: #444; text-decoration: none;">Satu Data Kota Bogor</a></li>
                        <li><a href="https://bogorkota.go.id" target="_blank" style="color: #444; text-decoration: none;">Sistem Informasi Kota Bogor</a></li>
                    </ul>
                </div>
                <!-- Kategori Berita -->
                <div style="flex: 1 1 300px; min-width: 280px; margin-bottom: 18px;">
                    <b style="font-size: 15px;">Kategori Berita</b>
                    <ul style="list-style: none; padding: 0; margin: 16px 0 0 0; color: #444; font-size: 14px; line-height: 1.8;">
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
</body>
</html>