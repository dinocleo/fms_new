<?php

namespace App\Http\Controllers\Owner;

use App\Models\Contractor;
use Illuminate\Http\Request;
use App\Models\NonCommercial;
use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Models\Property;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['contractor', 'property', 'nonCommercialProperty'])->get();
        // Fetch names from both tables and merge them
        $properties = Property::select('name', 'id')->get();

        $non_commercial_properties = NonCommercial::select('name', 'id')->get();
        
        $all_properties = $properties->merge($non_commercial_properties);
        
        // dd($all_properties);
        return view('owner.project.index', compact('projects','all_properties'));
    }
    // public function create()
    // {
    //     // Fetch contractors and properties to select from
    //     $vendors = Contractor::pluck('company', 'id');
    //     $non_commercial = NonCommercial::pluck('name', 'id');
    //     $commercial = Property::pluck('name', 'id');
    //     return view('owner.project.create', compact('vendors', 'non_commercial','commercial'));
    // }
    public function create()
    {
        // Fetch names from both tables and merge them
        $properties = Property::pluck('name', 'id');
        $non_commercial_properties = NonCommercial::pluck('name', 'id');
    
        // Merge both collections to create one list of all properties
        $all_properties = $properties->merge($non_commercial_properties);

        return view('owner.project.create', compact('all_properties'));
    }
    
    
    
    
    
    

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'budget' => 'required|numeric',
            'priority' => 'required|in:Low,Medium,High',
            'status' => 'required|in:ongoing,completed,pending,terminated',
            'vendor_id' => 'required|exists:contractors,id',
            'location_id' => 'required|exists:non_commercial_properties,id',
            'documents' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Handle document upload if exists
        if ($request->hasFile('documents')) {
            $documentPath = $request->file('documents')->store('project_documents');
        }

        // Create new project with foreign keys and names
        $project = Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'budget' => $request->budget,
            'priority' => $request->priority,
            'status' => $request->status,
            'contractor_id' => $request->vendor_id,
            'property_id' => $request->location_id, 
            'non_commercial_property_id' => $request->location_id,
            'documents' => $documentPath ?? null,
        ]);

        return redirect()->route('owner.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        // Fetch contractors and properties for editing
        $vendors = Contractor::pluck('company', 'id'); // Get company names and IDs
        $locations = NonCommercial::pluck('name', 'id'); // Get property names and IDs
        return view('owner.projects.edit', compact('project', 'vendors', 'locations'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'budget' => 'required|numeric',
            'priority' => 'required|in:Low,Medium,High',
            'status' => 'required|in:ongoing,completed,pending,terminated',
            'vendor_id' => 'required|exists:contractors,id',
            'location_id' => 'required|exists:non_commercial_properties,id',
            'documents' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Handle document upload if exists
        if ($request->hasFile('documents')) {
            $documentPath = $request->file('documents')->store('project_documents');
            $project->documents = $documentPath; // Update the document path
        }

        // Update project with foreign keys and names
        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'budget' => $request->budget,
            'priority' => $request->priority,
            'status' => $request->status,
            'contractor_id' => $request->vendor_id, // Update contractor foreign key
            'property_id' => $request->location_id, // Update property foreign key
            'non_commercial_property_id' => $request->location_id, // Update non-commercial property foreign key
            'documents' => $documentPath ?? $project->documents, // Keep existing document if not updated
        ]);

        return redirect()->route('owner.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        // Optionally, delete the document file from storage
        if ($project->documents) {
            Storage::delete($project->documents);
        }

        $project->delete();

        return redirect()->route('owner.projects.index')->with('success', 'Project deleted successfully.');
    }
}
