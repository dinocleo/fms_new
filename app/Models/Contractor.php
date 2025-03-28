<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'company', 'category', 'license_number', 'contract_start', 'contract_end', 'email', 'phone_number', 'contact_person', 'service_provided', 'status'];

    public function projects()
    {
        return $this->hasMany(Project::class, 'contractor_id');
    }
}
