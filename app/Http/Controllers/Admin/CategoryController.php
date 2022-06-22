<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   
    public function index()
    {  
        $result['category']=Category::orderBy('order_position','asc')->get();
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
        $model->color = $request->input('color');
        if($request->hasFile('image')){
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media/category',$image_name);
            $model->image=$image_name;
        }
        $model->description=$request->input('description');
        $model->status='1';
        $model->order_position='0';
        $model->font_color=$request->input('font_color');
        if($model->save()){
            $request->session()->flash('success','Category Added Successfully');
            return redirect('admin/category');
        }else{
            $request->session()->flash('error','Failed to Add');
            return redirect('admin/category');
        }
    }

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

    public function update(Request $request, Category $category)
    {
        $model=Category::find($request->post('id'));
        $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg',
            'description'=>'required'
        ]);
        $model->name=$request->input('name');
        $model->color = $request->input('color');
        if ($request->hasFile('image')) {
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media/category', $image_name);
            $model->image=$image_name;
        }
        $model->font_color=$request->input('font_color');
        $model->description=$request->input('description');
        if($model->save()){
            $request->session()->flash('success','Category Updated Successfully');
            return redirect('admin/category');
        }else{
            $request->session()->flash('error','Failed to Update');
            return redirect('admin/category');
        }
    }

    public function destroy(Category $category,$id)
    {
        $model=Category::find($id);
        $filePathName =public_path('/storage/media/category/'.$model->image);
        if( $filePathName ){
            unlink($filePathName);
        }
        if($model->delete()){
            session()->flash('success','Deleted Successfully');
            return redirect('admin/category');
        }else{
            session()->flash('success','Failed to delete Status');
            return redirect('admin/category');
        }
    }
    public function updatePosition(Request $request){
        $allData = $request->post('allData');
     
        foreach($allData as $key=>$val ){
            $category = Category::find($val);
            $category->order_position = $key;
            $category->update();
          
        }
       
        return response()->json('Position Change Successfully');
    }
}
