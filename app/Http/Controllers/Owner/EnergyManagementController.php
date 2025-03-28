<?php

namespace App\Http\Controllers\Owner;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\NonCommercial;
use App\Imports\UtilityImport;
use App\Models\EnergyManagement;
use App\Exports\SampleEnergyExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EnergyManagementExport;


class EnergyManagementController extends Controller
{
    //
    public function index()
    {
        $nonCommercialProperties = NonCommercial::all();
        $commercialProperties = Property::all();
        $utilities = EnergyManagement::orderBy('month', 'desc')->get();
    
        // Pass a flag if no records exist
        $noUtilities = $utilities->isEmpty();
        $noNonCommercial = $nonCommercialProperties->isEmpty();
        $noCommercialProperties = $commercialProperties->isEmpty();
    
        return view('owner.energy.index', compact('utilities', 'nonCommercialProperties', 'commercialProperties', 'noUtilities', 'noNonCommercial', 'noCommercialProperties'));
    }
    

    public function create()
    {
        $utilities = EnergyManagement::orderBy('month', 'desc')->get();
        return view('owner.energy.create', compact('utilities'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Get the list of utilities
        $utilities = EnergyManagement::orderBy('month', 'desc')->get();
    
        // Get all non-commercial properties for the dropdown
        $nonCommercialProperties = NonCommercial::all();
        $commercialProperties= Property::all();

        // Validate the incoming request
        $validatedData = $request->validate([
            'month' => 'required|date_format:Y-m',
            'utility_type' => 'required|string|in:electricity,fuel,water',
            // 'consumption' => 'required|numeric',
            'cost' => 'required|numeric',
            'notes' => 'nullable|string',
            'property_id' => 'required|exists:non_commercial_properties,id', // Ensure property is selected
            'property_type' =>'string',
        ]);
    
        // Explicitly create the EnergyManagement record with the validated data
        // Determine the property type and store the relevant property ID
        if ($validatedData['property_type'] === 'commercial') {
            $propertyId = $validatedData['property_id']; // For commercial properties
            $nonCommercialPropertyId = null; // Null for non-commercial property
        } else {
            $propertyId = null; // Null for commercial property
            $nonCommercialPropertyId = $validatedData['property_id']; // For non-commercial properties
        }
    
            // Create an instance of the EnergyManagement model
            $energyManagement = new EnergyManagement();

            // Assign the validated data to the model properties
            $energyManagement->month = $validatedData['month'];
            $energyManagement->utility_type = $validatedData['utility_type'];
            $energyManagement->cost = $validatedData['cost'];
            $energyManagement->notes = $validatedData['notes'] ?? null;
            $energyManagement->property_id = $propertyId;  // Only set if Commercial
            $energyManagement->non_commercial_property_id = $nonCommercialPropertyId;  // Only set if Non-Commercial

            // Save the EnergyManagement record
            $energyManagement->save();
    
        // Return the view with utilities and properties, along with a success message
        return redirect()->route('owner.property.energy.index')->with('success', 'Utility record added successfully.');
    }

    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Get the uploaded file
        $file = $request->file('file');

        // Import the data into the database using the EnergyManagementImport class
        Excel::import(new EnergyManagement, $file);

        // Redirect with a success message
        return redirect()->route('owner.property.energy.index')->with('success', 'Utility records imported successfully.');
    }
    

    public function export()
    {
        // This triggers the export and download of the Excel file
        return Excel::download(new EnergyManagementExport, 'energy_management.xlsx');
    }


    // public function edit($id)
    // {
    //     // Find the utility record by ID
    //     $utility = Utility::findOrFail($id);

    //     // Get properties for both commercial and non-commercial
    //     $commercialProperties = Property::all();
    //     $nonCommercialProperties = NonCommercial::all();

    //     // Return the edit view with data
    //     return view('edit', compact('utility', 'commercialProperties', 'nonCommercialProperties'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $utility = Utility::findOrFail($id);
    
    //     // Validate the input
    //     $request->validate([
    //         'month' => 'required|date',
    //         'utility_type' => 'required|in:electricity,fuel,water',
    //         'property_type' => 'required|in:commercial,non_commercial',
    //         'property_id' => 'required|exists:properties,id',
    //         'cost' => 'required|numeric|min:0',
    //         'notes' => 'nullable|string',
    //     ]);
    
    //     // Update the utility record
    //     $utility->update([
    //         'month' => $request->month,
    //         'utility_type' => $request->utility_type,
    //         'property_type' => $request->property_type,
    //         'property_id' => $request->property_id,
    //         'cost' => $request->cost,
    //         'notes' => $request->notes,
    //     ]);
    
    //     return redirect()->route('owner.property.energy.index')->with('success', 'Utility record updated successfully.');
    // }
    


    public function destroy($id)
    {
        // Find the utility by its ID
        $energyManagement = EnergyManagement::findOrFail($id);
    
        // Delete the utility record
        $energyManagement->delete();
    
        // Redirect back with a success message
        return redirect()->route('owner.property.energy.index')->with('success', 'Utility record deleted successfully.');
    }
    
    public function downloadSampleExcel()
    {
        // Return a downloadable sample Excel file
        return Excel::download(new SampleEnergyExport, 'sample_energy_template.xlsx');
    }
}
