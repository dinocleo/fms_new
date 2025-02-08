<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\SubUnit;
use Illuminate\Http\Request;
use App\Services\SubUnitService;

class SubUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $subUnitService;
    public function __construct()
    {
        $this->subUnitService = new SubUnitService;
    }

    public function index()
    {
        //
    }

    public function getSubUnits(Request $request){
        return $this->subUnitService->getSubUnitsByUnitId($request->unit_id);
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
     * @param  \App\Models\SubUnit  $subUnit
     * @return \Illuminate\Http\Response
     */
    public function show(SubUnit $subUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubUnit  $subUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(SubUnit $subUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubUnit  $subUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubUnit $subUnit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubUnit  $subUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubUnit $subUnit)
    {
        //
    }
}
