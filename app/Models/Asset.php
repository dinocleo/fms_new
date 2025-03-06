<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'tag', 'status', 'category_id', 'manufacturer_id'];

    public function AssetCategory()
    {
        return $this->belongsTo(AssetCategory::class,  'category_id','id');
    }
    public function Manufacturer()
    {
        return $this->belongsTo(Manufacturer::class,  'manufacturer_id');
    }
    public function Property()
    {
        return $this->belongsTo(Property::class,  'property_id');
    }
    public function propertyUnit()
    {
        return $this->belongsTo(propertyUnit::class,  'unit_id');
    }
    public function SubUnit()
    {
        return $this->belongsTo(SubUnit::class,  'sub_unit_id');
    }

}