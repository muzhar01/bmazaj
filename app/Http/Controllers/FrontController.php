<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Audio;

class FrontController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function playlist($id)
    {
        $result['audio']=Audio::where('id',$id)->get();
        return view('front.playlist',$result);
    }

}
