<?php

namespace App\Http\Controllers;

use App\Models\SpSettings;
use Illuminate\Http\Request;

class SpSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sps = SpSettings::all();
        return view('admin.sp_settings.index', ['sps' => $sps]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sp_settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|url',
            'email' => '',
            'password' => '',
            'remember_me' => '',
            'token' => '',
        ]);

        $sp = new SpSettings();
        $sp->fill($inputs);
        $sp->status = 0;
        $sp->remember_me = $request->remember_me ? 1 : 0;
        $sp->save();

        if($sp->id){
            $request->session()->flash('success','Category Added Successfully');
            return redirect()->route('sp-settings.index');
        }else{
            $request->session()->flash('error','Failed to Add');
        }
        return back();
    }

    /**
     * Change status of the specified resource.
     */
    public function show(SpSettings $sp_setting, Request $request)
    {
        $request->validate([
            'status' => 'required|integer'
        ]);

        if($sp_setting->id){
            $sp_setting->update(['status'=> $request->status]);
            return back()->with('success', 'Status changed' . ($sp_setting->token ? '' : ', Token does not exist'));
        }else{
            return back()->with('error', 'Some error, status not changed');
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SpSettings $sp_setting)
    {
        if($sp_setting->id){
            return view('admin.sp_settings.edit', ['sp'=> $sp_setting]);
        }else{
            session()->flash('error','Something wrong happend');
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SpSettings $sp_setting)
    {
        $inputs = $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|url',
            'email' => '',
            'password' => '',
            'remember_me' => '',
            'token' => '',
        ]);

        $sp = $sp_setting;
        $sp->fill($inputs);
        $sp->status = $request->status ? 1 : 0;
        $sp->remember_me = $request->remember_me ? 1 : 0;
        $sp->save();

        if($sp->id){
            $request->session()->flash('success','Service Provider Updated Successfully');
            return redirect()->route('sp-settings.index');
        }else{
            $request->session()->flash('error','Failed to Update');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SpSettings $sp_setting)
    {
        if($sp_setting->id){
            spSettings::destroy($sp_setting->id);
            session()->flash('success','Deleted Successfully');
        }else{
            session()->flash('error','Some error, Please refresh the page');
        }
        return back();
    }

}
