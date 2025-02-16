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
                                    <h3 class="mb-sm-0">Add Non-Commercial Property</h3>
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
                                                                class="ri-layout-4-fill"></i></span>
                                                        <span>{{ __('Unit') }}</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <span class="form-stepper-nav-icon"><i
                                                                class="ri-map-pin-2-fill"></i></span>
                                                        <span>{{ __('Sub Units') }}</span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>

                                        <form action="{{ route('owner.property.property.store') }}" method="POST">
                                            @csrf

                                            <div class="select-property-box bg-white theme-border radius-4 p-20 mb-25">
                                                <h6 class="mb-15">{{ __('Select Property Type') }}</h6>
                                                <ul class="nav nav-tabs select-property-nav-tabs border-0" id="propertyTab"
                                                    role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="p-0 me-4 mb-1 nav-link active select_property_type"
                                                            data-property_type="office" id="office-tab" data-bs-toggle="tab"
                                                            data-bs-target="#office-tab-pane" type="button" role="tab"
                                                            aria-controls="office-tab-pane" aria-selected="true">
                                                            <span
                                                                class="select-property-nav-text d-flex align-items-center position-relative">
                                                                <span class="select-property-nav-text-box me-2"></span>🏢
                                                                {{ __('Office') }}
                                                            </span>
                                                        </button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="p-0 me-4 mb-1 nav-link select_property_type"
                                                            data-property_type="resident" id="resident-tab"
                                                            data-bs-toggle="tab" data-bs-target="#resident-tab-pane"
                                                            type="button" role="tab" aria-controls="resident-tab-pane"
                                                            aria-selected="false">
                                                            <span
                                                                class="select-property-nav-text d-flex align-items-center position-relative">
                                                                <span class="select-property-nav-text-box me-2"></span>🏠
                                                                {{ __('Resident') }}
                                                            </span>
                                                        </button>
                                                    </li>
                                                </ul>
                                                <input type="hidden" name="property_type" id="property_type"
                                                    value="office">
                                            </div>

                                            <div class="select-property-box bg-white theme-border radius-4 p-20 mb-25">
                                                <div id="common-fields">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Property Name</label>
                                                            <input type="text" class="form-control" name="property_name"
                                                                placeholder="Enter property name" required>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label">Property Address</label>
                                                            <input type="text" class="form-control"
                                                                name="property_address" placeholder="Enter property Address"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Description</label>
                                                        <textarea class="form-control" name="description" style="height: 100px; width: 100%;"></textarea>
                                                    </div>
                                                </div>


                                                <div id="office-fields">
                                                    {{-- <h4>Office Details</h4> --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">Number of Units</label>
                                                        <input type="number" class="form-control" name="number_of_units"
                                                            placeholder="Enter property Number of Units" required>
                                                    </div>
                                                </div>

                                                <div id="resident-fields" style="display: none;">
                                                    {{-- <h4>Resident Details</h4> --}}
                                                    <div class="mb-3">
                                                        <label class="form-label">Number of Units</label>
                                                        <input type="number" class="form-control" name="number_of_unit"
                                                            placeholder="Enter property Number of Units" required>
                                                    </div>
                                                </div>
                                                <button type="submit"
                                                    class="action-button theme-btn mt-25">{{ __('Save & Go to Next') }}</button>
                                            </div>
                                        </form>

                                        <script>
                                            function toggleFields(type) {
                                                // Show or hide sections based on selection
                                                document.getElementById('office-fields').style.display = (type === 'office') ? 'block' : 'none';
                                                document.getElementById('resident-fields').style.display = (type === 'resident') ? 'block' : 'none';
                                                document.getElementById('property_type').value = type;
                                                // Remove 'required' attribute from hidden fields
                                                toggleRequiredFields(type);
                                            }

                                            function toggleRequiredFields(type) {
                                                let officeFields = document.querySelectorAll('#office-fields [required]');
                                                let residentFields = document.querySelectorAll('#resident-fields [required]');

                                                if (type === 'office') {
                                                    officeFields.forEach(field => field.setAttribute('required', 'true'));
                                                    residentFields.forEach(field => field.removeAttribute('required'));
                                                } else {
                                                    residentFields.forEach(field => field.setAttribute('required', 'true'));
                                                    officeFields.forEach(field => field.removeAttribute('required'));
                                                }
                                            }

                                            document.addEventListener('DOMContentLoaded', function() {
                                                toggleFields('office'); // Default to office selection
                                            });

                                            // Event listeners for property type selection
                                            document.querySelectorAll('.select_property_type').forEach(button => {
                                                button.addEventListener('click', function() {
                                                    let selectedType = this.getAttribute('data-property_type');
                                                    toggleFields(selectedType);
                                                });
                                            });
                                        </script>
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
