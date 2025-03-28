{{-- @extends('owner.layouts.app')

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

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('owner.property.energy.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
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
                            <label for="consumption" class="form-label">Consumption (kWh, Liters, etc.)</label>
                            <input type="number" step="0.01" class="form-control" id="consumption" name="consumption"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="cost" class="form-label">Cost (in your currency)</label>
                            <input type="number" step="0.01" class="form-control" id="cost" name="cost"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes (Optional)</label>
                            <textarea class="form-control" id="notes" name="notes"></textarea>
                        </div>

                        <button type="submit" class="theme-btn btn-sm">Save Record</button>
                    </form>


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
@endpush --}}
