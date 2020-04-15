@extends('layouts.app');
@section('content')
<div class='container'>
    <div class="row">
        <h2>Crear un nuevo Video</h2>
        <hr/>
        <form action="{{url('/guardar-video')}}" method="post" enctype="multipart/form-data" class="col-log-7">
        {!! csrf_field() !!}

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}"/>
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea class="form-control" id="description" name="description" >{{old('description')}}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Miniatura</label>
                <input type="file" class="form-control" id="image" name="image"/>
            </div>
            <div class="form-group">
                <label for="video">Archivo de vídeo</label>
                <input type="file" class="form-control" id="video" name="video"/>
            </div>
            <button type="submit" class="btn btn-success">Subir Vídeo</button>
        </form>
        </div>
</div>


@endsection
