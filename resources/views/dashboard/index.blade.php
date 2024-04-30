<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">Gallery Foto</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('album') }}">Tambah Album</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('foto') }}">Tambah Foto</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <div class="container">
        <br><br>
        <div class="row d-flex justify-content-center">
            <div class="col-md-4">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Menampilkan Album sebagai Category Horizontal -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                    @if ($albums->isNotEmpty())
                        <h3>Album</h3>
                        <div>
                            @foreach ($albums as $album)
                                <a href="{{ route('dashboard.sort', $album->id) }}"
                                    class="btn btn-outline-primary mx-2">{{ $album->namaAlbum }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Menampilkan Foto dengan Grid Bootstrap -->
    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($fotos as $photo)
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <div class="position-relative">
                                <form action="{{ route('foto.destroy', ['id' => $photo->id]) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-danger btn-sm position-absolute top-0 start-0 mt-2 "
                                        onclick="confirmDelete({{ $photo->id }})" style="margin-left: 8px;">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                <img src="{{ asset($photo->lokasiFile) }}" class="card-img-top"
                                    alt="{{ $photo->judulFoto }}">
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $photo->judulFoto }}</h5>
                            <p class="card-text">{{ $photo->deskripsiFoto }}</p>
                            <p class="card-text" style="margin-right: 15px;">
                                {{ $likeCount[$photo->id] }} Likes</p>
                            <div class="d-flex">
                                <form action="{{ route('like', ['id' => $photo->id]) }}" method="POST"
                                    style="margin-right: 5px;">
                                    @csrf
                                    <input type="hidden" name="fotoId" value="{{ $photo->id }}">
                                    <button type="submit" class="btn btn-primary">Like</button>
                                </form>
                                <a href="{{ route('komentar', ['id' => $photo->id]) }}"
                                    class="btn btn-primary">Komentar</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
