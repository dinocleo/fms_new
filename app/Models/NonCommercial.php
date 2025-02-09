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
        'property_name',
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

    public function tenants()
    {
        return $this->hasMany(Tenant::class, 'property_id', 'id');
    }

    public function maintainers()
    {
        return $this->hasMany(Maintainer::class, 'property_id', 'id');
    }
    public function propertyDetail(): HasOne
    {
        return $this->hasOne(PropertyDetail::class);
    }

    public function propertyImages(): HasMany
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function propertyUnits(): HasMany
    {
        return $this->hasMany(PropertyUnit::class, 'property_id', 'id')->select('id', 'unit_name', 'property_id');
    }
    public function units() {
        return $this->hasMany(NonCommercialUnit::class);
    }

    
}
