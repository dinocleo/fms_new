<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Models\NonCommercial;
use App\Models\NonCommercialUnit;
use App\Http\Controllers\Controller;
use App\Models\NonCommercialSubUnit;

class NonCommercialPropertyController extends Controller
{
    public function storeProperty(Request $request)
    {
        // Validate request
        $request->validate([
            'property_type' => 'required|in:office,resident',
            'property_name' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'description' => 'nullable|string',
            'number_of_units' => 'nullable|integer', // For offices
            'number_of_unit' => 'nullable|integer', // For residents
        ]);
    
        // Create a new property and store it in $property
        $property = NonCommercial::create([
            'property_type' => $request->property_type,
            'name' => $request->property_name,
            'region' => $request->region,
            'district' => $request->district,
            'street' => $request->street,
            'description' => $request->description,
            'number_of_units' => $request->number_of_units, // For offices
            'number_of_unit' => $request->number_of_unit, // For residents
        ]);
    
        // Redirect to the unit step with the property ID
        return redirect()->route('owner.property.unit', $property->id)->with('success', 'Property added successfully!');
    }
    

    public function showNonCommercialProperty($id)
{
    $property = NonCommercial::findOrFail($id);
    return view('owner.property.showNonCommercial', compact('property'));
}

    public function propertyUnit($propertyId)
    {
        $property = NonCommercial::findOrFail($propertyId);
        return view('owner.property.unit', compact('property'));
    }

    public function storeUnitDetails(Request $request, $propertyId)
    {
        $validatedData = $request->validate([
            'multiple.unit_name' => 'required|array',
            'multiple.unit_name.*' => 'required|string',
            'multiple.bedroom' => 'nullable|array',
            'multiple.bedroom.*' => 'nullable|integer',
            'multiple.bath' => 'nullable|array',
            'multiple.bath.*' => 'nullable|integer',
            'multiple.kitchen' => 'nullable|array',
            'multiple.kitchen.*' => 'nullable|integer',
            'multiple.square_feet' => 'nullable|array',
            'multiple.square_feet.*' => 'nullable|string',
            'multiple.amenities' => 'nullable|array',
            'multiple.amenities.*' => 'nullable|string',
            'multiple.condition' => 'nullable|array',
            'multiple.condition.*' => 'nullable|in:new,good,fair,poor',
            'multiple.parking' => 'nullable|array',
            'multiple.parking.*' => 'nullable|boolean',
            'multiple.sub_unit' => 'nullable|array',
            'multiple.sub_unit.*' => 'nullable|boolean',
        ]);
    
        // Insert each unit
        foreach ($validatedData['multiple']['unit_name'] as $key => $unitName) {
            NonCommercialUnit::create([
                'non_commercial_properties_id' => $propertyId, // Ensure this matches the column name
                'unit_name' => $unitName,
                'bedroom' => $validatedData['multiple']['bedroom'][$key] ?? null,
                'bath' => $validatedData['multiple']['bath'][$key] ?? null,
                'kitchen' => $validatedData['multiple']['kitchen'][$key] ?? null,
                'square_feet' => $validatedData['multiple']['square_feet'][$key] ?? null,
                'amenities' => $validatedData['multiple']['amenities'][$key] ?? null,
                'condition' => $validatedData['multiple']['condition'][$key] ?? null,
                'parking' => $validatedData['multiple']['parking'][$key] ?? 0,
                'sub_unit' => $validatedData['multiple']['sub_unit'][$key] ?? 0,

            ]);
        }
        // Check if any unit has sub_unit = 1
            $hasSubUnit = NonCommercialUnit::where('non_commercial_properties_id', $propertyId)
            ->where('sub_unit', 1)
            ->exists();

        if ($hasSubUnit) {
            return redirect()->route('owner.property.subUnits', ['id' => $propertyId])->with('success', 'Units added successfully!');
        }

        $properties = NonCommercial::where('id', $propertyId)->get(); 

        return view('owner.property.nonCommercial', compact('properties'))
            ->with('success', 'Units added successfully!');
        
    }

    public function propertySubUnit($propertyId)
    {
        $property = NonCommercial::with('units.subUnits')->find($propertyId);
    
        if (!$property) {
            return redirect()->route('nonCommercial')->with('error', 'Property not found.');
        }
    
        return view('owner.property.sub_unit', compact('property', 'propertyId'))
            ->with('success', 'Units added successfully!');
    }
    
    
 
    public function storeSubUnitDetails(Request $request, $propertyId)
{
    // Validate the input for the multiple sub-units
    $validatedData = $request->validate([
        'multiple.unit_name' => 'required|array',
        'multiple.unit_name.*' => 'required|string',
        'multiple.amenities' => 'nullable|array',
        'multiple.amenities.*' => 'nullable|string',
    ]);

    // Loop through the unit names and save each sub-unit
    foreach ($validatedData['multiple']['unit_name'] as $key => $unitName) {
        NonCommercialSubUnit::create([
            'non_commercial_unit_id' => $propertyId,  // Assuming you need to link the sub-unit to the unit
            'unit_name' => $unitName,
            'amenities' => $validatedData['multiple']['amenities'][$key] ?? null,
        ]);
    }

    return redirect()->route('owner.property.nonCommercial', ['propertyId' => $propertyId])
        ->with('success', 'Sub-units added successfully!');
}

    

    
    
    
    
    
}
