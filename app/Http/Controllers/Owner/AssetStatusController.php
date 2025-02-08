<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\AssetStatus;
use Illuminate\Http\Request;
use App\Services\Assets\AssetStatusService;

// use App\Models\AssetCategory;
use Illuminate\Support\Facades\Auth;

class AssetStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {

     $this->statusService = new AssetStatusService;

    }


    public function index()
    {
        //

        $data['pageTitle'] = __('Status');
        $data['list'] = AssetStatus::all(); // Fetch all assets directly
        return view('owner.asset.status.index', $data);
  
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
        $request->validate([
            'name' => 'required|unique:asset_categories,name',
        ]);

        $status = new AssetStatus();
        $status->name = $request->name;
        $status->added_by = Auth::user()->id;
        $status->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssetStatus  $assetStatus
     * @return \Illuminate\Http\Response
     */
    public function show(AssetStatus $assetStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssetStatus  $assetStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(AssetStatus $assetStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssetStatus  $assetStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssetStatus $assetStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssetStatus  $assetStatus
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {
        return $this->statusService->deleteById($id);

    }
}
