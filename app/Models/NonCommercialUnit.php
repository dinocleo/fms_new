<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonCommercialUnit extends Model
{
    use HasFactory;
    protected $fillable = [
        'non_commercial_id', 'unit_name', 'bedroom', 'bath', 
        'kitchen', 'workspaces', 'conference_room', 
        'square_feet', 'amenities', 'condition', 'parking', 'description'
    ];

    public function noncommercial() {
        return $this->belongsTo(NonCommercial::class, 'non_commercial_id');
    }
    public function subUnits()
    {
        return $this->hasMany(SubUnit::class, 'non_commercial_unit_id');
    }
}
