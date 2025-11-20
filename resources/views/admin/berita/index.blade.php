@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Manajemen Berita</h1>
    <p class="mb-4">Halaman untuk mengelola berita website Disperum.</p>

    <!-- DataTables -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Berita</h6>
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#tambahBeritaModal">
                Tambah Berita
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($beritas as $index => $berita)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $berita->judul }}</td>
                            <td>{{ $berita->kategori }}</td>
                            <td>{{ $berita->tanggal }}</td>
                            <td>
                                @if($berita->gambar)
                                    <img src="{{ asset('storage/'.$berita->gambar) }}" alt="Gambar Berita" width="100">
                                @else
                                    Tidak ada gambar
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm edit-berita" 
                                        data-id="{{ $berita->id }}"
                                        data-judul="{{ $berita->judul }}"
                                        data-kategori="{{ $berita->kategori }}"
                                        data-tanggal="{{ $berita->tanggal }}"
                                        data-isi="{{ $berita->isi }}"
                                        data-toggle="modal" data-target="#editBeritaModal">
                                    Edit
                                </button>
                                <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Berita -->
<div class="modal fade" id="tambahBeritaModal" tabindex="-1" role="dialog" aria-labelledby="tambahBeritaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahBeritaModalLabel">Tambah Berita Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judul">Judul Berita</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <input type="text" class="form-control" id="kategori" name="kategori" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" class="form-control-file" id="gambar" name="gambar">
                    </div>
                    <div class="form-group">
                        <label for="isi">Isi Berita</label>
                        <textarea class="form-control" id="isi" name="isi" rows="6" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Berita -->
<div class="modal fade" id="editBeritaModal" tabindex="-1" role="dialog" aria-labelledby="editBeritaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBeritaModalLabel">Edit Berita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editBeritaForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_judul">Judul Berita</label>
                        <input type="text" class="form-control" id="edit_judul" name="judul" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_kategori">Kategori</label>
                        <input type="text" class="form-control" id="edit_kategori" name="kategori" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="edit_tanggal" name="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_gambar">Gambar Baru (Opsional)</label>
                        <input type="file" class="form-control-file" id="edit_gambar" name="gambar">
                    </div>
                    <div class="form-group">
                        <label for="edit_isi">Isi Berita</label>
                        <textarea class="form-control" id="edit_isi" name="isi" rows="6" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#dataTable').DataTable();

        // Handle Edit Button Click
        $('.edit-berita').click(function() {
            var id = $(this).data('id');
            var judul = $(this).data('judul');
            var kategori = $(this).data('kategori');
            var tanggal = $(this).data('tanggal');
            var isi = $(this).data('isi');

            $('#editBeritaForm').attr('action', '/admin/berita/' + id);
            $('#edit_judul').val(judul);
            $('#edit_kategori').val(kategori);
            $('#edit_tanggal').val(tanggal);
            $('#edit_isi').val(isi);
        });
    });
</script>
@endpush

@endsection
