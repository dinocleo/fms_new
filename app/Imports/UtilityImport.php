<?php

namespace App\Imports;

use App\Models\EnergyManagement;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UtilityImport implements ToModel, WithHeadingRow
{
    /**
     * Map the rows to the EnergyManagement model.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new EnergyManagement([
            'date' => \Carbon\Carbon::parse($row['date'])->format('Y-m-d'),  // Assuming your date column is 'date'
            'utility_type' => $row['utility_type'],  // Assuming your utility type column is 'utility_type'
            'cost' => $row['cost'],  // Assuming your cost column is 'cost'
            'notes' => $row['notes'],  // Assuming your notes column is 'notes'
            // If you have property_id and non_commercial_property_id, adjust here
            'property_id' => $row['property_id'],
            'non_commercial_property_id' => $row['non_commercial_property_id'],
        ]);
    }

    
}