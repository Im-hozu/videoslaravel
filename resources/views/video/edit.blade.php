@extends('layouts.app');

@section('content')
    <div class="container">
        <div class="row">
            <h2>Editar {{$video->title}}</h2>
        <hr/>
        <form action="{{route("videoUpdate",['video_id' => $video->id] )}}" method="post" enctype="multipart/form-data" class="col-log-7">
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
                <input type="text" class="form-control" id="title" name="title" value="{{$video->title}}"/>
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea class="form-control" id="description" name="description" >{{$video->description}}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Miniatura</label>
                @if(Storage::disk('images')->has($video->image))
                        <div class="video-image-thumb">
                            <div class="video-image-mask">
                            <img src="{{url('/miniatura/'.$video->image)}}" class="video-image" />
                            </div>
                        </div>
                        @endif
                <input type="file" class="form-control" id="image" name="image" value="{{$video->image_path}}"/>
            </div>
            <div class="form-group">
                <label for="video">Archivo de vídeo</label><br/>
                <video controls id="video-player" class="edit">
                <source src="{{ route('fileVideo',['filename' => $video->video_path]) }}">
                Tu navegador no es compatible con html5
                </video>
                <input type="file" class="form-control" id="video" name="video"/>
            </div>
            <button type="submit" class="btn btn-success">Modificar Vídeo</button>
        </form>
        </div>
        </div>
    </div>

@endsection