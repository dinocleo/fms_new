<?php

namespace App\Services\Assets;
use App\Models\AssetStatus;
use Illuminate\Support\Facades\DB;
use App\Traits\ResponseTrait;

use Exception;

class AssetStatusService{
    use ResponseTrait;

    public function deleteById($id)
    {
        DB::beginTransaction();
        try {
            $item = AssetStatus::where('id',$id);
            $item->delete();
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