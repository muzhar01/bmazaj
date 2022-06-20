<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Audio;
use App\Models\Admin\Logo;

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
        $result['logo']=Logo::first();
        $result['audio']=Audio::where('category_id',$id)->get();
        return view('front.playlist',$result);
    }

}
