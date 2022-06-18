<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Audio;
use App\Models\Admin\Category;

class AdminDashboard extends Controller
{
    public function index(){
        $result['category']=Category::all();
        $result['audio']=Audio::all();
        return view('admin.dashboard',$result);
    }
}
