<?php

namespace App\Http\Controllers\Owner;

use App\Models\AssetCategory;
use Illuminate\Http\Request;
use App\Services\Assets\assetCategoryService;
use App\Http\Controllers\Controller;

class AssetCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
     $this->assetCategoryService = new assetCategoryService;

    }

    public function index()
    {
        //
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
     * @param  \App\Models\AssetCategory  $assetCategory
     * @return \Illuminate\Http\Response
     */
    public function show(AssetCategory $assetCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssetCategory  $assetCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(AssetCategory $assetCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssetCategory  $assetCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssetCategory $assetCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssetCategory  $assetCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->assetCategoryService->deleteById($id);

    }
}
