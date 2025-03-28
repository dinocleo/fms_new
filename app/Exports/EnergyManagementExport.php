<?php

namespace App\Exports;

use App\Models\EnergyManagement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;

class EnergyManagementExport implements FromQuery, WithHeadings, WithStyles
{
    /**
     * Get the data for the export.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        // You can apply filters based on your requirements
        return EnergyManagement::query();
    }

    /**
     * Define the headings for the export.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Month',
            'Utility Type',
            'Cost',
            'Notes',
            'Property ID (Commercial)',
            'Non-Commercial Property ID',
        ];
    }

    /**
     * Apply styles to the spreadsheet.
     *
     * @param \Maatwebsite\Excel\Concerns\WithStyles $sheet
     * @return \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
     */
    public function styles($sheet)
    {
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        return $sheet;
    }
}
