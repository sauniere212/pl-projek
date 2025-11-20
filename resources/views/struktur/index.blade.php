<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Struktur Organisasi</title>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <ul>
            <li>
                <a href="{{ url('/') }}"><i class="fa fa-home icon-home"></i></a>
            </li>
            <li class="dropdown">
                <a href="#">Profil <span class="arrow">&#9660;</span></a>
                <div class="dropdown-content">
                    <a href="{{ url('sambutan') }}">Sambutan</a>
                    <a href="{{ url('visi-misi') }}">Visi dan Misi</a>
                    <a href="{{ url('data-pejabat') }}">Data Pejabat</a>
                    <a href="{{ url('struktur') }}">Struktur Organisasi</a>
                </div>
            </li>
            <li>
                <a href="{{ url('berita') }}">Berita</a>
            </li>
            <li>
                <a href="{{ url('dokumen') }}">Dokumen</a>
            </li>
            <li class="dropdown">
                <a href="#">Galeri <span class="arrow">&#9660;</span></a>
                <div class="dropdown-content">
                    <a href="{{ url('galeri-foto') }}">Galeri Foto</a>
                    <a href="{{ url('galeri-video') }}">Galeri Video</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="#">Kontak <span class="arrow">&#9660;</span></a>
                <div class="dropdown-content">
                    <a href="{{ url('kontak') }}">Kontak kami</a>
                    <a href="#">Whatsapp</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="#">Pengaduan <span class="arrow">&#9660;</span></a>
                <div class="dropdown-content">
                    <a href="{{ url('sibadra') }}">SiBadra</a>
                    <a href="#">SP4N Lapor</a>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Carousel Section -->
    <div id="carouselCovid" class="carousel slide" data-bs-ride="carousel" style="margin-top: 10px; margin-bottom: 20px;">
        <div class="carousel-inner">
            @if($carousels->count() > 0)
                @foreach($carousels as $key => $carousel)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $carousel->gambar) }}" class="d-block w-100" alt="{{ $carousel->judul }}" style="height: 400px; object-fit: cover;">
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

    <!-- Struktur Organisasi Content -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Struktur Organisasi</h4>
                    </div>
                    <div class="card-body">
                        @if($strukturs->count() > 0)
                            @foreach($strukturs as $struktur)
                                <div class="text-center mb-4">
                                    <img src="{{ asset('storage/' . $struktur->gambar) }}" alt="Struktur Organisasi" class="img-fluid">
                                </div>
                            @endforeach
                        @else
                            <p class="text-center">Belum ada struktur organisasi yang ditampilkan.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- No additional scripts needed -->
</body>
</html>
