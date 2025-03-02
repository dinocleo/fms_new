<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnergyManagement extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'utility_type',
        'consumption',
        'cost',
        'notes',
    ];
}
