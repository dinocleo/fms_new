<?php

namespace App\Services\Assets;

use App\Models\AssetCategory;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class assetCategoryService
{
    use ResponseTrait;
    
    public function deleteById($id)
    {
        DB::beginTransaction();
        try {
            $manufacture = AssetCategory::where('id',$id);
            $manufacture->delete();
            DB::commit();
            $message = __(DELETED_SUCCESSFULLY);
            return redirect()->back()->with('success', __(DELETED_SUCCESSFULLY));
        } catch (\Exception $e) {
            DB::rollBack();
            $message = getErrorMessage($e, $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
