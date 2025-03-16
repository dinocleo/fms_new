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
                                    <h3 class="mb-sm-0">Utilities</h3>
                                </div>
                                <div class="page-title-right">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('owner.dashboard') }}"
                                                title="{{ __('Dashboard') }}">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Utilities</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="property-top-search-bar">
                        <div class="row">
                            <!-- Add Record Button (Left Side) -->
                            <div class="col-md-6">
                                <a href="#" class="theme-btn mb-25" data-bs-toggle="modal"
                                    data-bs-target="#addUtilityModal" title="{{ __('Add Record') }}">
                                    {{ __('Add Record') }}
                                </a>
                            </div>

                            <!-- Import Button (Right Side) -->
                            <div class="col-md-6 text-end">
                                <a href="#" class="theme-btn mb-25" data-bs-toggle="modal"
                                    data-bs-target="#importUtilityModal" title="{{ __('Import Records') }}"
                                    style="background-color: #1c7c54; color: white; border: none; padding: 10px 20px; border-radius: 5px;">
                                    {{ __('Import') }}
                                </a>
                            </div>
                        </div>
                    </div>


                    <div class="bg-off-white theme-border radius-4 p-25">
                        <div class="table-responsive">
                            <!-- Check if there are any utilities -->
                            @if ($utilities->isEmpty())
                                <div class="alert alert-warning">
                                    No utility records found.
                                </div>
                            @else
                                <table id="utilitiesTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th> <!-- Serial Number Column -->
                                            <th>Month Of</th>
                                            <th>Type</th>
                                            <th>Property Name</th>
                                            <th>Cost</th>
                                            <th>Notes</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($utilities as $index => $utility)
                                            <tr>
                                                <td>{{ $index + 1 }}</td> <!-- Display serial number -->
                                                <td>{{ \Carbon\Carbon::parse($utility->date)->format('F Y') }}</td>
                                                <td>{{ ucfirst($utility->utility_type) }}</td>
                                                @php
                                                    // Fetch the property data based on the property_id or non_commercial_property_id
                                                    $commercialProperty = \App\Models\Property::find(
                                                        $utility->property_id,
                                                    );
                                                    $nonCommercialProperty = \App\Models\NonCommercial::find(
                                                        $utility->non_commercial_property_id,
                                                    );
                                                @endphp

                                                <td>
                                                    @if ($commercialProperty)
                                                        {{ $commercialProperty->name }}
                                                    @elseif ($nonCommercialProperty)
                                                        {{ $nonCommercialProperty->name }}
                                                    @else
                                                        Not found
                                                    @endif
                                                </td>

                                                <td>{{ 'TSh ' . number_format($utility->cost, 2, '.', ',') }}</td>
                                                <td>{{ $utility->notes }}</td>
                                                <td>
                                                    <!-- Edit Button -->
                                                    <a href="{{ route('owner.property.energy.edit', $utility->id) }}"
                                                        class="p-1 tbl-action-btn edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <!-- Delete Button -->
                                                    <form
                                                        action="{{ route('owner.property.energy.destroy', $utility->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf <!-- CSRF protection -->
                                                        @method('DELETE') <!-- Spoof the DELETE method -->

                                                        <!-- Button with trash icon -->
                                                        <button class="p-1 tbl-action-btn" type="submit"
                                                            onclick="return confirm('Are you sure you want to delete this utility?');">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>


                    <!-- Add Utility Modal -->


                    <div class="modal fade" id="addUtilityModal" tabindex="-1" aria-labelledby="addUtilityModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addUtilityModalLabel">Add New Utility Record</h5>
                                    {{-- <button type="button" class="theme-btn btn-sm mb-25" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        {{ __('Close') }}
                                    </button> --}}

                                </div>
                                <form action="{{ route('owner.property.energy.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label for="month" class="form-label">Month</label>
                                            <input type="month" class="form-control" id="month" name="month"
                                                required>
                                        </div>


                                        <div class="mb-3">
                                            <label for="utility_type" class="form-label">Utility Type</label>
                                            <select class="form-control" id="utility_type" name="utility_type" required>
                                                <option value="">Select Utility</option>
                                                <option value="electricity">Electricity</option>
                                                <option value="fuel">Fuel</option>
                                                <option value="water">Water</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <!-- Radio buttons for selecting Commercial or Non-Commercial -->
                                            <label class="form-label">Select Property Type</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="property_type"
                                                    id="commercial" value="commercial" checked>
                                                <label class="form-check-label" for="commercial">Commercial</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="property_type"
                                                    id="non_commercial" value="non_commercial">
                                                <label class="form-check-label" for="non_commercial">Non-Commercial</label>
                                            </div>
                                        </div>

                                        <!-- Select dropdown for properties -->
                                        <div class="mb-3">
                                            <label for="property_id" class="form-label">Property</label>
                                            <select class="form-control" id="property_id" name="property_id" required>
                                                <option value="" disabled selected>Select a property</option>
                                                <!-- Options will be dynamically updated based on selection -->
                                            </select>
                                        </div>

                                        {{-- @dd($commercialProperties) --}}



                                        <div class="mb-3">
                                            <label for="cost" class="form-label">Cost</label>
                                            <input type="number" step="0.01" class="form-control" id="cost"
                                                name="cost" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="notes" class="form-label">Notes (Optional)</label>
                                            <textarea class="form-control" id="notes" name="notes"></textarea>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="theme-btn btn-sm mb-25"
                                            style="background-color: #7f7e7e; color: white;" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <button type="submit" class="theme-btn btn-sm mb-25">Save Record</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Import Utility Modal -->
                    <div class="modal fade" id="importUtilityModal" tabindex="-1"
                        aria-labelledby="importUtilityModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="importUtilityModalLabel">Import Utility Records</h5>
                                </div>
                                <form action="{{ route('owner.property.energy.import') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="file" class="form-label">Import Excel File</label>
                                            <input type="file" class="form-control" id="file" name="file"
                                                accept=".xls,.xlsx" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="theme-btn btn-sm mb-25"
                                            style="background-color: #7f7e7e; color: white;"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="theme-btn btn-sm mb-25">Import Records</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>

            </div>


        </div>
    </div>


    {{-- <!-- Add Information Modal End -->
    <input type="hidden" id="getInfoRoute" value="{{ route('owner.information.get.info') }}">
    <input type="hidden" id="route" value="{{ route('owner.information.index') }}"> --}}
@endsection
@push('style')
    @include('common.layouts.datatable-style')
@endpush

@push('script')
    @include('common.layouts.datatable-script')
    <script src="{{ asset('assets/js/custom/information.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#utilitiesTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "pageLength": 10,
                "order": [
                    [0, 'asc']
                ],
                "language": {
                    "paginate": {
                        "previous": "Previous",
                        "next": "Next"
                    }
                }
            });

            // Handle delete confirmation
            $('.delete-form').on('submit', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to delete this record?')) {
                    this.submit();
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const commercialProperties =
                @json($commercialProperties); // Assuming $commercialProperties is available in Blade
            const nonCommercialProperties =
                @json($nonCommercialProperties); // Assuming $nonCommercialProperties is available in Blade

            // Get references to the radio buttons and the property select dropdown
            const commercialRadio = document.getElementById("commercial");
            const nonCommercialRadio = document.getElementById("non_commercial");
            const propertySelect = document.getElementById("property_id");

            // Function to update property options
            function updatePropertyOptions(properties) {
                // Clear the existing options
                propertySelect.innerHTML = '<option value="" disabled selected>Select a property</option>';

                // Add new options based on selected property type
                properties.forEach(function(property) {
                    const option = document.createElement("option");
                    option.value = property.id;
                    option.textContent = property.name;
                    propertySelect.appendChild(option);
                });
            }

            // Initial load based on default selection (Commercial)
            updatePropertyOptions(commercialProperties);

            // Event listeners to update property options based on radio button selection
            commercialRadio.addEventListener("change", function() {
                if (commercialRadio.checked) {
                    updatePropertyOptions(commercialProperties);
                }
            });

            nonCommercialRadio.addEventListener("change", function() {
                if (nonCommercialRadio.checked) {
                    updatePropertyOptions(nonCommercialProperties);
                }
            });
        });
    </script>
@endpush
