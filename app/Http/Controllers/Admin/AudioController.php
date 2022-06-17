<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Audio;
use Illuminate\Http\Request;

class AudioController extends Controller
{
    public function index()
    {
        return view('admin.audio.index');
    }
}
