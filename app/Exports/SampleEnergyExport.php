<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SampleEnergyExport implements FromCollection, WithHeadings
{
    /**
     * Return a collection of the sample data
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect([
            [
                '2016-06',         // Month of
                'Electricity',     // Utility Type
                100,               // Cost
                'Sample note',     // Notes
                1,                 // Property ID
                2,                 // Non-commercial Property ID
            ],
        ]);
    }

    /**
     * Define the headings for the Excel columns
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Month of', 
            'Utility Type', 
            'Cost', 
            'Notes', 
            'Commercial Property ID', 
            'Non-commercial Property ID'
        ];
    }
}
