<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'id_type',
        'id_number',
        'purpose',
        'office_unit',
        'entry_time',
        'exit_time',
        'visit_date',
    ];
}
