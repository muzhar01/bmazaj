<?php

namespace App\Http\Controllers\Admin;
    
use App\Http\Controllers\Controller;
use App\Models\Admin\Logo;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['logo']=Logo::first();
        return view('admin.logo.index',$result);
    }
    public function store(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);
        $model=Logo::find(1);
        if($request->hasFile('image')){
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media/logo',$image_name);
            $model->image=$image_name;
        }
        if($model->save()){
            $request->session()->flash('success','Logo Added Successfully');
            return redirect('admin/logo');
        }else{
            $request->session()->flash('error','Failed to Add');
            return redirect('admin/logo');
        }
    }

}
