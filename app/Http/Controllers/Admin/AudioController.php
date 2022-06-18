<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Audio;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AudioController extends Controller
{
    public function index()
    {
        $result['audio']=Audio::all();
        return view('admin.audio.index',$result);
    }
    public function create()
    {
        $result['category']=Category::where('status','1')->get();
        return view('admin.audio.create',$result);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:audios',
            'category_id' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg',
            'audio' =>'nullable|file|mimes:audio/mpeg,mpga,mp3,wav,aac',
            'description'=>'required'
        ]);
        $model=new Audio();
        $model->title=$request->input('title');
        $model->category_id=$request->input('category_id');
        if($request->hasFile('thumbnail')){
            $image=$request->file('thumbnail');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media/audio',$image_name);
            $model->thumbnail=$image_name;
        }
        
        if($request->hasFile('audio')){
            $file = $request->file('audio');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('/public/media/audio/file', $filename);
            $model->audio=$filename; 
        }
        $model->description=$request->input('description');
        $model->status='1';
        if($model->save()){
            $request->session()->flash('success','Audio Added Successfully');
            return redirect('admin/audio');
        }else{
            $request->session()->flash('error','Failed to Add');
            return redirect('admin/audio');
        }
    }
    public function edit(Audio $audtio,$id)
    {
        $result['category']=Category::where('status','1')->get();
        $result['audio']=Audio::where('id','=',$id)->first();
        return view('admin.audio.edit',$result);
    }
    public function update(Request $request)
    {
        $model=Audio::find($request->post('id'));
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg',
            'description'=>'required'
        ]);
        $model->title=$request->input('title');
        $model->category_id=$request->input('category_id');
        if($request->hasFile('thumbnail')){
            $image=$request->file('thumbnail');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media/audio',$image_name);
            $model->thumbnail=$image_name;
        }
        $model->description=$request->input('description');
        $model->status='1';
        if($model->save()){
            $request->session()->flash('success','Audio Updated Successfully');
            return redirect('admin/audio');
        }else{
            $request->session()->flash('error','Failed to Update');
            return redirect('admin/audio');
        }
    }
    public function status($status,$id)
    {
        $model=Audio::find($id);
        $model->status=$status;
        if($model->save()){
            session()->flash('success','Status Change Successfully');
            return redirect('admin/audio');
        }else{
            session()->flash('success','Failed to Change Status');
            return redirect('admin/audio');
        }
    }
    public function destroy(Audio $audio,$id)
    {
        $model=Audio::find($id);
        $filePathName =public_path().'/storage/media/audio/'.$model->thumbnail;
        if(file_exists($filePathName)) {
            unlink($filePathName);
        }
        if ($model->delete()) {
            session()->flash('success', 'Deleted Successfully');
            return redirect('admin/audio');
        } else {
            session()->flash('success', 'Failed to delete Status');
            return redirect('admin/audio');
        }
    }
}
