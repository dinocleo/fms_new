<?php

namespace App\Services\Assets;
use App\Models\Asset;
use Illuminate\Support\Facades\DB;
use App\Traits\ResponseTrait;

use Exception;

class AssetService{
    use ResponseTrait;

    public function getAllData()
    {
        $assets = Asset::get();

        return datatables($assets)
            ->addIndexColumn()
            ->addColumn('name', function ($item) {
                return '<div class="tenants-tbl-info-object d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="' . $item->name . '"
                            class="rounded-circle avatar-md tbl-user-image"
                            alt="">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6>' . $item->name . ' ' . $item->name . '</h6>
                            <p class="font-13">' . $item->name . '</p>
                        </div>
                    </div>';
            })
           
            
            ->addColumn('property', function ($item) {
                return $item->name;
            })
            ->addColumn('property', function ($item) {
                return $item->name;
            })
            ->addColumn('action', function ($item) {
                return $item->name;

            })
            ->rawColumns(['name', 'property', 'status', 'action'])
            ->make(true);
    }

}