<?php

namespace App\Http\Controllers;

use App\Models\SpSettings;
use Illuminate\Http\Request;

class SpSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sps = SpSettings::all();
        return view('admin.sp_settings.index', $sps);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SpSettings  $spSettings
     * @return \Illuminate\Http\Response
     */
    public function show(SpSettings $spSettings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SpSettings  $spSettings
     * @return \Illuminate\Http\Response
     */
    public function edit(SpSettings $spSettings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SpSettings  $spSettings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpSettings $spSettings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SpSettings  $spSettings
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpSettings $spSettings)
    {
        //
    }
}