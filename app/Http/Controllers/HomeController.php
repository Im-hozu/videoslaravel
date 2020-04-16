<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Video;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //Usando querybuilder
        //$videos = DB::table('videos')->paginate(5);

        //Usando el modelo
        $videos = Video::orderBy('id','desc')->paginate(5);
        return view('home',array(
            'videos' => $videos

           
        ));
    }
}
