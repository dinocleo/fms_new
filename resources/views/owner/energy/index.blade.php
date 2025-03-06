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
                            <div class="col-md-6">
                                <a href="#" class="theme-btn mb-25" data-bs-toggle="modal"
                                    data-bs-target="#addUtilityModal" title="{{ __('Add Record') }}">
                                    {{ __('Add Record') }}
                                </a>
                            </div>

                        </div>
                    </div>

                    <div class="bg-off-white theme-border radius-4 p-25">
                        <div class="table-responsive">
                            <table id="utilitiesTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th> <!-- Serial Number Column -->
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Consumption</th>
                                        <th>Cost</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($utilities as $index => $utility)
                                        <tr>
                                            <td>{{ $index + 1 }}</td> <!-- Display serial number -->
                                            <td>{{ $utility->date }}</td>
                                            <td>{{ ucfirst($utility->utility_type) }}</td>
                                            <td>{{ $utility->consumption }}</td>
                                            <td>{{ $utility->cost }}</td>
                                            <td>
                                                <!-- Edit Button -->
                                                <a href="{{ route('owner.property.energy.edit', $utility->id) }}"
                                                    class="p-1 tbl-action-btn edit">
                                                    <i class="fas fa-edit"></i> <!-- Pencil icon for Edit -->
                                                </a>

                                                <!-- Delete Button -->
                                                <form action="{{ route('owner.property.energy.destroy', $utility->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="p-1 tbl-action-btn" type="submit">
                                                        <i class="fas fa-trash-alt"></i> <!-- Trash icon for Delete -->
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                                            <label for="date" class="form-label">Date</label>
                                            <input type="date" class="form-control" id="date" name="date"
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
                                            <label for="consumption" class="form-label">Consumption (kWh, Liters,
                                                etc.)</label>
                                            <input type="number" step="0.01" class="form-control" id="consumption"
                                                name="consumption" required>
                                        </div>

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
    </script>
@endpush
