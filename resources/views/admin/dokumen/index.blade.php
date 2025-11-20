@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Manajemen Dokumen</h1>
    <p class="mb-4">Halaman untuk mengelola dokumen DISPERUMKIM Kota Bogor</p>

    <!-- DataTables -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Dokumen</h6>
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#tambahDokumenModal">
                Tambah Dokumen
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Dokumen</th>
                            <th>Keterangan/Tentang</th>
                            <th>Kategori</th>
                            <th>File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dokumens as $index => $dokumen)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $dokumen->judul }}</td>
                            <td>{{ $dokumen->deskripsi }}</td>
                            <td>{{ $dokumen->kategori }}</td>
                            <td>
                                @if($dokumen->file_path)
                                    <a href="{{ asset('storage/'.$dokumen->file_path) }}" class="btn btn-info btn-sm" target="_blank">
                                        <i class="fas fa-file"></i> Lihat File
                                    </a>
                                @else
                                    Tidak ada file
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm edit-dokumen" 
                                        data-id="{{ $dokumen->id }}"
                                        data-judul="{{ $dokumen->judul }}"
                                        data-deskripsi="{{ $dokumen->deskripsi }}"
                                        data-kategori="{{ $dokumen->kategori }}"
                                        data-toggle="modal" data-target="#editDokumenModal">
                                    Edit
                                </button>
                                <form action="{{ route('admin.dokumen.destroy', $dokumen->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')">Hapus</button>
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

<!-- Modal Tambah Dokumen -->
<div class="modal fade" id="tambahDokumenModal" tabindex="-1" role="dialog" aria-labelledby="tambahDokumenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDokumenModalLabel">Tambah Dokumen Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.dokumen.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judul">Nama Dokumen</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Keterangan/Tentang</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <input type="text" class="form-control" id="kategori" name="kategori" required>
                    </div>
                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" class="form-control-file" id="file" name="file" required>
                        <small class="form-text text-muted">Format yang diizinkan: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX. Maksimal 10MB.</small>
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

<!-- Modal Edit Dokumen -->
<div class="modal fade" id="editDokumenModal" tabindex="-1" role="dialog" aria-labelledby="editDokumenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDokumenModalLabel">Edit Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editDokumenForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_judul">Nama Dokumen</label>
                        <input type="text" class="form-control" id="edit_judul" name="judul" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_deskripsi">Keterangan/Tentang</label>
                        <textarea class="form-control" id="edit_deskripsi" name="deskripsi" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_kategori">Kategori</label>
                        <input type="text" class="form-control" id="edit_kategori" name="kategori" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_file">File Baru (Opsional)</label>
                        <input type="file" class="form-control-file" id="edit_file" name="file">
                        <small class="form-text text-muted">Format yang diizinkan: PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX. Maksimal 10MB.</small>
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
        $('.edit-dokumen').click(function() {
            var id = $(this).data('id');
            var judul = $(this).data('judul');
            var deskripsi = $(this).data('deskripsi');
            var kategori = $(this).data('kategori');

            $('#editDokumenForm').attr('action', '/admin/dokumen/' + id);
            $('#edit_judul').val(judul);
            $('#edit_deskripsi').val(deskripsi);
            $('#edit_kategori').val(kategori);
        });
    });
</script>
@endpush

@endsection
