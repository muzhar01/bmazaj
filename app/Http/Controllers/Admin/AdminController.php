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
        $email=$request->post('email');
        $password=$request->post('password');
        $result=Admin::where(['email'=>$email])->first();
        if($result){
            if(Hash::check($password,$result->password)){
                $request->session()->put('ADMIN_LOGIN',true);
                $request->session()->put('ADMIN_ID',$result->id);
                return redirect('admin/dashboard');
            }else{
                $request->session()->flash('error','Please enter valid password');
                return redirect('/admin');
            }
        }else{
            $request->session()->flash('error','Please enter valid email');
            return redirect('/admin');
        }
    }
    public function logout(){
        session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_ID');
        session()->flash('success','Logout successfully');
        return redirect('/admin');

    }

}
