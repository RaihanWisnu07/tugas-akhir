<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Foto Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- Menampilkan Foto dengan Grid Bootstrap -->
    <div class="container mt-4">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col-md-12">
                <a href="/dashboard" class="btn btn-primary">Back</a>
                <br>
                <br>
                <div class="card">
                    <div class="d-flex">
                        <img style="margin-right: 30px;width: 40rem" src="{{ asset($photo->lokasiFile) }}"
                            alt="">
                        <div>
                            <h2>{{ $photo->judulFoto }}</h2>
                            <p>{{ $photo->deskripsiFoto }}</p>
                            <p> Dibuat Oleh:{{ $photo->user->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="{{ route('komentar.post', ['id' => $photo->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="komentar">Komentar:</label>
                        <textarea class="form-control" name="komentar" id="komentar" rows="3" placeholder="Tulis komentar Anda"></textarea>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @foreach ($comment as $komen)
                    <br>
                    <div class="card">
                        <div class="card-header">
                            By : {{ $komen->user->name }}
                        </div>
                        <div class="card-body">
                            {{ $komen->komentar }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
