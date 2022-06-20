<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $result['color'] = Color::first();
        return view('admin.color.index', $result);
    }
    public function store(Request $request)
    {
        $request->validate([
            'color' => 'required',
        ]);
        $model = Color::find(1);
        $model->color = $request->post('color');
        $model->save();
        if ($model->save()) {
            $request->session()->flash('success', 'Color Added Successfully');
            return redirect('admin/color');
        } else {
            $request->session()->flash('error', 'Failed to Add');
            return redirect('admin/color');
        }
    }
}
