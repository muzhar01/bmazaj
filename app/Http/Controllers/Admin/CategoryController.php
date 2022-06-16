<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   
    public function index()
    {  
        $result['category']=Category::all();
        return view('admin.category.index',$result);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'description'=>'required'
        ]);
        $model=new Category();
        $model->name=$request->input('name');
        if($request->hasFile('image')){
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media/category',$image_name);
            $model->image=$image_name;
        }
        $model->description=$request->input('description');
        $model->status='1';
        if($model->save()){
            $request->session()->flash('success','Category Added Successfully');
            return redirect('admin/category');
        }else{
            $request->session()->flash('error','Category Added Successfully');
            return redirect('admin/category');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function status(Category $category,$status,$id)
    {
        $model=Category::find($id);
        $model->status=$status;
        if($model->save()){
            session()->flash('success','Status Change Successfully');
            return redirect('admin/category');
        }else{
            session()->flash('success','Failed to Change Status');
            return redirect('admin/category');
        }
    }

    public function edit(Category $category,$id)
    {
        $category['category']=Category::where('id','=',$id)->first();
        return view('admin.category.edit',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $model=Category::find($request->post('id'));
        $request->validate([
            'name' => 'required|unique:categories',
            'image' => 'image|mimes:jpeg,png,jpg',
            'description'=>'required'
        ]);
        $model->name=$request->input('name');
        if($request->hasFile('image')){
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media/category',$image_name);
            $model->image=$image_name;
        }
        $model->description=$request->input('description');
        if($model->save()){
            $request->session()->flash('success','Category Updated Successfully');
            return redirect('admin/category');
        }else{
            $request->session()->flash('error','Failed to Update');
            return redirect('admin/category');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category,$id)
    {
        $model=Category::find($id);
        
        if($model->delete()){
            session()->flash('success','Deleted Successfully');
            return redirect('admin/category');
        }else{
            session()->flash('success','Failed to delete Status');
            return redirect('admin/category');
        }
    }
}
