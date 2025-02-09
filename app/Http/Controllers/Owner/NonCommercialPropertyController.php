<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Models\NonCommercial;
use App\Models\NonCommercialUnit;
use App\Http\Controllers\Controller;

class NonCommercialPropertyController extends Controller
{
    public function storeProperty(Request $request)
    {
        // Validate request
        $request->validate([
            'property_type' => 'required|in:office,resident',
            'property_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'number_of_units' => 'nullable|integer', // For offices
            'conference_room' => 'nullable|string|in:yes,no',
            'number_of_unit' => 'nullable|integer', // For residents
        ]);
    
        // Create a new property and store it in $property
        $property = NonCommercial::create([
            'property_type' => $request->property_type,
            'property_name' => $request->property_name,
            'description' => $request->description,
            'number_of_units' => $request->number_of_units, // For offices
            'conference_room' => $request->conference_room,
            'number_of_unit' => $request->number_of_unit, // For residents
        ]);
    
        // Redirect to the unit step with the property ID
        return redirect()->route('owner.property.unit', $property->id)->with('success', 'Property added successfully!');
    }
    

    public function propertyUnit($propertyId)
    {
        $property = NonCommercial::findOrFail($propertyId);
        return view('owner.property.unit', compact('property'));
    }

    public function storeUnitDetails(Request $request)
    {
        // Validate input
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
            'multiple.images' => 'nullable|array',
            'multiple.images.*' => 'nullable|image',
            'multiple.description' => 'nullable|array',
            'multiple.description.*' => 'nullable|string',
        ]);
    
        // Store each unit's data
        foreach ($validatedData['multiple']['unit_name'] as $key => $unitName) {
            NonCommercialUnit::create([
                'non_commercial_properties_id' => $request->propertyId,
                'unit_name' => $unitName,
                'bedroom' => $validatedData['multiple']['bedroom'][$key] ?? null,
                'bath' => $validatedData['multiple']['bath'][$key] ?? null,
                'kitchen' => $validatedData['multiple']['kitchen'][$key] ?? null,
                'square_feet' => $validatedData['multiple']['square_feet'][$key] ?? null,
                'amenities' => $validatedData['multiple']['amenities'][$key] ?? null,
                'condition' => $validatedData['multiple']['condition'][$key] ?? null,
                'parking' => isset($validatedData['multiple']['parking'][$key]) ? 1 : 0, // Handle checkbox
                'description' => $validatedData['multiple']['description'][$key] ?? null,
            ]);
        }
    
        return redirect()->route('owner.property.index')->with('success', 'Units added successfully!');
    }
    
    
    
    
}
