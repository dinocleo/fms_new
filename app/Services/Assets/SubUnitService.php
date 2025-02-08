<?php

namespace App\Services\Assets;
use App\Models\SubUnit;
use Illuminate\Support\Facades\DB;
use App\Traits\ResponseTrait;

use Exception;

class SubUnitService{
    use ResponseTrait;

    public function getUnitsByPropertyId($id)
    {
        $subUnits = SubUnit::where('unit_id', $id)->get();
        return $this->success($subUnits);
    }


    public function deleteById($id)
    {
        DB::beginTransaction();
        try {
            $manufacture = SubUnit::where('id',$id);
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