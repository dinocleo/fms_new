@extends('owner.layouts.app')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- Page Content Wrapper Start -->
                <div class="page-content-wrapper bg-white p-30 radius-20">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div
                                class="page-title-box d-sm-flex align-items-center justify-content-between border-bottom mb-20">
                                <div class="page-title-left">
                                    <h3 class="mb-sm-0">Add Unit </h3>
                                </div>
                                <div class="page-title-right">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('owner.dashboard') }}"
                                                title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route('owner.property.allProperty') }}"
                                                title="{{ __('Properties') }}">{{ __('Properties') }}</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page"></li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <!-- All Property Area row Start -->
                    <div class="all-property-area">
                        <!-- Add Property Stepper Area Start -->
                        <div class="add-property-stepper-area">
                            <div class="row">
                                <!-- Stepper Start -->
                                <div class="col-12">
                                    <div id="msform">

                                        <div class="stepper-progressbar-wrap radius-10 theme-border p-25 mb-25">
                                            <ul id="progressbar" class="text-center">
                                                <li class="active">
                                                    <a href="{{ route('owner.property.information') }}">
                                                        <span class="form-stepper-nav-icon"><i
                                                                class="ri-home-4-fill"></i></span>
                                                        <span>{{ __('Property Information') }}</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <span class="form-stepper-nav-icon"><i
                                                                class="ri-map-pin-2-fill"></i></span>
                                                        <span>{{ __('Unit') }}</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <span class="form-stepper-nav-icon"><i
                                                                class="ri-layout-4-fill"></i></span>
                                                        <span>{{ __('Sub Unit') }}</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        {{-- <form action="{{ route('unit') }}" method="GET"> --}}
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control" name="address" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">City</label>
                                            <input type="text" class="form-control" name="city" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">State</label>
                                            <input type="text" class="form-control" name="state" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Zip Code</label>
                                            <input type="text" class="form-control" name="zip_code" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Google Map Link (Optional)</label>
                                            <input type="url" class="form-control" name="google_map">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Next</button>
                                        {{-- <a href="{{ route('location') }}" class="btn btn-primary">Next</a> --}}

                                        </form>



                                        {{-- <script>
                                        function toggleFields() {
                                            let propertyType = document.getElementById('property_type').value;
                                            document.getElementById('office-fields').style.display = (propertyType === 'office') ? 'block' : 'none';
                                            document.getElementById('resident-fields').style.display = (propertyType === 'resident') ? 'block' : 'none';
                                        }
                                    </script> --}}


                                        <!-- End:: fieldSets -->
                                    </div>
                                </div>
                                <!-- Stepper End -->
                            </div>
                        </div>
                        <!-- Add Property Stepper Area End -->
                    </div>
                    <!-- All Property Area row End -->
                </div>
                <!-- Page Content Wrapper End -->
            </div>
        </div>
        <!-- End Page-content -->
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/custom/property.js') }}"></script>
@endpush
