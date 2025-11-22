<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Sambutan - DISPERUMKIM Kota Bogor</title>
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
            @if(isset($navbars) && $navbars)
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
            @endif
        </ul>
    </nav>

    <!-- Carousel Section -->
    <div id="carouselCovid" class="carousel slide" data-bs-ride="carousel" style="margin-top: 10px; margin-bottom: 20px;">
        <div class="carousel-inner" id="carouselInner">
            @if(isset($carousels) && $carousels->count() > 0)
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
        @if(isset($carousels) && $carousels->count() > 1)
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

    <!-- Sambutan Section -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-4">Sambutan Kepala DISPERUMKIM Kota Bogor</h2>
            </div>
        </div>
        
        @if($sambutan)
            {{-- Sambutan biasa --}}
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body text-center">
                            @if($sambutan && $sambutan->foto_pejabat)
                                <img src="{{ asset('storage/' . $sambutan->foto_pejabat) }}" class="mb-4" alt="{{ $sambutan->nama_pejabat }}" style="width: 200px; height: 200px; border-radius: 8px; object-fit: cover; border: 3px solid #007bff;">
                            @else
                                <div class="mb-4" style="width: 200px; height: 200px; border-radius: 8px; background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); display: flex; flex-direction: column; align-items: center; justify-content: center; margin: 0 auto; border: 3px solid #007bff; color: white; text-align: center;">
                                    <i class="fas fa-user-tie fa-4x mb-2"></i>
                                    <span style="font-size: 12px; font-weight: bold;">FOTO PEJABAT</span>
                                </div>
                            @endif
                            <h4 class="card-title">{{ $sambutan->nama_pejabat }}</h4>
                            <div class="text-start">
                                <h5 class="fw-bold mb-3" style="color: #000;">{{ $sambutan->jabatan }}</h5>
                                {!! nl2br(e($sambutan->isi_sambutan)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-12 text-center">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Belum ada sambutan yang tersedia.
                    </div>
                </div>
            </div>
        @endif
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
