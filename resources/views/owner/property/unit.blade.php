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
                                    <h3 class="mb-sm-0">Add Property</h3>
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
                                                        <span>{{ __('Location') }}</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="select-property-box bg-white theme-border radius-4 p-20 mb-25">
                                            <form
                                                action="{{ route('owner.property.non_unit.store', ['propertyId' => $property->id]) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf

                                                @php
                                                    // Check if property type is 'office' from the database
                                                    $isOffice = $property->property_type === 'office';
                                                    // Determine the number of units based on property type
                                                    $unitCount = $isOffice
                                                        ? $property->number_of_units
                                                        : $property->number_of_unit;
                                                @endphp

                                                @for ($i = 0; $i < $unitCount; $i++)
                                                    <div
                                                        class="select-property-box bg-white theme-border radius-4 p-20 mb-25">
                                                        <input type="hidden" name="multiple[id][]" value="">
                                                        <div class="row">
                                                            <div class="col-md-2 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Unit Name') }}</label>
                                                                <input type="text" name="multiple[unit_name][]"
                                                                    class="form-control"
                                                                    placeholder="{{ __('Unit Name') }}">
                                                            </div>

                                                            <!-- Bedroom Field - Hidden if office -->
                                                            <div class="col-md-2 mb-25" id="bedroomField"
                                                                style="{{ $isOffice ? 'display: none;' : '' }}">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Bedroom') }}</label>
                                                                <input type="number" min="0"
                                                                    name="multiple[bedroom][]" class="form-control"
                                                                    placeholder="0">
                                                            </div>

                                                            <!-- Bath Field - Hidden if office -->
                                                            <div class="col-md-2 mb-25" id="bathField"
                                                                style="{{ $isOffice ? 'display: none;' : '' }}">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Baths') }}</label>
                                                                <input type="number" min="0" name="multiple[bath][]"
                                                                    class="form-control" placeholder="0">
                                                            </div>

                                                            <!-- Kitchen Field - Hidden if office -->
                                                            <div class="col-md-2 mb-25" id="kitchenField"
                                                                style="{{ $isOffice ? 'display: none;' : '' }}">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Kitchen') }}</label>
                                                                <input type="number" min="0"
                                                                    name="multiple[kitchen][]" class="form-control"
                                                                    placeholder="0">
                                                            </div>

                                                            <div class="col-md-2 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Square metre') }}</label>
                                                                <input type="text" name="multiple[square_feet][]"
                                                                    class="form-control"
                                                                    placeholder="{{ __('Square metre') }}">
                                                            </div>

                                                            <div class="col-md-2 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Amenities') }}</label>
                                                                <input type="text" name="multiple[amenities][]"
                                                                    class="form-control"
                                                                    placeholder="{{ __('Amenities') }}">
                                                            </div>

                                                            <div class="col-md-2 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Condition') }}</label>
                                                                <select name="multiple[condition][]" class="form-control">
                                                                    <option value="new"
                                                                        {{ old('multiple.condition') == 'new' ? 'selected' : '' }}>
                                                                        New</option>
                                                                    <option value="good"
                                                                        {{ old('multiple.condition') == 'good' ? 'selected' : '' }}>
                                                                        Good</option>
                                                                    <option value="fair"
                                                                        {{ old('multiple.condition') == 'fair' ? 'selected' : '' }}>
                                                                        Fair</option>
                                                                    <option value="poor"
                                                                        {{ old('multiple.condition') == 'poor' ? 'selected' : '' }}>
                                                                        Poor</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-2 mb-25">
                                                                <label
                                                                    class="label-text-title color-heading font-medium mb-2">{{ __('Parking') }}</label>

                                                                <!-- Parking Radio Buttons for Each Unit -->
                                                                <div class="d-flex">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="multiple[parking][{{ $i }}]"
                                                                            id="parkingNo{{ $i }}"
                                                                            value="0">
                                                                        <label class="form-check-label"
                                                                            for="parkingNo{{ $i }}">{{ __('No') }}</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="multiple[parking][{{ $i }}]"
                                                                            id="parkingYes{{ $i }}"
                                                                            value="1">
                                                                        <label class="form-check-label"
                                                                            for="parkingYes{{ $i }}">{{ __('Yes') }}</label>
                                                                    </div>


                                                                </div>
                                                                <!-- Has Sub-Unit Checkbox -->
                                                                <div class="form-check form-check-inline ml-4">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        name="multiple[sub_unit][{{ $i }}]"
                                                                        id="subUnit{{ $i }}" value="1">
                                                                    <label class="form-check-label"
                                                                        for="subUnit{{ $i }}">{{ __('Has Sub-Unit') }}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endfor

                                                <button type="submit"
                                                    class="action-button theme-btn mt-25">{{ __('Save & Go to Next') }}</button>
                                            </form>
                                        </div>



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

    {{-- <input type="hidden" id="property_id" value="{{ @$property->id }}">
    <input type="hidden" id="getStateListRoute" value="{{ route('owner.location.state.list') }}">
    <input type="hidden" id="getCityListRoute" value="{{ route('owner.location.city.list') }}">
    <input type="hidden" id="imageStoreRoute" value="{{ route('owner.property.image.store') }}">
    <input type="hidden" id="imageDoc" value="{{ route('owner.property.image.doc') }}">
    <input type="hidden" id="getPropertyInformationRoute" value="{{ route('owner.property.getPropertyInformation') }}">
    <input type="hidden" id="getLocationRoute" value="{{ route('owner.property.getLocation') }}">
    <input type="hidden" id="getUnitRoute" value="{{ route('owner.property.getUnitByPropertyId') }}">
    <input type="hidden" id="getRentChargeRoute" value="{{ route('owner.property.getRentCharge') }}"> --}}
@endsection

@push('script')
    <script src="{{ asset('assets/js/custom/property.js') }}"></script>
@endpush
