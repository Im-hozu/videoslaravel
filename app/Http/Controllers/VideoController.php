<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Video;
use App\Comment;


class VideoController extends Controller
{
    public function createVideo(){
        return view('video.createVideo');
    }

    public function saveVideo(Request $request){
        //Validación del formulario
        $validatedData = $this->validate($request, [
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'video' => 'mimes:mp4'
        ]);

        $video = new Video();
        $user = \Auth::user();
        $video->user_id = $user->id;
        $video->title = $request->input('title');
        $video->description = $request->input('description');

        //Subida de la miniatura
        $image = $request->file('image');
        if($image){
            $image_path = time().$image->getClientOriginalName();
            \Storage::disk('images')->put($image_path, \File::get($image));
            $video->image = $image_path;
        }

        //Subida del video
        $video_file = $request->file('video');
        if($video_file){
            $video_path = time().$video_file->getClientOriginalName();
            \Storage::disk('videos')->put($video_path,\File::get($video_file));
            $video->video_path = $video_path;
        }

        $video->save();

        return redirect('\home')->with(array(
            'message' => 'El vídeo se ha subido correctamente'
        ));
    }

    //Devuelve la imagen 
    public function getImage($filename){
        $file = \Storage::disk('images')->get($filename);

        return new Response($file, 200);
    }

    //Nos carga la página de un video en concreto
    public function getVideoDetail($video_id){
        $video = Video::find($video_id);
        return view('video.detail',array(
            'video' => $video
        ));

    }

    //Devuelve el video 
    public function getVideo($filename){
        $file = \Storage::disk('videos')->get($filename);

        return new Response($file, 200);
    }

    public function delete($video_id){
        $user = \Auth::user();
        $video = Video::find($video_id);
        $comments = Comment::where('video_id',$video_id);

        if($user && $video->user_id == $user->id){
            //Eliminar los comentarios
            $comments->delete();
            
            

            //Eliminar ficheros
            Storage::disk('images')->delete($video->image);
            Storage::disk('videos')->delete($video->video_path);

            //Eliminar registro
            $video->delete();
            $message = array('message'=>'Video eliminado correctamente');
        }else{
            $message = array('message'=>'El video no se ha podido eliminar');
        }

        return redirect()->route('home')->with($message);
    }

    public function edit($video_id){
        $user = \Auth::user();
        $video = Video::find($video_id);
        if($user && $video->user_id == $user->id){
            $video = Video::findOrFail($video_id);
            return view('video.edit',array(
                'video' => $video
            ));

        }else{
            return redirect()->route('home')->with($message);
        }
    }

    public function update($video_id,Request $request){
        $validate = $this->validate($request,array(
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'video' => 'mimes:mp4'
        ));

        $user = \Auth::user();
        $video = Video::findOrFail($video_id);
        $video->user_id = $user->id;
        $video->title = $request->input('title');
        $video->description = $request->input('description');
        
        //Subida de la miniatura
        $image = $request->file('image');
        if($image){
            $image_path = time().$image->getClientOriginalName();
            \Storage::disk('images')->put($image_path, \File::get($image));
            $video->image = $image_path;
        }

        //Subida del video
        $video_file = $request->file('video');
        if($video_file){
            $video_path = time().$video_file->getClientOriginalName();
            \Storage::disk('videos')->put($video_path,\File::get($video_file));
            $video->video_path = $video_path;
        }

        $video->update();

        return redirect()->route('home')->with('message','El video se ha actualizado correctamente');
    }

}
