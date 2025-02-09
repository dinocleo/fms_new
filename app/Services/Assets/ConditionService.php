<?php

namespace App\Services\Assets;
use App\Models\Condition;
use Illuminate\Support\Facades\DB;
use App\Traits\ResponseTrait;

use Exception;

class ConditionService{
    use ResponseTrait;

    public function deleteById($id)
    {
        DB::beginTransaction();
        try {
            $manufacture = Condition::where('id',$id);
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