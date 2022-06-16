<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function auth(Request $request)
    {
        $email=$request->post('email');
        $password=$request->post('password');
        // $result=Admin::where(['email'=>$email,'password'=>$password])->get();
        $result=Admin::where(['email'=>$email])->first();
        if($result){
            if(Hash::check($password,$result->password)){
                $request->session()->put('ADMIN_LOGIN',true);
                $request->session()->put('ADMIN_Id',$result->id);
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

    // public function update(Admin $admin)
    // {
    //     $r=Admin::find(1);
    //     $r->password=Hash::make('admin');
    //     $r->save();
    // }
}
