<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin/login');
    }

    public function auth(Request $request)
    {
        $email = $request->post('email');
        $password = $request->post('password');
        $result = Admin::where(['email' => $email])->first();
        if ($result) {
            if (Hash::check($password, $result->password)) {
                $request->session()->put('ADMIN_LOGIN', true);
                $request->session()->put('ADMIN_ID', $result->id);
                return redirect('admin/dashboard');
            } else {
                $request->session()->flash('error', 'Please enter valid password');
                return redirect('/admin');
            }
        } else {
            $request->session()->flash('error', 'Please enter valid email');
            return redirect('/admin');
        }
    }
    public function logout()
    {
        session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_ID');
        session()->flash('success', 'Logout successfully');
        return redirect('/admin');
    }
    public function profile()
    {
        $result['data'] = Admin::first();
        return view('admin.profile.index', $result);
    }
    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        $model = Admin::find($request->session()->get('ADMIN_ID'));
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'mimes:jpeg,png,jpg'
            ]);
            $image = $request->file('image');
            $ext = $image->extension();
            $image_name = time() . '.' . $ext;
            $image->storeAs('/public/media/admin', $image_name);
            $model->image = $image_name;
            $model->update();
        }
        $model->name = $request->input('name');
        $model->email = $request->input('email');
        $update = $model->update();

        if ($update) {
            $request->session()->flash('success', 'Profile Updated Successfully');
            return redirect('admin/profile');
        } else {
            $request->session()->flash('error', 'Failed to Update');
            return redirect('admin/profile');
        }
    }
    public function updatePassword(Request $request)
    {
        $validator  = $request->validate([
            'password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required_with:new_password|same:new_password'
        ]); 
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
         }
        $check = Admin::find($request->session()->get('ADMIN_ID'));
        if (Hash::check($request->input('password'), $check->password)) {

        }else{
            return response()->json('current_password','You enter invalid password');
        }
    }
}
