@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Manajemen Carousel</h1>
    <p class="mb-4">Halaman untuk mengelola carousel website Disperum.</p>

    <!-- DataTables -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Carousel</h6>
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#tambahCarouselModal">
                Tambah Carousel
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Urutan</th>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carousels as $index => $carousel)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $carousel->judul }}</td>
                            <td>{{ Str::limit($carousel->deskripsi, 50) }}</td>
                            <td>{{ $carousel->urutan }}</td>
                            <td>
                                @if($carousel->gambar)
                                    <img src="{{ asset('storage/'.$carousel->gambar) }}" alt="Gambar Carousel" width="100">
                                @else
                                    Tidak ada gambar
                                @endif
                            </td>
                            <td>{{ $carousel->status }}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm edit-carousel" 
                                        data-id="{{ $carousel->id }}"
                                        data-judul="{{ $carousel->judul }}"
                                        data-deskripsi="{{ $carousel->deskripsi }}"
                                        data-urutan="{{ $carousel->urutan }}"
                                        data-status="{{ $carousel->status }}"
                                        data-toggle="modal" data-target="#editCarouselModal">
                                    Edit
                                </button>
                                <form action="{{ route('admin.carousel.destroy', $carousel->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus carousel ini?')">Hapus</button>
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

<!-- Modal Tambah Carousel -->
<div class="modal fade" id="tambahCarouselModal" tabindex="-1" role="dialog" aria-labelledby="tambahCarouselModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahCarouselModalLabel">Tambah Carousel Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.carousel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" class="form-control-file" id="gambar" name="gambar">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="Aktif">Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>
                        </select>
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

<!-- Modal Edit Carousel -->
<div class="modal fade" id="editCarouselModal" tabindex="-1" role="dialog" aria-labelledby="editCarouselModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCarouselModalLabel">Edit Carousel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editCarouselForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_judul">Judul</label>
                        <input type="text" class="form-control" id="edit_judul" name="judul">
                    </div>
                    <div class="form-group">
                        <label for="edit_deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="edit_deskripsi" name="deskripsi" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_urutan">Urutan</label>
                        <input type="number" class="form-control" id="edit_urutan" name="urutan">
                    </div>
                    <div class="form-group">
                        <label for="edit_gambar">Gambar Baru (Opsional)</label>
                        <input type="file" class="form-control-file" id="edit_gambar" name="gambar">
                    </div>
                    <div class="form-group">
                        <label for="edit_status">Status</label>
                        <select class="form-control" id="edit_status" name="status">
                            <option value="Aktif">Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>
                        </select>
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
        $('.edit-carousel').click(function() {
            var id = $(this).data('id');
            var judul = $(this).data('judul');
            var deskripsi = $(this).data('deskripsi');
            var urutan = $(this).data('urutan');
            var status = $(this).data('status');

            $('#editCarouselForm').attr('action', '/admin/carousel/' + id);
            $('#edit_judul').val(judul);
            $('#edit_deskripsi').val(deskripsi);
            $('#edit_urutan').val(urutan);
            $('#edit_status').val(status);
        });
    });
</script>
@endpush

@endsection
