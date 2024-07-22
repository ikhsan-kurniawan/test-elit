@extends('layouts.app')
@section('content')

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Data Pekerjaan</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body>
    <div class="container">
        <div class=" form-row">
            <div class="col-lg-12">
                <h3>Detail Pekerjaan</h3>
            </div>
        </div>
        <br>

        <div class="form-group row">
            <label for="namaPekerjaan" class="col-sm-2 col-form-label">Nama Pekerjaan</label>
            <div class="col-sm-10">
                {{$pekerjaan->namaPekerjaan}} 
            </div>
        </div>
        <div class="form-group row">
            <label for="alamatPekerjaan" class="col-sm-2 col-form-label">Alamat Pekerjaan</label>
            <div class="col-sm-10">
                {{$pekerjaan->alamatPekerjaan}}
            </div>
        </div>
        <div class="form-group row">
            <label for="nomorHP" class="col-sm-2 col-form-label">Nomor HP</label>
            <div class="col-sm-10">
                 {{$pekerjaan->nomorHP}}
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12">
                <a href="{{route('pekerjaan.index')}}" class="btn  btn-success">Kembali</a>
            </div>
        </div>

    </div>
</body>
</html>

@endsection