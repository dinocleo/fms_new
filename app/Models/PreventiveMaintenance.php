<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreventiveMaintenance extends Model
{
    use HasFactory;

    public function Property()
    {
        return $this->belongsTo(Property::class,  'property_id');
    }
    public function PropertyUnit()
    {
        return $this->belongsTo(PropertyUnit::class,  'unit_id');
    }
    public function SubUnit()
    {
        return $this->belongsTo(SubUnit::class,  'sub_unit_id');
    }

    public function MaintenanceIssue()
    {
        return $this->belongsTo(MaintenanceIssue::class,  'issue_id');
    }

    
}
