@extends('owner.layouts.app')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="page-content-wrapper bg-white p-30 radius-20">
                    <div class="row">
                        <div class="col-12">
                            <div
                                class="page-title-box d-sm-flex align-items-center justify-content-between border-bottom mb-20">
                                <div class="page-title-left">
                                    <h3 class="mb-sm-0">Projects</h3>
                                </div>
                                <div class="page-title-right">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('owner.dashboard') }}">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Projects</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Project Button -->
                    <div class="col-md-3 mb-3">
                        <button class="theme-btn btn-sm" data-bs-toggle="modal" data-bs-target="#addProjectModal">Add
                            Project</button>
                    </div>

                    <!-- Projects Table -->
                    <table id="projectsTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Budget</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Location</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <td>{{ $project->title }}</td>
                                    <td>{{ $project->description }}</td>
                                    <td>{{ $project->start_date }}</td>
                                    <td>{{ $project->end_date }}</td>
                                    <td>{{ $project->budget }}</td>
                                    <td>{{ $project->priority }}</td>
                                    <td>{{ $project->status }}</td>
                                    <td>{{ $project->property->name ?? ($project->nonCommercialProperty->name ?? 'N/A') }}
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editProjectModal" data-id="{{ $project->id }}">Edit</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Include modals for create and edit -->
                    @include('owner.project.create')
                    @include('owner.project.edit')
                </div>
            </div>
        </div>
    </div>

    <script>
        // Handle location type switch for create and edit modals
        document.getElementById('location_type').addEventListener('change', function() {
            let commercialProperty = document.getElementById('commercial_property');
            let nonCommercialProperty = document.getElementById('non_commercial_property');

            if (this.value === 'commercial') {
                commercialProperty.style.display = 'block';
                nonCommercialProperty.style.display = 'none';
            } else if (this.value === 'non_commercial') {
                commercialProperty.style.display = 'none';
                nonCommercialProperty.style.display = 'block';
            }
        });

        document.getElementById('edit_location_type').addEventListener('change', function() {
            let editCommercialProperty = document.getElementById('edit_commercial_property');
            let editNonCommercialProperty = document.getElementById('edit_non_commercial_property');

            if (this.value === 'commercial') {
                editCommercialProperty.style.display = 'block';
                editNonCommercialProperty.style.display = 'none';
            } else if (this.value === 'non_commercial') {
                editCommercialProperty.style.display = 'none';
                editNonCommercialProperty.style.display = 'block';
            }
        });

        // Pre-fill the edit modal form when clicking on the Edit button
        const editButtons = document.querySelectorAll('button[data-bs-target="#editProjectModal"]');
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const projectId = this.getAttribute('data-id');
                fetch(`/projects/${projectId}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('edit_title').value = data.title;
                        document.getElementById('edit_description').value = data.description;
                        document.getElementById('edit_start_date').value = data.start_date;
                        document.getElementById('edit_end_date').value = data.end_date;
                        document.getElementById('edit_budget').value = data.budget;
                        document.getElementById('edit_priority').value = data.priority;
                        document.getElementById('edit_status').value = data.status;
                        document.getElementById('edit_location_type').value = data.location_type;
                        document.getElementById('edit_property_id').value = data.property_id;
                        document.getElementById('edit_non_commercial_property_id').value = data
                            .non_commercial_property_id;
                        // Update visibility of location-related fields
                        document.getElementById('edit_location_type').dispatchEvent(new Event(
                            'change'));
                    });
            });
        });
    </script>
@endsection
