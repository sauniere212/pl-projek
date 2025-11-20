<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Organisasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container mt-5">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>