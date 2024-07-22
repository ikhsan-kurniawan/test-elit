@extends('layouts.app')
@section('content')

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Data Alumni</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body>
    <div class="container">
        <div class=" form-row">
            <div class="col-lg-12">
                <h3>Edit Data Pekerjaan</h3>
            </div>
        </div>
        <br>

        @if ($errors->all())
            <div class="alert alert-danger">
                <strong>Whoops! </strong> Ada permasalahan inputanmu.<br>
                <ul>
                    @foreach ($errors as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{route('pekerjaan.update',$pekerjaan->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label for="namaPekerjaan" class="col-sm-2 col-form-label">Nama Pekerjaan</label>
                <div class="col-sm-10">
                    <input type="text" name="namaPekerjaan" class="form-control" id="namaPekerjaan" value="{{$pekerjaan->namaPekerjaan}}" placeholder="Nama Pekerjaan">
                </div>
            </div>
            <div class="form-group row">
                <label for="alamatPekerjaan" class="col-sm-2 col-form-label">Alamat Pekerjaan</label>
                <div class="col-sm-10">
                    <input type="text" name="alamatPekerjaan"  class="form-control" id="alamatPekerjaan" value="{{$pekerjaan->alamatPekerjaan}}" placeholder="Alamat Pekerjaan">
                </div>
            </div>
            <div class="form-group row">
                <label for="nomorHP" class="col-sm-2 col-form-label">Nomor HP</label>
                <div class="col-sm-10">
                    <input type="text" name="nomorHP"  class="form-control" id="nomorHP" value="{{$pekerjaan->nomorHP}}" placeholder="Nomor HP">
                </div>
            </div>
             <hr>
                <div class="form-group">
                    <a href="{{route('pekerjaan.index')}}" class="btn btn-success">Kembali</a>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
        </form>

    </div>
    </body>
</html>
    
@endsection