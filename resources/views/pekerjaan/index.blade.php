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
        <div class="row">
            <div class="col-md-10">
                <h3> Daftar Pekerjaan</h3>
            </div>
            <div class="col-sm-2">
                <a class="btn btn-success" href="{{ route('pekerjaan.create')}}"> Tambah Pekerjaan </a>
            </div>
        </div> 
        <br>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{$message}}</p>        
        </div>
    @endif

    <table class="table table-striped">
      <thead>
        <tr>
            <th width="40px"><b>No.</b></th>
            <th width="180px">Nama Pekerjaan</th>
            <th width="100px">Alamat Pekerjaan</th>
            <th width="100px">Nomer HP</th>
            <th width="210px">Action</th>
        </tr>
      </thead>
        @foreach ($pekerjaans as $pekerjaan) 
            <tr>
                <td><b>{{++$i}}.<b></td>
                <td>{{$pekerjaan->namaPekerjaan}}</td>
                <td>{{$pekerjaan->alamatPekerjaan}}</td>
                <td>{{$pekerjaan->nomorHP}}</td>
                <td>
                    <form action="{{ route('pekerjaan.destroy',$pekerjaan->id) }}" method="post">
                    <a class="btn btn-sm btn-success" href="{{ route('pekerjaan.show', $pekerjaan->id)}}">Show</a>
                    <a class="btn btn-sm btn-warning" href="{{ route('pekerjaan.edit', $pekerjaan->id)}}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>    
                </td>
            </tr>
        @endforeach
    </table>

    {!! $pekerjaans->links() !!}
    </div>
    </body>

</html>

@endsection