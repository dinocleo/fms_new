<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnergyManagement extends Model
{
    use HasFactory;
    protected $fillable = [
        'month',
        'utility_type',
        'consumption',
        'cost',
        'notes',
        
    ];

    public function nonCommercialProperty()
    {
        return $this->belongsTo(NonCommercial::class, 'non_commercial_property_id');
    }

}
