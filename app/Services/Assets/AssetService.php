<?php

namespace App\Services\Assets;
use App\Models\Asset;
use Illuminate\Support\Facades\DB;
use App\Traits\ResponseTrait;

use Exception;

class AssetService{
    use ResponseTrait;

    public function fetchAssetLocationByTag($tag){
        // DB::beginTransaction();
        try {
            $item = Asset::where('tag',$tag)->with('Property')->with('propertyUnit')->with('SubUnit')->first();
            return response($item);
            // DB::commit();
            // $message = __(DELETED_SUCCESSFULLY);
            // return redirect()->back()->with('success', __(DELETED_SUCCESSFULLY));
        } catch (\Exception $e) {
            // DB::rollBack();
            // $message = getErrorMessage($e, $e->getMessage());
            return [];
        }
    }

    
    public function disposeById($id)
    {
        DB::beginTransaction();
        try {
            $item = Asset::where('id',$id)->first();
            $item->status_id = 10;
            $item->save();
            DB::commit();
            $message = __(DELETED_SUCCESSFULLY);
            return redirect()->back()->with('success', __(DELETED_SUCCESSFULLY));
        } catch (\Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function getAllData()
    {

        $assets = Asset::orderBy('updated_at', 'desc')->where('status_id', 8)->get();

        return datatables($assets)
            ->addIndexColumn()
            ->addColumn('image', function ($item) {
                return '<div class="tenants-tbl-info-object d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="http://127.0.0.1:8000/assets/images/no-image.jpg"
                            class="rounded-circle avatar-md tbl-user-image"
                            alt="">
                        </div>
                    </div>';
            })
           
            
            ->addColumn('name', function ($item) {
                return $item->name;
            })
            ->addColumn('property', function ($item) {
                return $item->name;
            })
            ->addColumn('category', function ($item) {
                if($item->AssetCategory!=null){
                    return $item->AssetCategory->name;
                }else{
                    return "";
                }
            })
            ->addColumn('manufacturer', function ($item) {
                if($item->Manufacturer!=null){
                    return $item->Manufacturer->name;
                }else{
                    return "";
                }
            })
            ->addColumn('property', function ($item) {
                if($item->Property!=null){
                    return $item->Property->name;
                }else{
                    return "";
                }
            })
            ->addColumn('unit', function ($item) {
                if($item->propertyUnit!=null){
                    return $item->propertyUnit->name;
                }else{
                    return "";
                }
            })
            ->addColumn('sub_unit', function ($item) {
                if($item->SubUnit!=null){
                    return $item->SubUnit->name;
                }else{
                    return "";
                }
            })
             ->addColumn('action', function ($item) {
                return '<button type="button class="theme-btn" style= "display: inline-flex
;
    align-items: center;
    cursor: pointer;
    outline: none;
    z-index: 99;
    padding: 4px 5px !important;
    line-height: 20px;
    justify-content: center;
    border-radius: 4px;
    font-weight: 500 !important;
    color: var(--white-color);
    border: 1px solid transparent;background-color: var(--button-primary-color);
    border-radius: 4px;
    padding: 3px;
    color: white;
    font-weight: 700;" title="Replace">View More</button>';

            })
            ->rawColumns(['image', 'name', 'category', 'manufacturer','property','unit','sub_unit','status', 'action'])
            ->make(true);
    }

}