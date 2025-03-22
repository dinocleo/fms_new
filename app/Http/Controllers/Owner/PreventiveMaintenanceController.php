<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\PreventiveMaintenance;
use Illuminate\Http\Request;

class PreventiveMaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return "dfsdfsd";
    }

    public function store_info(Request $request){


        return redirect()->back();



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
     * @param  \App\Models\PreventiveMaintenance  $preventiveMaintenance
     * @return \Illuminate\Http\Response
     */
    public function show(PreventiveMaintenance $preventiveMaintenance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PreventiveMaintenance  $preventiveMaintenance
     * @return \Illuminate\Http\Response
     */
    public function edit(PreventiveMaintenance $preventiveMaintenance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PreventiveMaintenance  $preventiveMaintenance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PreventiveMaintenance $preventiveMaintenance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PreventiveMaintenance  $preventiveMaintenance
     * @return \Illuminate\Http\Response
     */
    public function destroy(PreventiveMaintenance $preventiveMaintenance)
    {
        //
    }
}
