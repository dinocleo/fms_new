<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonCommercialSubUnit extends Model
{
    use HasFactory;
    protected $table = 'non_commercial_sub_units';

    protected $fillable = [
        'non_commercial_unit_id', // Foreign key
        'unit_name',
        'amenities',
    ];

    public function nonCommercialUnit()
    {
        return $this->belongsTo(NonCommercialUnit::class, 'non_commercial_unit_id');
    }
}
