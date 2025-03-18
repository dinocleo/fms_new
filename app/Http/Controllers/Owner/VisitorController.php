<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index()
    {
        $visitors = Visitor::all();
        return view('owner.visitors.index', compact('visitors'));
    }

    public function create()
    {
        return view('owner.visitors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'id_type' => 'required',
            'id_number' => 'required',
            'purpose' => 'required',
            'office_unit' => 'required',
            'entry_time' => 'required|date_format:H:i',
            'visit_date' => 'required|date',
        ]);

        Visitor::create($request->all());

        return redirect()->route('owner.property.visitors')->with('success', 'Visitor registered successfully!');
    }

    public function show($id)
    {
        $visitor = Visitor::findOrFail($id);
        return view('owner.property.visitors.show', compact('visitor'));
    }

    public function edit($id)
    {
        $visitor = Visitor::findOrFail($id);
        return view('owner.visitors.edit', compact('visitor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'id_type' => 'required',
            'id_number' => 'required',
            'purpose' => 'required',
            'office_unit' => 'required',
            'entry_time' => 'required|date_format:H:i',
            'visit_date' => 'required|date',
        ]);

        $visitor = Visitor::findOrFail($id);
        $visitor->update($request->all());

        return redirect()->route('owner.property.visitors')->with('success', 'Visitor details updated successfully!');
    }

    public function destroy($id)
    {
        $visitor = Visitor::findOrFail($id);
        $visitor->delete();

        return redirect()->route('owner.property.visitors')->with('success', 'Visitor deleted successfully!');
    }
}
