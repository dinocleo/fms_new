<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Contractor;
use Illuminate\Http\Request;
use DataTables;

class ContractorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $contractors = Contractor::select([
                'id', 'name', 'company', 'category', 'phone_number', 'email', 
                'contact_person', 'service_provided', 'status'
            ]);

            return DataTables::of($contractors)
                ->addColumn('action', function ($contractor) {
                    return '<a href="'.route('owner.property.contractors.edit', $contractor->id).'" class="btn btn-primary btn-sm">Edit</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('owner.contractors.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('owner.contractors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Contractor::create($request->validate([
            'name' => 'required',
            'company' => 'required',
            'category' => 'required',
            'license_number' => 'nullable',
            'contract_start' => 'nullable|date',
            'contract_end' => 'nullable|date',
            'email' => 'nullable|email',
            'phone_number' => 'nullable|string',
            'contact_person' => 'nullable|string',
            'service_provided' => 'nullable|string',
            'status' => 'required|in:ongoing,completed,pending,terminated',
        ]));
        return redirect()->route('owner.property.contractors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contractor  $contractor
     * @return \Illuminate\Http\Response
     */
    public function show(Contractor $contractor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contractor  $contractor
     * @return \Illuminate\Http\Response
     */
    // public function edit(Contractor $contractor)
    // {
    //     return view('owner.contractors.edit', compact('contractor'));
    // }
    public function edit($id)
{
    $contractor = Contractor::findOrFail($id);
    return response()->json($contractor);
}



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contractor  $contractor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contractor $contractor)
    {
        $contractor->update($request->validate([
            'name' => 'required',
            'company' => 'required',
            'category' => 'required',
            'license_number' => 'nullable',
            'contract_start' => 'nullable|date',
            'contract_end' => 'nullable|date',
            'email' => 'nullable|email',
            'phone_number' => 'nullable|string',
            'contact_person' => 'nullable|string',
            'service_provided' => 'nullable|string',
            'status' => 'required|in:ongoing,completed,pending,terminated',
        ]));
        return redirect()->route('owner.property.contractors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contractor  $contractor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contractor $contractor)
    {
        $contractor->delete();
        return redirect()->route('owner.property.contractors.index');
    }
}
