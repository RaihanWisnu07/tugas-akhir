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

<body class="bg-light">
    <div class="container">
        <div class="row d-flex justify-content-center mt-4">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Foto Form</h2>
                    </div>
                    <form action="{{ route('foto.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="" class="form-label">Judul Foto</label>
                                <input type="text" name="judulFoto" class="form-control">
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="" class="form-label">Deskripsi Foto</label>
                                <textarea name="deskripsiFoto" class="form-control"></textarea>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="" class="form-label">Lokasi File</label>
                                <input type="file" name="lokasiFile" class="form-control">
                            </div>
                            <br>
                            <div class="form-group"></div>
                            <label for="" class="form-label">Album</label>
                            <select name="albumId" class="form-control">
                                @foreach ($albums as $album)
                                    <option value="{{ $album->id }}">{{ $album->namaAlbum }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-footer">
                            <button class="w-100 btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
