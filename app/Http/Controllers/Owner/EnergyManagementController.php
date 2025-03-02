<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\EnergyManagement;
use Illuminate\Http\Request;

class EnergyManagementController extends Controller
{
    //
    public function index()
    {
        $utilities = EnergyManagement::orderBy('date', 'desc')->get();
        return view('owner.energy.index', compact('utilities'));
    }

    public function create()
    {
        $utilities = EnergyManagement::orderBy('date', 'desc')->get();
        return view('owner.energy.create', compact('utilities'));
    }

    public function store(Request $request)
    {
        $utilities = EnergyManagement::orderBy('date', 'desc')->get();
        $request->validate([
            'date' => 'required|date',
            'utility_type' => 'required|string|in:electricity,fuel,water',
            'consumption' => 'required|numeric',
            'cost' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        EnergyManagement::create($request->all());

        return view('owner.energy.index', compact('utilities'))->with('success', 'Utility record created successfully.');
    }

    public function destroy($id)
    {
        EnergyManagement::findOrFail($id)->delete();
        return redirect()->route('utilities.index')->with('success', 'Utility record deleted.');
    }
}
