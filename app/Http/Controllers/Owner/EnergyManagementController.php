<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Models\NonCommercial;
use App\Models\EnergyManagement;
use App\Http\Controllers\Controller;
use App\Models\Property;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UtilityImport;


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
    

    public function destroy($id)
    {
        // Find the utility by its ID
        $energyManagement = EnergyManagement::findOrFail($id);
    
        // Delete the utility record
        $energyManagement->delete();
    
        // Redirect back with a success message
        return redirect()->route('owner.property.energy.index')->with('success', 'Utility record deleted successfully.');
    }
    

}
