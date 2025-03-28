<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'budget',
        'priority',
        'status',
        'contractor_id',
        'property_id',
        'non_commercial_property_id',
        'documents',
    ];
    public function contractor()
    {
        return $this->belongsTo(Contractor::class, 'contractor_id');
    }
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    // Define the relationship to the non-commercial property
    public function nonCommercialProperty()
    {
        return $this->belongsTo(NonCommercial::class, 'non_commercial_property_id');
    }
}
