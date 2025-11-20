@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kelola Template Berita</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTemplateModal">
                            <i class="fas fa-plus"></i> Tambah Template Berita
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="templateTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Halaman</th>
                                    <th>Judul Content</th>
                                    <th>Kategori</th>
                                    <th>Penulis</th>
                                    <th>Gambar</th>
                                    <th>Status</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($templatePages as $index => $template)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $template->judul_halaman }}</td>
                                    <td>{{ $template->judul_content }}</td>
                                    <td>{{ $template->kategori ?? '-' }}</td>
                                    <td>{{ $template->penulis ?? '-' }}</td>
                                    <td>
                                        @if($template->gambar)
                                            <img src="{{ asset('storage/' . $template->gambar) }}" 
                                                 alt="Gambar" 
                                                 style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                        @else
                                            <span class="text-muted">Tidak ada gambar</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge {{ $template->is_active ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $template->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td>{{ $template->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-info edit-template-btn" data-id="{{ $template->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm {{ $template->is_active ? 'btn-warning' : 'btn-success' }} toggle-status-btn" 
                                                    data-id="{{ $template->id }}">
                                                <i class="fas {{ $template->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger delete-template-btn" data-id="{{ $template->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Template -->
<div class="modal fade" id="addTemplateModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Template Berita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addTemplateForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="judul_halaman" class="form-label">Judul Halaman *</label>
                                <input type="text" class="form-control" id="judul_halaman" name="judul_halaman" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal *</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="judul_content" class="form-label">Judul Content *</label>
                                <input type="text" class="form-control" id="judul_content" name="judul_content" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <input type="text" class="form-control" id="kategori" name="kategori">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="penulis" class="form-label">Penulis</label>
                                <input type="text" class="form-control" id="penulis" name="penulis">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                                <div class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB</div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="isi_content" class="form-label">Isi Berita *</label>
                        <textarea class="form-control" id="isi_content" name="isi_content" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="navbar_id" class="form-label">Menu Navigasi *</label>
                        <select class="form-control" id="navbar_id" name="navbar_id" required>
                            <option value="">Pilih Menu</option>
                            @foreach($navbars as $navbar)
                                <option value="{{ $navbar->id }}">{{ $navbar->nama_menu }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Template -->
<div class="modal fade" id="editTemplateModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Template Berita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editTemplateForm" enctype="multipart/form-data">
                <input type="hidden" id="edit_id" name="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_judul_halaman" class="form-label">Judul Halaman *</label>
                                <input type="text" class="form-control" id="edit_judul_halaman" name="judul_halaman" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_tanggal" class="form-label">Tanggal *</label>
                                <input type="date" class="form-control" id="edit_tanggal" name="tanggal" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_judul_content" class="form-label">Judul Content *</label>
                                <input type="text" class="form-control" id="edit_judul_content" name="judul_content" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_kategori" class="form-label">Kategori</label>
                                <input type="text" class="form-control" id="edit_kategori" name="kategori">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_penulis" class="form-label">Penulis</label>
                                <input type="text" class="form-control" id="edit_penulis" name="penulis">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_gambar" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="edit_gambar" name="gambar" accept="image/*">
                                <div class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.</div>
                                <div id="current_image" class="mt-2"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_isi_content" class="form-label">Isi Berita *</label>
                        <textarea class="form-control" id="edit_isi_content" name="isi_content" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Set tanggal hari ini
    $('#tanggal').val(new Date().toISOString().split('T')[0]);
    
    // Event handlers untuk tombol aksi
    $(document).on('click', '.edit-template-btn', function() {
        var id = $(this).data('id');
        editTemplate(id);
    });
    
    $(document).on('click', '.toggle-status-btn', function() {
        var id = $(this).data('id');
        toggleStatus(id);
    });
    
    $(document).on('click', '.delete-template-btn', function() {
        var id = $(this).data('id');
        deleteTemplate(id);
    });
    
    // Form tambah template
    $('#addTemplateForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        
        $.ajax({
            url: '{{ route("admin.template-berita.store") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: response.message,
                        icon: 'success'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message,
                        icon: 'error'
                    });
                }
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                var errorMessage = '';
                for (var field in errors) {
                    errorMessage += errors[field][0] + '\n';
                }
                Swal.fire({
                    title: 'Error!',
                    text: errorMessage,
                    icon: 'error'
                });
            }
        });
    });
    
    // Form edit template
    $('#editTemplateForm').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        var id = $('#edit_id').val();
        
        $.ajax({
            url: '{{ route("admin.template-berita.update", ":id") }}'.replace(':id', id),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-HTTP-Method-Override': 'PUT'
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: response.message,
                        icon: 'success'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message,
                        icon: 'error'
                    });
                }
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                var errorMessage = '';
                for (var field in errors) {
                    errorMessage += errors[field][0] + '\n';
                }
                Swal.fire({
                    title: 'Error!',
                    text: errorMessage,
                    icon: 'error'
                });
            }
        });
    });
});

function editTemplate(id) {
    $.ajax({
        url: '{{ route("admin.template-berita.edit", ":id") }}'.replace(':id', id),
        type: 'GET',
        success: function(response) {
            $('#edit_id').val(response.id);
            $('#edit_judul_halaman').val(response.judul_halaman);
            $('#edit_tanggal').val(response.tanggal);
            $('#edit_judul_content').val(response.judul_content);
            $('#edit_kategori').val(response.kategori);
            $('#edit_penulis').val(response.penulis);
            $('#edit_isi_content').val(response.isi_content);
            
            // Tampilkan gambar saat ini
            if (response.gambar) {
                $('#current_image').html('<img src="{{ asset("storage") }}/' + response.gambar + '" style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">');
            } else {
                $('#current_image').html('<span class="text-muted">Tidak ada gambar</span>');
            }
            
            $('#editTemplateModal').modal('show');
        }
    });
}

function toggleStatus(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: 'Anda akan mengubah status template ini',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, ubah!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("admin.template-berita.toggle-status", ":id") }}'.replace(':id', id),
                type: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message,
                            icon: 'success'
                        }).then(() => {
                            location.reload();
                        });
                    }
                }
            });
        }
    });
}

function deleteTemplate(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: 'Data yang dihapus tidak dapat dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("admin.template-berita.destroy", ":id") }}'.replace(':id', id),
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message,
                            icon: 'success'
                        }).then(() => {
                            location.reload();
                        });
                    }
                }
            });
        }
    });
}
</script>
@endsection
