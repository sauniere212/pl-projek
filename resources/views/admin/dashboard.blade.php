<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin - DISPERUMKIM Kota Bogor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body class="admin-body">
    <!-- Header Admin -->
    <div class="admin-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2><i class="fas fa-tachometer-alt"></i> Dashboard Admin</h2>
                    <p class="mb-0">DISPERUMKIM Kota Bogor</p>
                </div>
                <div class="col-md-6 text-end">
                    <span class="me-3">Selamat datang, <strong>{{ Auth::user()->name }}</strong></span>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn"
                            style="background: none; border: none; color: inherit;">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="admin-nav">
        <div class="container">
            <ul class="nav nav-pills py-3" id="adminTabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#dashboard" onclick="showSection('dashboard')">
                        <i class="fas fa-chart-bar"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#profile" onclick="showSection('profile')">
                        <i class="fas fa-newspaper"></i> Kelola Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#berita" onclick="showSection('berita')">
                        <i class="fas fa-newspaper"></i> Kelola Berita
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#galeri" onclick="showSection('galeri')">
                        <i class="fas fa-images"></i> Kelola Galeri
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#carousel" onclick="showSection('carousel')">
                        <i class="fas fa-sliders-h"></i> Kelola Carousel
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#navbar" onclick="showSection('navbar')">
                        <i class="fas fa-bars"></i> Kelola Menu
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#dokumen" onclick="showSection('dokumen')">
                        <i class="fas fa-file-alt"></i> Kelola Dokumen
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#calendar" onclick="showSection('calendar')">
                        <i class="fas fa-calendar-alt"></i> Kelola Calendar
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#agenda" onclick="showSection('agenda')">
                        <i class="fas fa-tasks"></i> Kelola Agenda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#banner" onclick="showSection('banner')">
                        <i class="fas fa-image"></i> Kelola Banner
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#struktur" onclick="showSection('struktur')">
                        <i class="fas fa-sitemap"></i> Kelola Struktur Organisasi
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Dashboard Section -->
        <div id="dashboard" class="content-section active">
            <div class="row">
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="stats-number" id="totalBerita">{{ $totalBerita ?? 0 }}</div>
                        <div>Total Berita</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card" style="background: linear-gradient(135deg, #f093fb, #f5576c);">
                        <div class="stats-number" id="totalGaleri">{{ $totalGaleri ?? 0 }}</div>
                        <div>Total Foto</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card" style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
                        <div class="stats-number" id="totalCarousel">{{ $totalCarousel ?? 0 }}</div>
                        <div>Slider</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card" style="background: linear-gradient(135deg, #43e97b, #38f9d7);">
                        <div class="stats-number" id="totalDokumen">{{ $totalDokumen ?? 0 }}</div>
                        <div>Total Dokumen</div>
                    </div>
                </div>
            </div>

                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chart-line"></i> Aktivitas Terbaru
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush" id="aktivitasTerbaru">
                            @forelse(($activities ?? []) as $activity)
                                @php
                                    $badgeClass = match ($activity->action) {
                                        'menambahkan' => 'success',
                                        'memperbarui' => 'warning',
                                        'menghapus' => 'danger',
                                        default => 'secondary',
                                    };
                                @endphp
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $activity->description }}</strong>
                                        <br>
                                        <small class="text-muted">
                                            {{ $activity->module }} •
                                            {{ $activity->created_at?->timezone('Asia/Jakarta')->format('d M Y H:i') }}
                                        </small>
                                    </div>
                                    <span class="badge bg-{{ $badgeClass }} rounded-pill text-capitalize">
                                        {{ $activity->action }}
                                    </span>
                                </div>
                            @empty
                                <div class="list-group-item text-center text-muted">
                                    Belum ada aktivitas tercatat.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
        </div>

        <!-- Kelola Profile Section -->
        <div id="profile" class="content-section">
            <!-- Sub-tabs untuk Profile -->
            <div class="row mb-3">
                <div class="col-12">
                    <ul class="nav nav-pills nav-fill" id="profileTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="sambutan-tab" data-bs-toggle="pill" data-bs-target="#sambutan" type="button" role="tab" aria-controls="sambutan" aria-selected="true">
                                <i class="fas fa-user-edit me-2"></i>Kelola Sambutan
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="visi-misi-tab" data-bs-toggle="pill" data-bs-target="#visi-misi" type="button" role="tab" aria-controls="visi-misi" aria-selected="false">
                                <i class="fas fa-eye me-2"></i>Kelola Visi Misi
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pejabat-tab" data-bs-toggle="pill" data-bs-target="#pejabat" type="button" role="tab" aria-controls="pejabat" aria-selected="false">
                                <i class="fas fa-users me-2"></i>Kelola Data Pejabat
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Tab Content -->
            <div class="tab-content" id="profileTabContent">
                <!-- Sambutan Tab -->
                <div class="tab-pane fade show active" id="sambutan" role="tabpanel" aria-labelledby="sambutan-tab">
                    <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header"
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                            <i class="fas fa-user-edit"></i> Kelola Sambutan
                        </div>
                        <div class="card-body">
                            <form id="formProfile" action="{{ route('admin.sambutan.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Nama Pejabat</label>
                                    <input type="text" id="namaPejabat" name="nama_pejabat" class="form-control" value="{{ $sambutan->nama_pejabat ?? '' }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jabatan</label>
                                    <input type="text" id="jabatan" name="jabatan" class="form-control" value="{{ $sambutan->jabatan ?? '' }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Foto Pejabat</label>
                                    <input type="file" id="fotoPejabat" name="foto_pejabat" class="form-control" accept="image/*">
                                    @if($sambutan && $sambutan->foto_pejabat)
                                        <small class="text-muted">Foto saat ini: {{ $sambutan->foto_pejabat }}</small>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Isi Sambutan</label>
                                    <textarea id="isiProfile" name="isi_sambutan" class="form-control" rows="8" required>{{ $sambutan->isi_sambutan ?? '' }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-save"></i> Simpan Sambutan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header"
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                            <i class="fas fa-eye"></i> Preview Sambutan
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-bold mb-0">Sambutan Kepala DISPERKIM Kota Bogor</h5>
                            </div>
                            <div id="previewSambutan" class="mt-3">
                                @if ($sambutan)
                                    <p>{!! nl2br(e($sambutan->isi_sambutan)) !!}</p>
                                @else
                                    <p class="text-muted">Teks sambutan akan muncul di sini...</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                    </div>
                </div>
                
                <!-- Visi Misi Tab -->
                <div class="tab-pane fade" id="visi-misi" role="tabpanel" aria-labelledby="visi-misi-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                    <h5 class="mb-0"><i class="fas fa-eye me-2"></i>Kelola Visi Misi</h5>
                                </div>
                                <div class="card-body">
                                    <form id="visiMisiForm">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="visi" class="form-label">Visi</label>
                                            <textarea class="form-control" id="visi" name="visi" rows="3" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="misi" class="form-label">Misi</label>
                                            <textarea class="form-control" id="misi" name="misi" rows="5" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tujuan_strategis" class="form-label">Tujuan Strategis</label>
                                            <textarea class="form-control" id="tujuan_strategis" name="tujuan_strategis" rows="5"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Simpan Visi Misi
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                    <h5 class="mb-0"><i class="fas fa-eye me-2"></i>Preview Visi Misi</h5>
                                </div>
                                <div class="card-body">
                                    <div id="visiMisiPreview">
                                        <div class="text-center text-muted">
                                            <i class="fas fa-eye fa-3x mb-3"></i>
                                            <p>Preview visi misi akan muncul di sini...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pejabat Tab -->
                <div class="tab-pane fade" id="pejabat" role="tabpanel" aria-labelledby="pejabat-tab">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                    <h5 class="mb-0"><i class="fas fa-users me-2"></i>Kelola Data Pejabat</h5>
                                </div>
                                <div class="card-body">
                                    <form id="pejabatForm">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Pejabat</label>
                                            <input type="text" class="form-control" id="nama" name="nama" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="jabatan" class="form-label">Jabatan</label>
                                            <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="urutan" class="form-label">Urutan</label>
                                            <input type="number" class="form-control" id="urutan" name="urutan" min="1" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="foto" class="form-label">Foto Pejabat</label>
                                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                                        </div>
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-save me-2"></i>Simpan Data Pejabat
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card">
                                <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                    <h5 class="mb-0"><i class="fas fa-list me-2"></i>Daftar Pejabat</h5>
                                </div>
                                <div class="card-body">
                                    <div id="pejabatList">
                                        <div class="text-center text-muted">
                                            <i class="fas fa-users fa-3x mb-3"></i>
                                            <p>Data pejabat akan muncul di sini...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kelola Berita Section -->
        <div id="berita" class="content-section">
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-plus-circle"></i> Tambah Berita Baru
                        </div>
                        <div class="card-body">
                            <form id="formBerita" action="{{ route('admin.berita.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Judul Berita</label>
                                    <input type="text" id="judulBerita" name="judul" class="form-control"
                                        placeholder="Masukkan judul berita" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kategori</label>
                                    <input type="text" id="kategoriBerita" name="kategori" class="form-control"
                                        placeholder="Masukkan kategori berita" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal</label>
                                    <input type="date" id="tanggalBerita" name="tanggal" class="form-control"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Gambar Berita</label>
                                    <input type="file" id="gambarBerita" name="gambar" class="form-control"
                                        accept="image/*" onchange="previewImage(this, 'beritaPreview')">
                                    <div class="mt-2">
                                        <img id="beritaPreview" class="image-preview" style="display: none;">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Isi Berita</label>
                                    <textarea id="isiBerita" name="isi" class="form-control" rows="5"
                                        placeholder="Tulis isi berita di sini..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-save"></i> Simpan Berita
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-list"></i> Daftar Berita
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Gambar</th>
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabelBerita">
                                        @forelse($beritas as $berita)
                                            <tr>
                                                <td>
                                                    @if ($berita->gambar)
                                                        <img src="{{ asset('storage/' . $berita->gambar) }}"
                                                            class="image-preview">
                                                    @else
                                                        <span class="text-muted">No Image</span>
                                                    @endif
                                                </td>
                                                <td>{{ $berita->judul }}</td>
                                                <td><span class="badge bg-primary">{{ $berita->kategori }}</span></td>
                                                <td>{{ $berita->tanggal }}</td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <button class="btn btn-sm btn-warning"
                                                            onclick="editBerita({{ $berita->id }})"
                                                            title="Edit Berita">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <form action="{{ route('admin.berita.destroy', $berita->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" 
                                                                class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')"
                                                                title="Hapus Berita">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Belum ada berita</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kelola Galeri Section -->
        <div id="galeri" class="content-section">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-camera"></i> Upload Foto Galeri
                        </div>
                        <div class="card-body">
                            <form id="formGaleri" action="{{ route('admin.galeri.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Judul Album</label>
                                    <input type="text" id="judulAlbum" name="judul_album" class="form-control"
                                        placeholder="Masukkan judul album" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea id="deskripsiGaleri" name="deskripsi" class="form-control" rows="3" placeholder="Deskripsi foto..."
                                        required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal</label>
                                    <input type="date" id="tanggalGaleri" name="tanggal" class="form-control"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Upload Foto</label>
                                    <input type="file" id="fotoGaleri" name="foto" class="form-control"
                                        accept="image/*" onchange="previewImage(this, 'galeriPreview')" required>
                                    <div class="mt-2">
                                        <img id="galeriPreview" class="image-preview" style="display: none;">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-upload"></i> Upload Foto
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-images"></i> Galeri Foto
                        </div>
                        <div class="card-body">
                            <div class="row" id="galeriContainer">
                                @forelse($galeris as $galeri)
                                    <div class="col-md-4 mb-3">
                                        <div class="card photo-item-card">
                                            <img src="{{ asset('storage/' . $galeri->foto) }}"
                                                class="card-img-top photo-thumbnail"
                                                style="height: 150px; object-fit: cover;">
                                            <div class="card-body p-3">
                                                <h6 class="card-title mb-1 fw-bold">{{ $galeri->judul_album }}</h6>
                                                <p class="card-text small text-muted mb-1">{{ $galeri->deskripsi }}
                                                </p>
                                                <small class="text-muted"><i
                                                        class="fas fa-calendar-alt me-1"></i>{{ $galeri->tanggal }}</small>
                                                <div class="mt-3">
                                                    <div class="d-flex justify-content-end gap-2">
                                                        <button class="btn btn-outline-primary btn-sm photo-action-btn"
                                                            onclick="editGaleri({{ $galeri->id }})"
                                                            title="Edit Foto">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <form
                                                            action="{{ route('admin.galeri.destroy', $galeri->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Yakin ingin menghapus galeri ini?')"
                                                                title="Hapus Galeri">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center text-muted py-4">
                                        <i class="fas fa-images fa-2x mb-2 d-block"></i>
                                        Belum ada foto di galeri
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video Upload Section -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-video"></i> Upload Video Galeri
                        </div>
                        <div class="card-body">
                            <form id="formVideo" action="{{ route('admin.video.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Judul Video</label>
                                    <input type="text" id="judulVideo" name="judul" class="form-control"
                                        placeholder="Masukkan judul video" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Link YouTube</label>
                                    <input type="url" id="linkVideo" name="link_youtube" class="form-control"
                                        placeholder="https://www.youtube.com/watch?v=..." required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea id="deskripsiVideo" name="deskripsi" class="form-control" rows="3"
                                        placeholder="Deskripsi video..."></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal</label>
                                    <input type="date" id="tanggalVideo" name="tanggal" class="form-control"
                                        required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-upload"></i> Upload Video
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-video"></i> Galeri Video
                        </div>
                        <div class="card-body">
                            <div id="videoContainer">
                                @forelse($videos as $video)
                                    <div class="card mb-3 video-item-card">
                                        <div class="card-body p-3">
                                            <div class="row align-items-center">
                                                <div class="col-md-3">
                                                    <img src="https://img.youtube.com/vi/{{ $video->video_id }}/mqdefault.jpg"
                                                        class="img-fluid rounded video-thumbnail"
                                                        alt="{{ $video->judul }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 class="card-title mb-1 fw-bold">{{ $video->judul }}</h6>
                                                    <p class="card-text small text-muted mb-1">{{ $video->deskripsi }}
                                                    </p>
                                                    <small class="text-muted"><i
                                                            class="fas fa-calendar-alt me-1"></i>{{ $video->tanggal }}</small>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="d-flex justify-content-end gap-2">
                                                        <button class="btn btn-outline-primary btn-sm video-action-btn"
                                                            onclick="editVideo({{ $video->id }})"
                                                            title="Edit Video">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <form action="{{ route('admin.video.destroy', $video->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Yakin ingin menghapus video ini?')"
                                                                title="Hapus Video">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center text-muted py-4">
                                        <i class="fas fa-video fa-2x mb-2 d-block"></i>
                                        Belum ada video di galeri
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kelola Carousel Section -->
        <div id="carousel" class="content-section">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-sliders-h"></i> Upload Gambar Carousel
                        </div>
                        <div class="card-body">
                            <form id="formCarousel" action="{{ route('admin.carousel.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Upload Gambar Carousel</label>
                                    <input type="file" id="gambarCarousel" name="gambar" class="form-control"
                                        accept="image/*" onchange="previewImage(this, 'carouselPreview')" required>
                                    <small class="text-muted">Ukuran yang disarankan: 1200x400px</small>
                                    <div class="mt-2">
                                        <img id="carouselPreview" class="image-preview"
                                            style="display: none; max-width: 100%;">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Urutan</label>
                                    <select id="urutanSlide" name="urutan" class="form-control" required>
                                        <option value="">Pilih Urutan</option>
                                        <option value="1">Slide 1 (Pertama)</option>
                                        <option value="2">Slide 2</option>
                                        <option value="3">Slide 3</option>
                                        <option value="4">Slide 4</option>
                                        <option value="5">Slide 5</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-plus"></i> Tambah ke Carousel
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-list"></i> Daftar Gambar Carousel
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Preview</th>
                                            <th>Urutan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabelCarousel">
                                        @forelse($carousels as $carousel)
                                            <tr>
                                                <td><img src="{{ $carousel->image_url }}" class="image-preview"
                                                        style="max-width: 100px; height: auto;"></td>
                                                <td><span class="badge bg-primary">{{ $carousel->urutan }}</span></td>
                                                <td><span class="badge bg-success">{{ $carousel->status }}</span></td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <button class="btn btn-sm btn-warning"
                                                            onclick="editCarousel({{ $carousel->id }})"
                                                            title="Edit Carousel">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <form
                                                            action="{{ route('admin.carousel.destroy', $carousel->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Yakin ingin menghapus carousel ini?')"
                                                                title="Hapus Carousel">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Belum ada gambar carousel</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kelola Navbar Section -->
        <div id="navbar" class="content-section">
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-plus-circle"></i> Tambah Menu Navbar
                        </div>
                        <div class="card-body">
                            <form id="formNavbar" action="{{ route('admin.navbar.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="edit_id" value="">
                                <input type="hidden" name="navbar_id_for_template" id="navbarIdForTemplate" value="">
                                <div class="mb-3">
                                    <label class="form-label">Nama Menu</label>
                                    <input type="text" id="namaMenu" name="nama" class="form-control"
                                        placeholder="Masukkan nama menu" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Dropdown Menu</label>
                                    <div id="dropdownInputs"></div>
                                    <button type="button" class="btn btn-sm btn-success mt-2"
                                        onclick="addDropdownInput()">+ Tambah Dropdown</button>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Urutan</label>
                                    <select id="urutanMenu" name="urutan" class="form-control" required>
                                        <option value="">Pilih Urutan</option>
                                        <option value="1">Urutan 1</option>
                                        <option value="2">Urutan 2</option>
                                        <option value="3">Urutan 3</option>
                                        <option value="4">Urutan 4</option>
                                        <option value="5">Urutan 5</option>
                                        <option value="6">Urutan 6</option>
                                        <option value="7">Urutan 7</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-save"></i> Simpan Menu
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-list"></i> Daftar Menu Navbar
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama Menu</th>
                                            <th>Dropdown Menu</th>
                                            <th>Urutan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabelNavbar">
                                        @forelse($navbars as $navbar)
                                            <tr>
                                                <td>{{ $navbar->nama }}</td>
                                                @php
                                                    $subMenu = $navbar->sub_menu;
                                                    $subMenuList = is_array($subMenu)
                                                        ? $subMenu
                                                        : (filled($subMenu) ? [$subMenu] : []);
                                                @endphp
                                                <td>{{ filled($subMenuList) ? implode(', ', $subMenuList) : '-' }}
                                                </td>
                                                <td style="text-align: center;">{{ $navbar->urutan }}</td>
                                                <td style="text-align: center;">
                                                    <div class="d-flex gap-1 justify-content-center">
                                                        <button class="btn btn-sm btn-warning"
                                                            onclick="editMenuNavbar({{ $navbar->id }})"
                                                            title="Edit Menu">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <form action="{{ route('admin.navbar.destroy', $navbar->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Yakin ingin menghapus menu ini?')"
                                                                title="Hapus Menu">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Belum ada menu navbar</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kelola Dokumen Section -->
        <div id="dokumen" class="content-section">
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-plus-circle"></i> Tambah Dokumen Baru
                        </div>
                        <div class="card-body">
                            <form id="formDokumen" action="{{ route('admin.dokumen.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Nama Dokumen</label>
                                    <input type="text" id="namaDokumen" name="nama" class="form-control"
                                        placeholder="Masukkan nama dokumen" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Keterangan/Tentang</label>
                                    <textarea id="keteranganDokumen" name="keterangan" class="form-control" rows="3"
                                        placeholder="Deskripsi dokumen..." required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kategori</label>
                                    <input type="text" id="kategoriDokumen" name="kategori" class="form-control"
                                        placeholder="Masukkan kategori dokumen" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Upload File</label>
                                    <input type="file" id="fileDokumen" name="file" class="form-control"
                                        accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" required
                                        onchange="previewFile(this)">
                                    <small class="text-muted">Format yang didukung: PDF, DOC, DOCX, XLS, XLSX, PPT,
                                        PPTX (Maksimal 10MB)</small>
                                    <div id="filePreview" class="mt-2" style="display: none;">
                                        <div class="alert alert-info p-2">
                                            <i class="fas fa-file-alt me-2"></i>
                                            <span id="fileName"></span>
                                            <small class="d-block text-muted" id="fileSize"></small>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-upload"></i> Upload Dokumen
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="card dokumen-table-card">
                        <div class="card-header dokumen-header">
                            <i class="fas fa-list"></i> Daftar Dokumen
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover dokumen-table mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 60px;">No.</th>
                                            <th style="width: 200px;">Nama Dokumen</th>
                                            <th>Keterangan/Tentang</th>
                                            <th style="width: 120px;">Kategori</th>
                                            <th style="width: 200px;">File</th>
                                            <th class="text-center" style="width: 120px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabelDokumen">
                                        @forelse($dokumens as $index => $dokumen)
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td>
                                                    <div class="dokumen-name">{{ $dokumen->nama }}</div>
                                                </td>
                                                <td>
                                                    <div class="dokumen-description">{{ $dokumen->keterangan }}</div>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge kategori-badge">{{ $dokumen->kategori }}</span>
                                                </td>
                                                <td>
                                                    <div class="file-info">
                                                        <div class="file-name">{{ basename($dokumen->file) }}</div>
                                                        <a href="{{ asset('storage/' . $dokumen->file) }}"
                                                            download="{{ basename($dokumen->file) }}"
                                                            class="btn btn-sm download-btn">
                                                            <i class="fas fa-download"></i> Download
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex gap-1 justify-content-center">
                                                        <button class="btn btn-sm btn-warning"
                                                            onclick="editDokumen({{ $dokumen->id }})"
                                                            title="Edit Dokumen">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <form
                                                            action="{{ route('admin.dokumen.destroy', $dokumen->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Yakin ingin menghapus dokumen ini?')"
                                                                title="Hapus Dokumen">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-4">
                                                    <i class="fas fa-file-alt fa-2x mb-2 d-block"></i>
                                                    Data dokumen belum tersedia.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kelola Calendar Section -->
        <div id="calendar" class="content-section">
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-calendar-alt"></i> Tambah Kegiatan Calendar
                        </div>
                        <div class="card-body">
                            <form id="formCalendar" action="{{ route('admin.calendar.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Hari</label>
                                    <select id="hariCalendar" name="hari" class="form-control" required>
                                        <option value="">Pilih Hari</option>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                        <option value="Minggu">Minggu</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal</label>
                                    <input type="date" id="tanggalCalendar" name="tanggal" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kegiatan</label>
                                    <textarea id="kegiatanCalendar" name="kegiatan" class="form-control" rows="3" placeholder="Masukkan kegiatan..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-plus"></i>  Tambah Kegiatan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="card calendar-table-card">
                        <div class="card-header calendar-header">
                            <i class="fas fa-list"></i> Daftar Kegiatan Calendar
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover calendar-table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 100px;">Hari</th>
                                            <th style="width: 120px;">Tanggal</th>
                                            <th>Kegiatan</th>
                                            <th class="text-center" style="width: 120px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabelCalendar">
                                        @forelse($calendars as $index => $calendar)
                                            <tr>
                                                <td>{{ $calendar->hari }}</td>
                                                <td>{{ \Carbon\Carbon::parse($calendar->tanggal)->format('d M Y') }}</td>
                                                <td>{{ $calendar->kegiatan }}</td>
                                                <td class="text-center">
                                                    <div class="d-flex gap-1 justify-content-center">
                                                        <button class="btn btn-sm btn-warning" 
                                                            onclick="editCalendar({{ $calendar->id }})"
                                                            title="Edit Calendar">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <form action="{{ route('admin.calendar.destroy', $calendar->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" 
                                                                class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Yakin ingin menghapus calendar ini?')"
                                                                title="Hapus Calendar">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted py-4">
                                                    <i class="fas fa-calendar-alt fa-2x mb-2 d-block"></i>
                                                    Data calendar belum tersedia.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kelola Agenda Section -->
        <div id="agenda" class="content-section">
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-tasks"></i> Tambah Agenda
                        </div>
                        <div class="card-body">
                            <form id="formAgenda" action="{{ route('admin.agenda.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Kegiatan</label>
                                    <input type="text" id="kegiatanAgenda" name="kegiatan" class="form-control" placeholder="Masukkan kegiatan agenda..." required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat/Tempat</label>
                                    <input type="text" id="tempatAgenda" name="tempat" class="form-control" placeholder="Masukkan alamat atau tempat..." required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal</label>
                                    <input type="date" id="tanggalAgenda" name="tanggal" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Waktu</label>
                                    <input type="time" id="waktuAgenda" name="waktu" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-plus"></i>  Tambah Agenda
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="card agenda-table-card">
                        <div class="card-header agenda-header">
                            <i class="fas fa-list"></i> Daftar Agenda
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover agenda-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Kegiatan</th>
                                            <th style="width: 150px;">Tempat</th>
                                            <th style="width: 120px;">Tanggal</th>
                                            <th style="width: 100px;">Waktu</th>
                                            <th class="text-center" style="width: 120px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabelAgenda">
                                        @forelse($agendas as $index => $agenda)
                                            <tr>
                                                <td>{{ $agenda->kegiatan }}</td>
                                                <td>{{ $agenda->tempat }}</td>
                                                <td>{{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($agenda->waktu)->format('H:i') }}</td>
                                                <td class="text-center">
                                                    <div class="d-flex gap-1 justify-content-center">
                                                        <button class="btn btn-sm btn-warning" 
                                                            onclick="editAgenda({{ $agenda->id }})"
                                                            title="Edit Agenda">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <form action="{{ route('admin.agenda.destroy', $agenda->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" 
                                                                class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Yakin ingin menghapus agenda ini?')"
                                                                title="Hapus Agenda">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted py-4">
                                                    <i class="fas fa-tasks fa-2x mb-2 d-block"></i>
                                                    Data agenda belum tersedia.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kelola Struktur Organisasi Section -->
        <div id="struktur" class="content-section">
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-sitemap"></i> Upload Struktur Organisasi
                        </div>
                        <div class="card-body">
                            <form id="formStruktur" action="{{ route('admin.struktur.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="struktur_image" class="form-label">Pilih Gambar</label>
                                    <input type="file" class="form-control" id="struktur_image" name="struktur_image" accept="image/*" required>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Struktur
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-list"></i> Daftar Struktur Organisasi
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Preview</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($strukturs ?? [] as $struktur)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/' . $struktur->gambar) }}" alt="Struktur Preview" class="img-fluid" style="max-height: 100px;">
                                            </td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <button type="button" 
                                                        class="btn btn-sm btn-warning" 
                                                        onclick="editStruktur('{{ $struktur->id }}', '{{ asset('storage/' . $struktur->gambar) }}')"
                                                        title="Edit Struktur">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form action="{{ route('admin.struktur.destroy', $struktur->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                            class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus struktur ini?')"
                                                            title="Hapus Struktur">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="2" class="text-center">Belum ada data struktur organisasi</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Struktur -->
        <div class="modal fade" id="editStrukturModal" tabindex="-1" aria-labelledby="editStrukturModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editStrukturModalLabel">Edit Struktur Organisasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formEditStruktur" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="edit_struktur_image" class="form-label">Pilih Gambar Baru</label>
                                <input type="file" class="form-control" id="edit_struktur_image" name="struktur_image" accept="image/*" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Preview Gambar Saat Ini</label>
                                <img id="currentStrukturImage" src="" alt="Preview" class="img-fluid d-block">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Kelola Banner Section -->
        <div id="banner" class="content-section">
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-image"></i> Upload Banner
                        </div>
                        <div class="card-body">
                            <form id="formBanner" action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Upload Banner</label>
                                    <input type="file" id="gambarBanner" name="gambar" class="form-control" accept="image/*" required>
                                    <small class="text-muted">Ukuran yang disarankan: 1200x400px</small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Urutan</label>
                                    <input type="number" id="urutanBanner" name="urutan" class="form-control" placeholder="Pilih Urutan" min="1" max="10" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-plus"></i> + Tambah ke Banner
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="card banner-table-card">
                        <div class="card-header banner-header">
                            <i class="fas fa-list"></i> Daftar Banner
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover banner-table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 120px;">Preview</th>
                                            <th style="width: 100px;">Urutan</th>
                                            <th class="text-center" style="width: 120px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabelBanner">
                                        @forelse($banners as $index => $banner)
                                            <tr>
                                                <td>
                                                    @if($banner->gambar)
                                                        <img src="{{ asset('storage/' . $banner->gambar) }}" alt="Banner" style="width: 100px; height: 60px; object-fit: cover;">
                                                    @else
                                                        <span class="text-muted">No Image</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge bg-primary">{{ $banner->urutan }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex gap-1 justify-content-center">
                                                        <button class="btn btn-sm btn-warning" 
                                                            onclick="editBanner({{ $banner->id }})"
                                                            title="Edit Banner">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <form action="{{ route('admin.banner.destroy', $banner->id) }}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" 
                                                                class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Yakin ingin menghapus banner ini?')"
                                                                title="Hapus Banner">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-4">
                                                    <i class="fas fa-image fa-2x mb-2 d-block"></i>
                                                    Data banner belum tersedia.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function editStruktur(id, imageUrl) {
            const modal = new bootstrap.Modal(document.getElementById('editStrukturModal'));
            document.getElementById('formEditStruktur').action = `/admin/struktur/${id}`;
            document.getElementById('currentStrukturImage').src = imageUrl;
            modal.show();
        }

        // Function to show different sections
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.content-section');
            sections.forEach(section => section.classList.remove('active'));
            document.getElementById(sectionId).classList.add('active');

            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => link.classList.remove('active'));
            event.target.classList.add('active');
        }

        // Function to preview uploaded images
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Preview file yang dipilih
        function previewFile(input) {
            const filePreview = document.getElementById('filePreview');
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');

            if (input.files && input.files[0]) {
                const file = input.files[0];
                const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);

                fileName.textContent = file.name;
                fileSize.textContent = `Ukuran: ${sizeInMB} MB`;
                filePreview.style.display = 'block';
            } else {
                filePreview.style.display = 'none';
            }
        }

        // Tambahkan fungsi input dinamis dropdown
        function addDropdownInput(value = '') {
            const container = document.getElementById('dropdownInputs');
            const inputGroup = document.createElement('div');
            inputGroup.className = 'input-group mb-1';
            inputGroup.innerHTML = `
                <input type="text" class="form-control dropdown-item-input" name="sub_menu[]" placeholder="Isi dropdown menu" value="${value}">
                <button type="button" class="btn btn-primary btn-sm me-1" onclick="showTemplateModal()" title="Pilih Template">
                    <i class="fas fa-plus"></i>
                </button>
                <button type="button" class="btn btn-danger btn-sm" onclick="this.parentNode.remove()" title="Hapus">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            container.appendChild(inputGroup);
        }

        // Fungsi untuk menampilkan modal template
        function showTemplateModal() {
            const modal = new bootstrap.Modal(document.getElementById('templateModal'));
            modal.show();
        }

        // Fungsi untuk menampilkan modal sesuai template yang dipilih
        function showSelectedTemplateModal() {
            const selectedTemplate = document.getElementById('templateSelect').value;
            
            // Validasi pilihan template
            if (!selectedTemplate) {
                alert('Silakan pilih template terlebih dahulu!');
                return;
            }
            
            // Tutup modal template
            const templateModal = bootstrap.Modal.getInstance(document.getElementById('templateModal'));
            templateModal.hide();
            
            // Set navbar_id untuk form yang akan dibuka
            const navbarId = getCurrentNavbarId();
            if (!navbarId) {
                alert('Error: Tidak dapat menentukan menu navbar. Silakan coba lagi.');
                return;
            }
            
            // Jika sedang dalam mode tambah baru, simpan menu dulu
            if (navbarId === 'new') {
                if (!confirm('Anda sedang dalam mode tambah menu baru. Menu akan disimpan terlebih dahulu sebelum menambahkan template. Lanjutkan?')) {
                    return;
                }
                
                // Simpan menu navbar dulu
                saveMenuFirst(selectedTemplate);
                return;
            }
            
            // Tampilkan modal sesuai template yang dipilih
            switch(selectedTemplate) {
                case 'berita':
                    document.getElementById('navbarIdBerita').value = navbarId;
                    // Reset form berita
                    document.getElementById('modalFormBerita').reset();
                    document.getElementById('navbarIdBerita').value = navbarId;
                    const beritaModal = new bootstrap.Modal(document.getElementById('beritaModal'));
                    beritaModal.show();
                    break;
                case 'sambutan':
                    document.getElementById('navbarIdSambutan').value = navbarId;
                    // Reset form sambutan
                    document.getElementById('modalFormSambutan').reset();
                    document.getElementById('navbarIdSambutan').value = navbarId;
                    const sambutanModal = new bootstrap.Modal(document.getElementById('sambutanModal'));
                    sambutanModal.show();
                    break;
                default:
                    alert('Template tidak valid!');
            }
        }

        // Fungsi untuk menyimpan menu navbar dulu sebelum menambahkan template
        function saveMenuFirst(templateType) {
            const formData = new FormData(document.getElementById('formNavbar'));
            
            // Show loading
            const submitBtn = document.querySelector('#formNavbar button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
            submitBtn.disabled = true;
            
            fetch(document.getElementById('formNavbar').action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Set navbar_id yang baru dibuat
                    const newNavbarId = data.navbar.id;
                    document.querySelector('input[name="edit_id"]').value = newNavbarId;
                    document.getElementById('navbarIdForTemplate').value = newNavbarId;
                    
                    // Lanjutkan dengan membuka modal template
                    openTemplateModal(templateType, newNavbarId);
                } else {
                    alert('Error: ' + (data.message || 'Gagal menyimpan menu navbar'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan menu navbar');
            })
            .finally(() => {
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        }

        // Fungsi untuk membuka modal template setelah menu tersimpan
        function openTemplateModal(templateType, navbarId) {
            switch(templateType) {
                case 'berita':
                    document.getElementById('navbarIdBerita').value = navbarId;
                    document.getElementById('modalFormBerita').reset();
                    document.getElementById('navbarIdBerita').value = navbarId;
                    const beritaModal = new bootstrap.Modal(document.getElementById('beritaModal'));
                    beritaModal.show();
                    break;
                case 'sambutan':
                    document.getElementById('navbarIdSambutan').value = navbarId;
                    document.getElementById('modalFormSambutan').reset();
                    document.getElementById('navbarIdSambutan').value = navbarId;
                    const sambutanModal = new bootstrap.Modal(document.getElementById('sambutanModal'));
                    sambutanModal.show();
                    break;
            }
        }

        // Fungsi untuk mendapatkan navbar_id yang sedang diedit
        function getCurrentNavbarId() {
            // Cari input hidden yang berisi ID navbar yang sedang diedit
            const editIdInput = document.querySelector('input[name="edit_id"]');
            if (editIdInput && editIdInput.value) {
                return editIdInput.value;
            }
            
            // Cari dari navbar_id_for_template
            const navbarIdInput = document.getElementById('navbarIdForTemplate');
            if (navbarIdInput && navbarIdInput.value) {
                return navbarIdInput.value;
            }
            
            // Cari dari form yang sedang aktif
            const activeForm = document.querySelector('form[data-edit-id]');
            if (activeForm && activeForm.dataset.editId) {
                return activeForm.dataset.editId;
            }
            
            // Jika sedang dalam mode tambah menu baru, kita perlu simpan dulu
            // Cek apakah ada data di form yang belum disimpan
            const namaMenu = document.getElementById('namaMenu').value;
            if (namaMenu) {
                // Jika ada nama menu, berarti sedang dalam mode tambah
                // Kita perlu simpan dulu untuk mendapatkan ID
                return 'new'; // Flag untuk mode tambah baru
            }
            
            console.warn('Tidak dapat menemukan navbar_id. Pastikan sedang dalam mode edit menu atau ada nama menu yang diisi.');
            return '';
        }

        // Real-time preview untuk sambutan
        document.getElementById('isiProfile').addEventListener('input', function() {
            const isi = this.value.trim();
            const preview = document.getElementById('previewSambutan');
            if (isi) {
                preview.innerHTML = `<p>${isi.replace(/\n/g, '<br>')}</p>`;
            } else {
                preview.innerHTML = `<p class="text-muted">Teks sambutan akan muncul di sini...</p>`;
            }
        });

        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Set default dates
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('tanggalBerita').value = today;
            document.getElementById('tanggalGaleri').value = today;
            document.getElementById('tanggalVideo').value = today;

            // Add initial dropdown input
            addDropdownInput();

            // Event listener untuk modal template
            document.getElementById('templateModal').addEventListener('hidden.bs.modal', function() {
                // Reset dropdown template ke default
                document.getElementById('templateSelect').value = 'berita';
            });

            // Event listener untuk modal berita
            document.getElementById('beritaModal').addEventListener('hidden.bs.modal', function() {
                document.getElementById('modalFormBerita').reset();
                document.getElementById('navbarIdBerita').value = '';
            });

            // Event listener untuk modal sambutan
            document.getElementById('sambutanModal').addEventListener('hidden.bs.modal', function() {
                document.getElementById('modalFormSambutan').reset();
                document.getElementById('navbarIdSambutan').value = '';
            });

            // Form berita akan submit secara normal tanpa AJAX

            // Form sambutan akan submit secara normal tanpa AJAX

            // Auto-switch tab setelah redirect dari upload
            @if (session('redirect_tab'))
                const targetTab = '{{ session('redirect_tab') }}';
                setTimeout(function() {
                    showSection(targetTab);

                    // Update active nav link
                    const navLinks = document.querySelectorAll('.nav-link');
                    navLinks.forEach(link => link.classList.remove('active'));
                    const targetNavLink = document.querySelector(`[onclick*="${targetTab}"]`);
                    if (targetNavLink) {
                        targetNavLink.classList.add('active');
                    }
                }, 100);
            @endif
        });

        // Edit functions
        function editBerita(id) {
            // Fetch berita data and show modal
            fetch(`/admin/berita/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const berita = data.berita;

                        // Populate modal fields
                        document.getElementById('editBeritaId').value = berita.id;
                        document.getElementById('editJudulBerita').value = berita.judul;
                        document.getElementById('editKategoriBerita').value = berita.kategori;
                        document.getElementById('editTanggalBerita').value = berita.tanggal;
                        document.getElementById('editIsiBerita').value = berita.isi;

                        // Show current image
                        const currentImage = document.getElementById('currentBeritaImage');
                        if (berita.gambar) {
                            currentImage.src = berita.gambar;
                            currentImage.style.display = 'block';
                        } else {
                            currentImage.style.display = 'none';
                        }

                        // Show modal
                        const modal = new bootstrap.Modal(document.getElementById('editBeritaModal'));
                        modal.show();
                    } else {
                        alert('Gagal mengambil data berita');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data berita');
                });
        }

        function editGaleri(id) {
            // Fetch galeri data and show modal
            fetch(`/admin/galeri/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const galeri = data.galeri;

                        // Populate modal fields
                        document.getElementById('editGaleriId').value = galeri.id;
                        document.getElementById('editJudulAlbum').value = galeri.judul_album;
                        document.getElementById('editDeskripsiGaleri').value = galeri.deskripsi;
                        document.getElementById('editTanggalGaleri').value = galeri.tanggal;

                        // Show current photo
                        const currentPhoto = document.getElementById('currentPhoto');
                        currentPhoto.src = `/storage/${galeri.foto}`;
                        currentPhoto.style.display = 'block';

                        // Show modal
                        const modal = new bootstrap.Modal(document.getElementById('editGaleriModal'));
                        modal.show();
                    } else {
                        alert('Gagal mengambil data galeri');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data galeri');
                });
        }

        function editVideo(id) {
            // Implement edit functionality
            alert('Edit video dengan ID: ' + id);
        }

        function editCarousel(id) {
            // Call the proper editCarousel function
            fetch(`/admin/carousel/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const carousel = data.carousel;

                        document.getElementById('editCarouselId').value = carousel.id;
                        document.getElementById('editUrutanCarousel').value = carousel.urutan;

                        const currentImage = document.getElementById('currentCarouselImage');
                        if (carousel.gambar) {
                            currentImage.src = `/storage/${carousel.gambar}`;
                            currentImage.style.display = 'block';
                        } else {
                            currentImage.style.display = 'none';
                        }

                        const modal = new bootstrap.Modal(document.getElementById('editCarouselModal'));
                        modal.show();
                    } else {
                        alert('Gagal mengambil data carousel');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data carousel');
                });
        }

        function editMenuNavbar(id) {
            // Call the proper editNavbar function
            editNavbar(id);
        }

        function editDokumen(id) {
            // Call the proper editDokumen function
            fetch(`/admin/dokumen/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const dokumen = data.dokumen;

                        document.getElementById('editDokumenId').value = dokumen.id;
                        document.getElementById('editNamaDokumen').value = dokumen.nama;
                        document.getElementById('editKeteranganDokumen').value = dokumen.keterangan;
                        document.getElementById('editKategoriDokumen').value = dokumen.kategori;

                        // Show current file
                        const fileName = document.getElementById('currentDokumenFileName');
                        if (dokumen.file) {
                            fileName.textContent = dokumen.file.split('/').pop();
                        } else {
                            fileName.textContent = 'Tidak ada file';
                        }

                        const modal = new bootstrap.Modal(document.getElementById('editDokumenModal'));
                        modal.show();
                    } else {
                        alert('Gagal mengambil data dokumen');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data dokumen');
                });
        }
    </script>

    <!-- Modal Edit Berita -->
    <div class="modal fade" id="editBeritaModal" tabindex="-1" aria-labelledby="editBeritaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBeritaModalLabel">
                        <i class="fas fa-edit"></i> Edit Berita
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editBeritaForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="editBeritaId" name="id">

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="editJudulBerita" class="form-label">Judul Berita</label>
                                    <input type="text" id="editJudulBerita" name="judul" class="form-control"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="editKategoriBerita" class="form-label">Kategori</label>
                                    <input type="text" id="editKategoriBerita" name="kategori"
                                        class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="editTanggalBerita" class="form-label">Tanggal</label>
                                    <input type="date" id="editTanggalBerita" name="tanggal" class="form-control"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="editIsiBerita" class="form-label">Isi Berita</label>
                                    <textarea id="editIsiBerita" name="isi" class="form-control" rows="5" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="editGambarBerita" class="form-label">Upload Gambar Baru
                                        (Opsional)</label>
                                    <input type="file" id="editGambarBerita" name="gambar" class="form-control"
                                        accept="image/*" onchange="previewEditBeritaImage(this)">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                                    <div class="mt-2">
                                        <img id="editBeritaPreview" class="image-preview"
                                            style="display: none; max-width: 200px;">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Gambar Saat Ini</label>
                                    <div class="text-center">
                                        <img id="currentBeritaImage" class="img-fluid rounded"
                                            style="max-width: 100%; height: 200px; object-fit: cover; border: 1px solid #ddd;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Berita
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Carousel -->
    <div class="modal fade" id="editCarouselModal" tabindex="-1" aria-labelledby="editCarouselModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCarouselModalLabel">
                        <i class="fas fa-edit"></i> Edit Carousel
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editCarouselForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="editCarouselId" name="id">

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="editUrutanCarousel" class="form-label">Urutan</label>
                                    <input type="number" id="editUrutanCarousel" name="urutan"
                                        class="form-control" min="1" max="10" required>
                                </div>

                                <div class="mb-3">
                                    <label for="editGambarCarousel" class="form-label">Upload Gambar Baru
                                        (Opsional)</label>
                                    <input type="file" id="editGambarCarousel" name="gambar"
                                        class="form-control" accept="image/*"
                                        onchange="previewEditCarouselImage(this)">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                                    <div class="mt-2">
                                        <img id="editCarouselPreview" class="image-preview"
                                            style="display: none; max-width: 200px;">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Gambar Saat Ini</label>
                                    <div class="text-center">
                                        <img id="currentCarouselImage" class="img-fluid rounded"
                                            style="max-width: 100%; height: 200px; object-fit: cover; border: 1px solid #ddd;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Carousel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Navbar -->
    <div class="modal fade" id="editNavbarModal" tabindex="-1" aria-labelledby="editNavbarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNavbarModalLabel">
                        <i class="fas fa-edit"></i> Edit Menu Navbar
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editNavbarForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="editNavbarId" name="id">

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="editNamaNavbar" class="form-label">Nama Menu</label>
                                    <input type="text" id="editNamaNavbar" name="nama" class="form-control"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="editUrutanNavbar" class="form-label">Urutan</label>
                                    <input type="number" id="editUrutanNavbar" name="urutan" class="form-control"
                                        min="1" max="10" required>
                                    <small class="text-muted">Urutan 1-10, semakin kecil angka semakin atas
                                        posisinya</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Sub Menu (Opsional)</label>
                                    <div id="editSubMenuContainer" class="border rounded p-3"
                                        style="max-height: 200px; overflow-y: auto; background-color: #f8f9fa;">
                                        <!-- Sub menu akan ditambahkan secara dinamis -->
                                        <p class="text-muted small mb-0">Belum ada sub menu</p>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-primary mt-2"
                                        onclick="addEditSubMenu()">
                                        <i class="fas fa-plus"></i> Tambah Sub Menu
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Preview Menu</label>
                                    <div class="border rounded p-3" style="background-color: #f8f9fa;">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-bars text-primary me-2"></i>
                                            <span id="previewMenuName" class="fw-bold">Nama Menu</span>
                                        </div>
                                        <div id="previewSubMenus" class="ms-3">
                                            <small class="text-muted">Sub menu akan muncul di sini</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-info small">
                                    <i class="fas fa-info-circle"></i>
                                    <strong>Tips:</strong>
                                    <ul class="mb-0 mt-1 small">
                                        <li>Sub menu akan muncul sebagai dropdown</li>
                                        <li>Urutan menentukan posisi menu</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Menu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Dokumen -->
    <div class="modal fade" id="editDokumenModal" tabindex="-1" aria-labelledby="editDokumenModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDokumenModalLabel">
                        <i class="fas fa-edit"></i> Edit Dokumen
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editDokumenForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="editDokumenId" name="id">

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="editNamaDokumen" class="form-label">Nama Dokumen</label>
                                    <input type="text" id="editNamaDokumen" name="nama" class="form-control"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="editKeteranganDokumen" class="form-label">Keterangan</label>
                                    <textarea id="editKeteranganDokumen" name="keterangan" class="form-control" rows="3" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="editKategoriDokumen" class="form-label">Kategori</label>
                                    <input type="text" id="editKategoriDokumen" name="kategori"
                                        class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="editFileDokumen" class="form-label">Upload File Baru
                                        (Opsional)</label>
                                    <input type="file" id="editFileDokumen" name="file" class="form-control"
                                        accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah file</small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">File Saat Ini</label>
                                    <div class="text-center">
                                        <div id="currentDokumenFile" class="p-3 border rounded">
                                            <i class="fas fa-file-alt fa-3x text-muted"></i>
                                            <p class="mt-2 mb-0" id="currentDokumenFileName"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Dokumen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Video -->
    <div class="modal fade" id="editVideoModal" tabindex="-1" aria-labelledby="editVideoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editVideoModalLabel">
                        <i class="fas fa-edit"></i> Edit Video
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editVideoForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="editVideoId" name="id">

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="editJudulVideo" class="form-label">Judul Video</label>
                                    <input type="text" id="editJudulVideo" name="judul" class="form-control"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="editLinkYoutubeVideo" class="form-label">Link YouTube</label>
                                    <input type="url" id="editLinkYoutubeVideo" name="link_youtube"
                                        class="form-control" placeholder="https://www.youtube.com/watch?v=..."
                                        required>
                                    <small class="text-muted">Masukkan link YouTube yang valid</small>
                                </div>

                                <div class="mb-3">
                                    <label for="editDeskripsiVideo" class="form-label">Deskripsi</label>
                                    <textarea id="editDeskripsiVideo" name="deskripsi" class="form-control" rows="3"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="editTanggalVideo" class="form-label">Tanggal</label>
                                    <input type="date" id="editTanggalVideo" name="tanggal" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Video Saat Ini</label>
                                    <div class="text-center">
                                        <div id="currentVideoPreview" class="border rounded p-2">
                                            <iframe id="currentVideoFrame" width="100%" height="200"
                                                frameborder="0" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Video
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Galeri -->
    <div class="modal fade" id="editGaleriModal" tabindex="-1" aria-labelledby="editGaleriModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGaleriModalLabel">
                        <i class="fas fa-edit"></i> Edit Foto
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editGaleriForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="editGaleriId" name="id">

                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="editJudulAlbum" class="form-label">Judul Album</label>
                                    <input type="text" id="editJudulAlbum" name="judul_album"
                                        class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="editDeskripsiGaleri" class="form-label">Deskripsi</label>
                                    <textarea id="editDeskripsiGaleri" name="deskripsi" class="form-control" rows="3" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="editTanggalGaleri" class="form-label">Tanggal</label>
                                    <input type="date" id="editTanggalGaleri" name="tanggal" class="form-control"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="editFotoGaleri" class="form-label">Upload Foto Baru
                                        (Opsional)</label>
                                    <input type="file" id="editFotoGaleri" name="foto"
                                        class="form-control" accept="image/*" onchange="previewEditImage(this)">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                                    <div class="mt-2">
                                        <img id="editGaleriPreview" class="image-preview"
                                            style="display: none; max-width: 200px;">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Foto Saat Ini</label>
                                    <div class="text-center">
                                        <img id="currentPhoto" class="img-fluid rounded"
                                            style="max-width: 100%; height: 200px; object-fit: cover; border: 1px solid #ddd;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Foto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        // Preview image for edit modal
        function previewEditImage(input) {
            const preview = document.getElementById('editGaleriPreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.style.display = 'none';
            }
        }

        // Handle edit form submission
        document.getElementById('editGaleriForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const galeriId = document.getElementById('editGaleriId').value;

            // Add method override for PUT
            formData.append('_method', 'PUT');

            fetch(`/admin/galeri/${galeriId}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Close modal
                        const modal = bootstrap.Modal.getInstance(document.getElementById('editGaleriModal'));
                        modal.hide();

                        // Show success message
                        alert('Foto galeri berhasil diupdate!');

                        // Reload page to show updated data
                        window.location.hash = '#galeri';
                        location.reload();
                    } else {
                        alert('Gagal mengupdate foto galeri');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengupdate foto galeri');
                });
        });

        // Edit functions for other modals
        function editCarousel(id) {
            fetch(`/admin/carousel/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const carousel = data.carousel;

                        document.getElementById('editCarouselId').value = carousel.id;
                        document.getElementById('editUrutanCarousel').value = carousel.urutan;

                        const currentImage = document.getElementById('currentCarouselImage');
                        if (carousel.gambar) {
                            currentImage.src = `/storage/${carousel.gambar}`;
                            currentImage.style.display = 'block';
                        } else {
                            currentImage.style.display = 'none';
                        }

                        const modal = new bootstrap.Modal(document.getElementById('editCarouselModal'));
                        modal.show();
                    } else {
                        alert('Gagal mengambil data carousel');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data carousel');
                });
        }

        function editNavbar(id) {
            fetch(`/admin/navbar/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const navbar = data.navbar;

                        document.getElementById('editNavbarId').value = navbar.id;
                        document.getElementById('editNamaNavbar').value = navbar.nama;
                        document.getElementById('editUrutanNavbar').value = navbar.urutan;
                        
                        // Set navbar_id untuk template
                        document.getElementById('navbarIdForTemplate').value = navbar.id;
                        document.querySelector('input[name="edit_id"]').value = navbar.id;

                        // Update preview
                        updateMenuPreview(navbar.nama);

                        // Handle sub menu
                        const container = document.getElementById('editSubMenuContainer');
                        container.innerHTML = '';

                        if (navbar.sub_menu) {
                            try {
                                const subMenus = JSON.parse(navbar.sub_menu);
                                if (Array.isArray(subMenus) && subMenus.length > 0) {
                                    subMenus.forEach((subMenu, index) => {
                                        addEditSubMenu(subMenu);
                                    });
                                    updateSubMenuPreview(subMenus);
                                } else {
                                    container.innerHTML = '<p class="text-muted small mb-0">Belum ada sub menu</p>';
                                    updateSubMenuPreview([]);
                                }
                            } catch (e) {
                                container.innerHTML = '<p class="text-muted small mb-0">Belum ada sub menu</p>';
                                updateSubMenuPreview([]);
                            }
                        } else {
                            container.innerHTML = '<p class="text-muted small mb-0">Belum ada sub menu</p>';
                            updateSubMenuPreview([]);
                        }

                        const modal = new bootstrap.Modal(document.getElementById('editNavbarModal'));
                        modal.show();
                    } else {
                        alert('Gagal mengambil data navbar');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data navbar');
                });
        }

        function editDokumen(id) {
            fetch(`/admin/dokumen/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const dokumen = data.dokumen;

                        document.getElementById('editDokumenId').value = dokumen.id;
                        document.getElementById('editNamaDokumen').value = dokumen.nama;
                        document.getElementById('editKeteranganDokumen').value = dokumen.keterangan;
                        document.getElementById('editKategoriDokumen').value = dokumen.kategori;

                        // Show current file
                        const fileName = document.getElementById('currentDokumenFileName');
                        if (dokumen.file) {
                            fileName.textContent = dokumen.file.split('/').pop();
                        } else {
                            fileName.textContent = 'Tidak ada file';
                        }

                        const modal = new bootstrap.Modal(document.getElementById('editDokumenModal'));
                        modal.show();
                    } else {
                        alert('Gagal mengambil data dokumen');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data dokumen');
                });
        }

        function editVideo(id) {
            fetch(`/admin/video/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const video = data.video;

                        document.getElementById('editVideoId').value = video.id;
                        document.getElementById('editJudulVideo').value = video.judul;
                        document.getElementById('editLinkYoutubeVideo').value = video.url;
                        document.getElementById('editDeskripsiVideo').value = video.deskripsi || '';
                        document.getElementById('editTanggalVideo').value = video.tanggal;

                        // Show current video preview
                        const videoFrame = document.getElementById('currentVideoFrame');
                        if (video.video_id) {
                            videoFrame.src = `https://www.youtube.com/embed/${video.video_id}`;
                            videoFrame.style.display = 'block';
                        } else {
                            videoFrame.style.display = 'none';
                        }

                        const modal = new bootstrap.Modal(document.getElementById('editVideoModal'));
                        modal.show();
                    } else {
                        alert('Gagal mengambil data video');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data video');
                });
        }


        // Preview functions for edit modals
        function previewEditBeritaImage(input) {
            const preview = document.getElementById('editBeritaPreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.style.display = 'none';
            }
        }

        function previewEditCarouselImage(input) {
            const preview = document.getElementById('editCarouselPreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.style.display = 'none';
            }
        }

        // Sub menu functions
        function addEditSubMenu(value = '') {
            const container = document.getElementById('editSubMenuContainer');

            // Remove "Belum ada sub menu" message if exists
            const noSubMenuMsg = container.querySelector('p.text-muted.small');
            if (noSubMenuMsg) {
                noSubMenuMsg.remove();
            }

            const subMenuDiv = document.createElement('div');
            subMenuDiv.className = 'input-group mb-2';
            subMenuDiv.innerHTML = `
                <input type="text" name="sub_menu[]" class="form-control" value="${value}" placeholder="Nama sub menu">
                <button type="button" class="btn btn-outline-danger" onclick="removeEditSubMenu(this)">
                    <i class="fas fa-trash"></i>
                </button>
            `;

            container.appendChild(subMenuDiv);

            // Add event listener to new input for real-time preview
            const newInput = subMenuDiv.querySelector('input');
            newInput.addEventListener('input', function() {
                updateSubMenuPreviewFromContainer();
            });

            // Update preview immediately
            updateSubMenuPreviewFromContainer();
        }

        function removeEditSubMenu(button) {
            button.parentElement.remove();

            // Check if no sub menus left, show message
            const container = document.getElementById('editSubMenuContainer');
            if (container.children.length === 0) {
                container.innerHTML = '<p class="text-muted small mb-0">Belum ada sub menu</p>';
            }

            // Update preview
            updateSubMenuPreviewFromContainer();
        }

        // Preview functions
        function updateMenuPreview(menuName) {
            const previewElement = document.getElementById('previewMenuName');
            if (previewElement) {
                previewElement.textContent = menuName || 'Nama Menu';
            }
        }

        function updateSubMenuPreview(subMenus) {
            const previewElement = document.getElementById('previewSubMenus');
            if (previewElement) {
                if (subMenus && subMenus.length > 0) {
                    let html = '';
                    subMenus.forEach(subMenu => {
                        html += `<div class="small text-muted">• ${subMenu}</div>`;
                    });
                    previewElement.innerHTML = html;
                } else {
                    previewElement.innerHTML = '<small class="text-muted">Sub menu akan muncul di sini</small>';
                }
            }
        }

        function updateSubMenuPreviewFromContainer() {
            const container = document.getElementById('editSubMenuContainer');
            const inputs = container.querySelectorAll('input[name="sub_menu[]"]');
            const subMenus = Array.from(inputs).map(input => input.value).filter(value => value.trim() !== '');
            updateSubMenuPreview(subMenus);
        }

        // Form submission handlers
        document.getElementById('editBeritaForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const beritaId = document.getElementById('editBeritaId').value;
            formData.append('_method', 'PUT');

            fetch(`/admin/berita/${beritaId}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('editBeritaModal'));
                        modal.hide();
                        alert('Berita berhasil diupdate!');
                        window.location.hash = '#berita';
                        location.reload();
                    } else {
                        alert('Gagal mengupdate berita');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengupdate berita');
                });
        });

        document.getElementById('editCarouselForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const carouselId = document.getElementById('editCarouselId').value;
            formData.append('_method', 'PUT');

            fetch(`/admin/carousel/${carouselId}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('editCarouselModal'));
                        modal.hide();
                        alert('Carousel berhasil diupdate!');
                        window.location.hash = '#carousel';
                        location.reload();
                    } else {
                        alert('Gagal mengupdate carousel');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengupdate carousel');
                });
        });

        document.getElementById('editNavbarForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const navbarId = document.getElementById('editNavbarId').value;
            formData.append('_method', 'PUT');

            fetch(`/admin/navbar/${navbarId}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('editNavbarModal'));
                        modal.hide();
                        alert('Menu navbar berhasil diupdate!');
                        window.location.hash = '#navbar';
                        location.reload();
                    } else {
                        alert('Gagal mengupdate menu navbar');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengupdate menu navbar');
                });
        });

        document.getElementById('editDokumenForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const dokumenId = document.getElementById('editDokumenId').value;
            formData.append('_method', 'PUT');

            fetch(`/admin/dokumen/${dokumenId}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('editDokumenModal'));
                        modal.hide();
                        alert('Dokumen berhasil diupdate!');
                        window.location.hash = '#dokumen';
                        location.reload();
                    } else {
                        alert('Gagal mengupdate dokumen');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengupdate dokumen');
                });
        });

        document.getElementById('editVideoForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const videoId = document.getElementById('editVideoId').value;
            formData.append('_method', 'PUT');

            fetch(`/admin/video/${videoId}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('editVideoModal'));
                        modal.hide();
                        alert('Video berhasil diupdate!');
                        window.location.hash = '#galeri';
                        location.reload();
                    } else {
                        alert('Gagal mengupdate video');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengupdate video');
                });
        });

        // Form update sambutan sekarang menggunakan redirect, tidak perlu AJAX

        // Form submission handlers for store operations
        // Form sambutan sekarang menggunakan redirect, tidak perlu AJAX

        document.getElementById('formBerita').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        this.reset();
                        location.reload();
                    } else {
                        alert('Gagal menyimpan berita');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan berita');
                });
        });

        document.getElementById('formGaleri').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        this.reset();
                        location.reload();
                    } else {
                        alert('Gagal menyimpan galeri');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan galeri');
                });
        });

        document.getElementById('formVideo').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        this.reset();
                        location.reload();
                    } else {
                        alert(data.message || 'Gagal menyimpan video');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan video');
                });
        });

        document.getElementById('formCarousel').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        this.reset();
                        location.reload();
                    } else {
                        alert('Gagal menyimpan carousel');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan carousel');
                });
        });

        document.getElementById('formNavbar').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        this.reset();
                        location.reload();
                    } else {
                        alert('Gagal menyimpan navbar');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan navbar');
                });
        });

        document.getElementById('formDokumen').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        this.reset();
                        location.reload();
                    } else {
                        alert('Gagal menyimpan dokumen');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan dokumen');
                });
        });

        // Real-time preview for navbar modal
        document.addEventListener('DOMContentLoaded', function() {
            // Menu name preview
            const menuNameInput = document.getElementById('editNamaNavbar');
            if (menuNameInput) {
                menuNameInput.addEventListener('input', function() {
                    updateMenuPreview(this.value);
                });
            }

            // Sub menu preview (delegated event listener)
            document.addEventListener('input', function(e) {
                if (e.target.name === 'sub_menu[]') {
                    updateSubMenuPreviewFromContainer();
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check for redirect_tab in session flash data
            @if(session('redirect_tab'))
                const redirectTab = '{{ session('redirect_tab') }}';
                showSection(redirectTab);
                // Update nav-link active
                document.querySelectorAll('.nav-link').forEach(function(link) {
                    link.classList.remove('active');
                });
                const nav = document.querySelector('[onclick*="' + redirectTab + '"]');
                if (nav) nav.classList.add('active');
                // Update URL hash
                window.location.hash = '#' + redirectTab;
            @else
                if (window.location.hash) {
                    const tab = window.location.hash.replace('#', '');
                    showSection(tab);
                    // Update nav-link active
                    document.querySelectorAll('.nav-link').forEach(function(link) {
                        link.classList.remove('active');
                    });
                    const nav = document.querySelector('[onclick*="' + tab + '"]');
                    if (nav) nav.classList.add('active');
                }
            @endif
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add confirmation dialog to all delete forms
            const deleteForms = document.querySelectorAll('form[action*="/destroy"]');
            
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const section = this.action.split('/')[4]; // e.g. berita, galeri, etc.
                    if (!confirm(`Apakah Anda yakin ingin menghapus ${section} ini?`)) {
                        e.preventDefault();
                    }
                });
            });
        });

        // Visi Misi Form Handler
        document.getElementById('visiMisiForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('/admin/visi-misi', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Visi Misi berhasil disimpan!');
                    loadVisiMisi();
                } else {
                    alert('Gagal menyimpan visi misi');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan visi misi');
            });
        });

        // Load existing visi misi data
        function loadVisiMisi() {
            fetch('/admin/visi-misi')
            .then(response => response.json())
            .then(data => {
                if (data.success && data.visiMisi) {
                    document.getElementById('visi').value = data.visiMisi.visi || '';
                    document.getElementById('misi').value = data.visiMisi.misi || '';
                    document.getElementById('tujuan_strategis').value = data.visiMisi.tujuan_strategis || '';
                    updateVisiMisiPreview(data.visiMisi);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        // Update preview
        function updateVisiMisiPreview(visiMisi) {
            const preview = document.getElementById('visiMisiPreview');
            preview.innerHTML = `
                <div class="mb-3">
                    <h6 class="text-primary"><i class="fas fa-eye me-2"></i>VISI</h6>
                    <p class="mb-0">${visiMisi.visi || 'Belum ada visi'}</p>
                </div>
                <div class="mb-3">
                    <h6 class="text-success"><i class="fas fa-bullseye me-2"></i>MISI</h6>
                    <p class="mb-0">${visiMisi.misi || 'Belum ada misi'}</p>
                </div>
                ${visiMisi.tujuan_strategis ? `
                <div class="mb-3">
                    <h6 class="text-info"><i class="fas fa-star me-2"></i>TUJUAN STRATEGIS</h6>
                    <p class="mb-0">${visiMisi.tujuan_strategis}</p>
                </div>
                ` : ''}
            `;
        }

        // Pejabat Form Handler (for adding new data only)
        document.getElementById('pejabatForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('/admin/pejabat', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Data pejabat berhasil disimpan!');
                    this.reset();
                    loadPejabats();
                } else {
                    alert('Gagal menyimpan data pejabat');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan data pejabat');
            });
        });

        // Load existing pejabats data
        function loadPejabats() {
            fetch('/admin/pejabat')
            .then(response => response.json())
            .then(data => {
                if (data.success && data.pejabats) {
                    updatePejabatList(data.pejabats);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        // Update pejabat list
        function updatePejabatList(pejabats) {
            const list = document.getElementById('pejabatList');
            if (pejabats.length === 0) {
                list.innerHTML = `
                    <div class="text-center text-muted">
                        <i class="fas fa-users fa-3x mb-3"></i>
                        <p>Belum ada data pejabat</p>
                    </div>
                `;
                return;
            }

            let html = '<div class="table-responsive"><table class="table table-striped">';
            html += '<thead><tr><th>No</th><th>Nama</th><th>Jabatan</th><th>Foto</th><th>Aksi</th></tr></thead><tbody>';
            
            pejabats.forEach((pejabat, index) => {
                const fotoUrl = pejabat.foto ? `/storage/${pejabat.foto}` : '/images/default-avatar.png';
                html += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${pejabat.nama}</td>
                        <td>${pejabat.jabatan}</td>
                        <td><img src="${fotoUrl}" alt="Foto" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;"></td>
                        <td>
                            <button class="btn btn-sm btn-primary me-1" onclick="editPejabat(${pejabat.id})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deletePejabat(${pejabat.id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });
            
            html += '</tbody></table></div>';
            list.innerHTML = html;
        }

        // Edit pejabat
        function editPejabat(id) {
            fetch(`/admin/pejabat/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.pejabat) {
                    const pejabat = data.pejabat;
                    
                    // Populate modal form
                    document.getElementById('editPejabatId').value = pejabat.id;
                    document.getElementById('editNamaPejabat').value = pejabat.nama;
                    document.getElementById('editJabatanPejabat').value = pejabat.jabatan;
                    document.getElementById('editUrutanPejabat').value = pejabat.urutan;
                    
                    // Show current image
                    const currentImage = document.getElementById('currentPejabatImage');
                    if (pejabat.foto) {
                        currentImage.src = `/storage/${pejabat.foto}`;
                        currentImage.style.display = 'block';
                    } else {
                        currentImage.src = '/images/default-avatar.png';
                        currentImage.style.display = 'block';
                    }
                    
                    // Set form action
                    document.getElementById('editPejabatForm').action = `/admin/pejabat/${id}`;
                    
                    // Show modal
                    const modal = new bootstrap.Modal(document.getElementById('editPejabatModal'));
                    modal.show();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengambil data pejabat');
            });
        }

        // Delete pejabat
        function deletePejabat(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data pejabat ini?')) {
                fetch(`/admin/pejabat/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Data pejabat berhasil dihapus!');
                        loadPejabats();
                    } else {
                        alert('Gagal menghapus data pejabat');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus data pejabat');
                });
            }
        }

        // Edit Pejabat Modal Form Handler
        document.getElementById('editPejabatForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const pejabatId = document.getElementById('editPejabatId').value;
            formData.append('_method', 'PUT');
            
            fetch(`/admin/pejabat/${pejabatId}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('editPejabatModal'));
                    modal.hide();
                    alert('Data pejabat berhasil diupdate!');
                    loadPejabats();
                } else {
                    alert('Gagal mengupdate data pejabat');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengupdate data pejabat');
            });
        });

        // Preview image function for edit pejabat modal
        function previewEditPejabatImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('editPejabatPreview').src = e.target.result;
                    document.getElementById('editPejabatPreview').style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Load visi misi on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadVisiMisi();
            loadPejabats();
            

        });

        // Calendar Edit Functions
        function editCalendar(id) {
            fetch(`/admin/calendar/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const calendar = data.calendar;
                        
                        document.getElementById('editCalendarId').value = calendar.id;
                        document.getElementById('editHariCalendar').value = calendar.hari;
                        document.getElementById('editTanggalCalendar').value = calendar.tanggal;
                        document.getElementById('editKegiatanCalendar').value = calendar.kegiatan;
                        
                        // Update form action URL with the correct ID
                        document.getElementById('editCalendarForm').action = `/admin/calendar/${id}`;
                        
                        const modal = new bootstrap.Modal(document.getElementById('editCalendarModal'));
                        modal.show();
                    } else {
                        alert('Gagal mengambil data calendar');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data calendar');
                });
        }

        // Banner Edit Functions
        function editBanner(id) {
            fetch(`/admin/banner/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const banner = data.banner;
                        
                        document.getElementById('editBannerId').value = banner.id;
                        document.getElementById('editUrutanBanner').value = banner.urutan;
                        
                        const currentImage = document.getElementById('currentBannerImage');
                        if (banner.gambar) {
                            currentImage.src = `/storage/${banner.gambar}`;
                            currentImage.style.display = 'block';
                        } else {
                            currentImage.style.display = 'none';
                        }
                        
                        // Update form action URL with the correct ID
                        document.getElementById('editBannerForm').action = `/admin/banner/${id}`;
                        
                        const modal = new bootstrap.Modal(document.getElementById('editBannerModal'));
                        modal.show();
                    } else {
                        alert('Gagal mengambil data banner');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data banner');
                });
        }

        // Agenda Edit Functions
        function editAgenda(id) {
            fetch(`/admin/agenda/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const agenda = data.agenda;
                        
                        document.getElementById('editAgendaId').value = agenda.id;
                        document.getElementById('editKegiatanAgenda').value = agenda.kegiatan;
                        document.getElementById('editTempatAgenda').value = agenda.tempat;
                        document.getElementById('editTanggalAgenda').value = agenda.tanggal;
                        document.getElementById('editWaktuAgenda').value = agenda.waktu;
                        
                        // Update form action URL with the correct ID
                        document.getElementById('editAgendaForm').action = `/admin/agenda/${id}`;
                        
                        const modal = new bootstrap.Modal(document.getElementById('editAgendaModal'));
                        modal.show();
                    } else {
                        alert('Gagal mengambil data agenda');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data agenda');
                });
        }
    </script>

    <!-- Modal Edit Calendar -->
    <div class="modal fade" id="editCalendarModal" tabindex="-1" aria-labelledby="editCalendarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCalendarModalLabel">
                        <i class="fas fa-calendar-alt"></i> Edit Kegiatan Calendar
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editCalendarForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="editCalendarId" name="id">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="editHariCalendar" class="form-label">Hari</label>
                                    <select id="editHariCalendar" name="hari" class="form-control" required>
                                        <option value="">Pilih Hari</option>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                        <option value="Minggu">Minggu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="editTanggalCalendar" class="form-label">Tanggal</label>
                                    <input type="date" id="editTanggalCalendar" name="tanggal" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="editKegiatanCalendar" class="form-label">Kegiatan</label>
                            <textarea id="editKegiatanCalendar" name="kegiatan" class="form-control" rows="3" placeholder="Masukkan kegiatan..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Calendar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Banner -->
    <div class="modal fade" id="editBannerModal" tabindex="-1" aria-labelledby="editBannerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBannerModalLabel">
                        <i class="fas fa-image"></i> Edit Banner
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editBannerForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="editBannerId" name="id">
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="editUrutanBanner" class="form-label">Urutan</label>
                                    <input type="number" id="editUrutanBanner" name="urutan" class="form-control" placeholder="Pilih Urutan" min="1" max="10" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="editGambarBanner" class="form-label">Upload Banner Baru</label>
                                    <input type="file" id="editGambarBanner" name="gambar" class="form-control" accept="image/*">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar. Ukuran yang disarankan: 1200x400px</small>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Gambar Saat Ini</label>
                                    <img id="currentBannerImage" class="image-preview" style="display: none; max-width: 200px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Banner
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Agenda -->
    <div class="modal fade" id="editAgendaModal" tabindex="-1" aria-labelledby="editAgendaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAgendaModalLabel">
                        <i class="fas fa-tasks"></i> Edit Agenda
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editAgendaForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="editAgendaId" name="id">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="editKegiatanAgenda" class="form-label">Kegiatan</label>
                                    <input type="text" id="editKegiatanAgenda" name="kegiatan" class="form-control" placeholder="Masukkan kegiatan agenda..." required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="editTempatAgenda" class="form-label">Alamat/Tempat</label>
                                    <input type="text" id="editTempatAgenda" name="tempat" class="form-control" placeholder="Masukkan alamat atau tempat..." required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="editTanggalAgenda" class="form-label">Tanggal</label>
                                    <input type="date" id="editTanggalAgenda" name="tanggal" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="editWaktuAgenda" class="form-label">Waktu</label>
                                    <input type="time" id="editWaktuAgenda" name="waktu" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Agenda
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Pejabat -->
    <div class="modal fade" id="editPejabatModal" tabindex="-1" aria-labelledby="editPejabatModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPejabatModalLabel">
                        <i class="fas fa-users"></i> Edit Data Pejabat
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editPejabatForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="editPejabatId" name="id">
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="editNamaPejabat" class="form-label">Nama Pejabat</label>
                                    <input type="text" id="editNamaPejabat" name="nama" class="form-control" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="editJabatanPejabat" class="form-label">Jabatan</label>
                                    <input type="text" id="editJabatanPejabat" name="jabatan" class="form-control" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="editUrutanPejabat" class="form-label">Urutan</label>
                                    <input type="number" id="editUrutanPejabat" name="urutan" class="form-control" min="1" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="editFotoPejabat" class="form-label">Upload Foto Baru (Opsional)</label>
                                    <input type="file" id="editFotoPejabat" name="foto" class="form-control" accept="image/*" onchange="previewEditPejabatImage(this)">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                                    <div class="mt-2">
                                        <img id="editPejabatPreview" class="image-preview" style="display: none; max-width: 200px;">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Foto Saat Ini</label>
                                    <div class="text-center">
                                        <img id="currentPejabatImage" class="img-fluid rounded" style="max-width: 100%; height: 200px; object-fit: cover; border: 1px solid #ddd;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Pejabat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Template Modal -->
    <div class="modal fade" id="templateModal" tabindex="-1" aria-labelledby="templateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="templateModalLabel">
                        <i class="fas fa-layer-group"></i> Pilih Template
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h3 class="mb-4 fw-bold text-dark">Pilih Template</h3>
                    <div class="mb-4">
                        <label for="templateSelect" class="form-label fw-semibold">Template yang tersedia:</label>
                        <select id="templateSelect" class="form-select form-select-lg">
                            <option value="berita">TempBerita</option>
                            <option value="sambutan">TempSambutan</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary btn-lg px-4" onclick="showSelectedTemplateModal()">
                        <i class="fas fa-arrow-right"></i> Lanjut
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Berita Modal -->
    <div class="modal fade" id="beritaModal" tabindex="-1" aria-labelledby="beritaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="beritaModalLabel">
                        <i class="fas fa-newspaper"></i> Tambah Berita Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="modalFormBerita" action="{{ route('admin.template.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="template_type" value="berita">
                        <input type="hidden" name="navbar_id" id="navbarIdBerita">
                        
                        <div class="mb-3">
                            <label for="modalJudulHalamanBerita" class="form-label">Judul Halaman</label>
                            <input type="text" id="modalJudulHalamanBerita" name="judul_halaman" class="form-control" placeholder="Masukkan judul halaman" required>
                        </div>
                        <div class="mb-3">
                            <label for="modalJudulBerita" class="form-label" style="color: #000;">Judul Berita</label>
                            <input type="text" id="modalJudulBerita" name="judul_content" class="form-control" placeholder="Masukkan judul berita" required>
                        </div>
                        <div class="mb-3">
                            <label for="modalIsiBerita" class="form-label">Isi Berita</label>
                            <textarea id="modalIsiBerita" name="isi_content" class="form-control" rows="5" placeholder="Masukkan isi berita" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="modalTanggalBerita" class="form-label">Tanggal</label>
                            <input type="date" id="modalTanggalBerita" name="tanggal" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="modalKategoriBerita" class="form-label">Kategori</label>
                            <input type="text" id="modalKategoriBerita" name="kategori" class="form-control" placeholder="Masukkan kategori berita">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Template Berita
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Sambutan Modal -->
    <div class="modal fade" id="sambutanModal" tabindex="-1" aria-labelledby="sambutanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sambutanModalLabel">
                        <i class="fas fa-user-tie"></i> Tambah Sambutan Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="modalFormSambutan" action="{{ route('admin.template.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="template_type" value="sambutan">
                        <input type="hidden" name="navbar_id" id="navbarIdSambutan">
                        
                        <div class="mb-3">
                            <label for="modalJudulHalamanSambutan" class="form-label">Judul Halaman</label>
                            <input type="text" id="modalJudulHalamanSambutan" name="judul_halaman" class="form-control" placeholder="Masukkan judul halaman" required>
                        </div>
                        <div class="mb-3">
                            <label for="modalNamaSambutan" class="form-label">Nama Pejabat</label>
                            <input type="text" id="modalNamaSambutan" name="nama_pejabat" class="form-control" placeholder="Masukkan nama pejabat" required>
                        </div>
                        <div class="mb-3">
                            <label for="modalJabatanSambutan" class="form-label" style="color: #000;">Jabatan</label>
                            <input type="text" id="modalJabatanSambutan" name="jabatan" class="form-control" placeholder="Masukkan jabatan" required>
                        </div>
                        <div class="mb-3">
                            <label for="modalIsiSambutan" class="form-label">Isi Sambutan</label>
                            <textarea id="modalIsiSambutan" name="isi_content" class="form-control" rows="5" placeholder="Masukkan isi sambutan" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="modalTanggalSambutan" class="form-label">Tanggal</label>
                            <input type="date" id="modalTanggalSambutan" name="tanggal" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times"></i> Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Template Sambutan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
