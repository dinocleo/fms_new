<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonCommercialUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'non_commercial_properties_id', // Foreign key to the NonCommercial property
        'unit_name', 'bedroom', 'bath', 
        'kitchen', 'workspaces', 'conference_room', 
        'square_feet', 'amenities', 'condition', 'parking', 'sub_unit',
    ];

    /**
     * Define the relationship to the NonCommercial property.
     */
    public function noncommercial() {
        return $this->belongsTo(NonCommercial::class, 'non_commercial_properties_id'); // Foreign key pointing to the property
    }

    /**
     * Define the relationship with the NonCommercialSubUnit.
     */
    public function subUnits()
    {
        // Change to reference NonCommercialSubUnit, not SubUnit
        return $this->hasMany(NonCommercialSubUnit::class, 'non_commercial_unit_id');
    }
}

