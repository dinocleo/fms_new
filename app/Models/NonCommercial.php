<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class NonCommercial extends Model
{
    use HasFactory;
    protected $table = 'non_commercial_properties';

    protected $fillable = [
        'property_type',  
        'name',
        'region',
        'district',
        'street',
        'description',
        'number_of_units',
        'conference_room',
        'bedrooms',
        'number_of_unit',
        'thumbnail_image',
        'unit_type',
        'status',
        'thumbnail_image_id',
        'maintainer_id',
        'owner_user_id',
    ];

    public function units() {
        return $this->hasMany(NonCommercialUnit::class, 'non_commercial_properties_id'); // Update this
    }

    public function energyManagements()
    {
        return $this->hasMany(EnergyManagement::class, 'non_commercial_property_id');
    }
    public function projects()
    {
        return $this->hasMany(Project::class, 'non_commercial_property_id');
    }
}
