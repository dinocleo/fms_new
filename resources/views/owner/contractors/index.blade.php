@extends('owner.layouts.app')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="page-content-wrapper bg-white p-30 radius-20">
                    <!-- Page Header -->
                    <div class="row">
                        <div class="col-12">
                            <div
                                class="page-title-box d-sm-flex align-items-center justify-content-between border-bottom mb-20">
                                <div class="page-title-left">
                                    <h3 class="mb-sm-0">Contractors</h3>
                                </div>
                                <div class="page-title-right">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('owner.dashboard') }}"
                                                title="{{ __('Dashboard') }}">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Contractors</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Page Header -->

                    <!-- Add Contractor Button -->
                    <a href="javascript:void(0);" class="theme-btn btn-sm mb-25" id="addContractorBtn">Add Contractor</a>

                    <!-- Contractors Table -->
                    <table id="contractorsTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Contact Person</th>
                                <th>Category</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Service Provided</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                    <!-- End of Contractors Table -->

                    <!-- Add Contractor Modal -->
                    <div class="modal fade" id="contractorModal" tabindex="-1" role="dialog"
                        aria-labelledby="contractorModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="contractorModalLabel">Add New Contractor</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"><span class="iconify"
                                            data-icon="akar-icons:cross"></span></button>
                                </div>
                                <form id="contractorForm">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Contractor Name</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="company">Company</label>
                                                    <input type="text" class="form-control" id="company" name="company"
                                                        required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="category">Category</label>
                                                    <select class="form-control" id="category" name="category" required>
                                                        <option value="" disabled selected>Select Category</option>
                                                        <option value="cleaning">Cleaning Services</option>
                                                        <option value="electrical">Electrical Services</option>
                                                        <option value="plumbing">Plumbing Services</option>
                                                        <option value="hvac">HVAC Services</option>
                                                        <option value="landscaping">Landscaping and Grounds Maintenance
                                                        </option>
                                                        <option value="security">Security Services</option>
                                                        <option value="pest_control">Pest Control</option>
                                                        <option value="fire_safety">Fire Safety and Protection</option>
                                                        <option value="general_maintenance">General Maintenance and Repairs
                                                        </option>
                                                        <option value="painting">Painting and Decorating</option>
                                                        <option value="waste_management">Waste Management</option>
                                                        <option value="building_construction">Building and Construction
                                                        </option>
                                                        <option value="elevator_maintenance">Elevator Maintenance</option>
                                                        <option value="it_support">Facility Management IT Support</option>
                                                        <option value="janitorial">Janitorial Services</option>
                                                        <option value="roofing">Roofing Services</option>
                                                        <option value="window_cleaning">Window Cleaning</option>
                                                        <option value="flooring">Flooring Services</option>
                                                        <option value="energy_management">Energy Management and
                                                            Sustainability</option>
                                                        <option value="surveying">Surveying and Inspection Services</option>
                                                        <option value="structural_maintenance">Structural Maintenance
                                                        </option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone_number">Phone Number</label>
                                                    <input type="text" class="form-control" id="phone_number"
                                                        name="phone_number" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" id="email"
                                                        name="email" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contact_person">Contact Person</label>
                                                    <input type="text" class="form-control" id="contact_person"
                                                        name="contact_person" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="service_provided">Service Provided</label>
                                                    <input type="text" class="form-control" id="service_provided"
                                                        name="service_provided" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select class="form-control" id="status" name="status" required>
                                                        <option value="ongoing">Ongoing</option>
                                                        <option value="completed">Completed</option>
                                                        <option value="pending">Pending</option>
                                                        <option value="terminated">Terminated</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="theme-btn btn-sm mb-25"
                                            style="background-color: #7f7e7e; color: white;"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="theme-btn btn-sm mb-25">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- Edit Contractor Modal -->
                    <div class="modal fade" id="editContractorModal" tabindex="-1" role="dialog"
                        aria-labelledby="editContractorModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editContractorModalLabel">Edit Contractor</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="editContractorForm">
                                    <div class="modal-body">
                                        <!-- Form content will be populated dynamically -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="edit_name">Contractor Name</label>
                                                    <input type="text" class="form-control" id="edit_name"
                                                        name="name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="edit_company">Company</label>
                                                    <input type="text" class="form-control" id="edit_company"
                                                        name="company" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="edit_category">Category</label>
                                                    <select class="form-control" id="edit_category" name="category"
                                                        required>
                                                        <option value="" disabled selected>Select Category</option>
                                                        <!-- Categories will be inserted here dynamically -->
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="edit_phone_number">Phone Number</label>
                                                    <input type="text" class="form-control" id="edit_phone_number"
                                                        name="phone_number" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Additional fields for email, contact person, service provided, etc. -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="edit_email">Email</label>
                                                    <input type="email" class="form-control" id="edit_email"
                                                        name="email" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="edit_contact_person">Contact Person</label>
                                                    <input type="text" class="form-control" id="edit_contact_person"
                                                        name="contact_person" required>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Other fields... -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="edit_service_provided">Service Provided</label>
                                                    <input type="text" class="form-control" id="edit_service_provided"
                                                        name="service_provided" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="edit_status">Status</label>
                                                    <select class="form-control" id="edit_status" name="status"
                                                        required>
                                                        <option value="ongoing">Ongoing</option>
                                                        <option value="completed">Completed</option>
                                                        <option value="pending">Pending</option>
                                                        <option value="terminated">Terminated</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="theme-btn btn-sm mb-25"
                                            style="background-color: #7f7e7e; color: white;"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="theme-btn btn-sm mb-25">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- End of Add Contractor Modal -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    @include('common.layouts.datatable-style')
@endpush

@push('script')
    @include('common.layouts.datatable-script')
    <script src="{{ asset('assets/js/custom/information.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#contractorsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('owner.property.contractors.index') }}',
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'contact_person',
                        name: 'contact_person'
                    },
                    {
                        data: 'company',
                        name: 'company'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'service_provided',
                        name: 'service_provided'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                        <a href="javascript:void(0);" class="p-1 tbl-action-btn edit" data-id="${row.id}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="/owner/property/contractors/${row.id}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1 tbl-action-btn delete" style="border: none; background: none;">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    `;
                        }


                    }
                ]
            });

            // Show the modal when 'Add Contractor' is clicked
            $('#addContractorBtn').click(function() {
                $('#contractorModal').modal('show');
            });

            // Handle form submission to add contractor
            $('#contractorForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('owner.property.contractors.store') }}',
                    data: formData,
                    success: function(response) {
                        $('#contractorModal').modal('hide');
                        $('#contractorsTable').DataTable().ajax.reload();
                        alert('Contractor added successfully!');
                    },
                    error: function(response) {
                        alert('Error: ' + response.responseText);
                    }
                });
            });
        });

        $(document).ready(function() {
            // Show the edit modal when an "Edit" button is clicked
            $('#contractorsTable').on('click', '.edit', function() {
                var contractorId = $(this).data('id'); // Get the contractor ID from data attribute

                // Make an AJAX request to get the contractor's data
                $.ajax({
                    url: '/owner/property/contractors/' + contractorId +
                        '/edit', // Adjust the URL accordingly
                    type: 'GET',
                    success: function(response) {
                        // Populate the form fields in the modal with the contractor data
                        $('#edit_name').val(response.name);
                        $('#edit_company').val(response.company);
                        $('#edit_category').val(response
                            .category); // Assuming it's a select field
                        $('#edit_phone_number').val(response.phone_number);
                        $('#edit_email').val(response.email);
                        $('#edit_contact_person').val(response.contact_person);
                        $('#edit_service_provided').val(response.service_provided);
                        $('#edit_status').val(response.status);

                        // Show the modal
                        $('#editContractorModal').modal('show');
                    },
                    error: function() {
                        alert('Error fetching contractor data.');
                    }
                });
            });

            // Handle the form submission for updating the contractor
            $('#editContractorForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize(); // Serialize the form data

                // Send the update request using AJAX
                var contractorId = $('#editContractorForm').data(
                    'id'); // Get the contractor ID from the modal data
                $.ajax({
                    url: '/owner/property/contractors/' + contractorId,
                    type: 'PUT',
                    data: formData,
                    success: function(response) {
                        // Close the modal and reload the table
                        $('#editContractorModal').modal('hide');
                        $('#contractorsTable').DataTable().ajax.reload();
                        alert('Contractor updated successfully!');
                    },
                    error: function(response) {
                        alert('Error updating contractor: ' + response.responseText);
                    }
                });
            });
        });
    </script>
@endpush
