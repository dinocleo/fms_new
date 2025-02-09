<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubUnit extends Model
{
    use HasFactory;
    protected $fillable = [
        'non_commercial_unit_id',
        'unit_name',
        'bedroom',
        'bath',
        'kitchen',
        'workspaces',
        'conference_room',
        'square_feet',
        'amenities',
        'condition',
        'parking',
        'description',
    ];

    public function unit()
    {
        return $this->belongsTo(NonCommercialUnit::class, 'non_commercial_unit_id');
    }

}
