<?php

namespace App\Services;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\DB;
use App\Traits\ResponseTrait;

use Exception;

class ManufactureService{
    use ResponseTrait;

    public function deleteById($id)
    {
        DB::beginTransaction();
        try {
            $manufacture = Manufacturer::where('id',$id);
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