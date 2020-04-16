@extends('layouts.app')

@section('content')
    <div class="col-md-10 col-md-offset-3">
        <h2>{{$video->title}}</h2>
        <hr/>

        <div class="col-md-8">
            <!--Video-->
            <video controls id="video-player">
                <source src="{{ route('fileVideo',['filename' => $video->video_path]) }}">
                Tu navegador no es compatible con html5
            </video>
            <!--Descripcion-->
            <div class="panel panel-default video-data">
                <div class="panel-heading">
                    <div class="panel-title">
                    Subido por <strong><a href="">{{$video->user->name.' '.$video->user->surname.'  '}}</a></strong>{{\FormatTime::LongTimeFilter($video->created_at)}}
                    </div>
                </div>
                <div class="panel-body">
                    {{$video->description}}
                </div>
            </div>
            <!--Comentarios-->
        </div>
    </div>
@endsection