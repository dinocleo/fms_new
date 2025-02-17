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

                                        <!-- Stepper Progress Bar -->
                                        <div class="stepper-progressbar-wrap radius-10 theme-border p-25 mb-25">
                                            <ul id="progressbar" class="text-center">
                                                <!-- Property Information Step -->
                                                <li
                                                    class="{{ request()->routeIs('owner.property.nonCommercial') ? 'active' : '' }}">
                                                    <a href="{{ route('owner.property.nonCommercial') }}">
                                                        <span class="form-stepper-nav-icon"><i
                                                                class="ri-home-4-fill"></i></span>
                                                        <span>{{ __('Property Information') }}</span>
                                                    </a>
                                                </li>

                                                @php
                                                    $propertyId =
                                                        request()->route('propertyId') ?? request()->route('id'); // Get the property ID from the route
                                                @endphp

                                                <!-- Unit Step (Requires propertyId) -->
                                                <li class="{{ request()->routeIs('owner.property.unit') ? 'active' : '' }}">
                                                    @if ($propertyId)
                                                        <a
                                                            href="{{ route('owner.property.unit', ['propertyId' => $propertyId]) }}">
                                                            <span class="form-stepper-nav-icon"><i
                                                                    class="ri-layout-4-fill"></i></span>
                                                            <span>{{ __('Unit') }}</span>
                                                        </a>
                                                    @else
                                                        <span class="form-stepper-nav-icon"><i
                                                                class="ri-layout-4-fill"></i></span>
                                                        <span>{{ __('Unit') }}</span>
                                                    @endif
                                                </li>

                                                <!-- Sub Unit Step (Requires id, which we assume is the same as propertyId) -->
                                                <li
                                                    class="{{ request()->routeIs('owner.property.subUnits') ? 'active' : '' }}">
                                                    @if ($propertyId)
                                                        <a
                                                            href="{{ route('owner.property.subUnits', ['id' => $propertyId]) }}">
                                                            <span class="form-stepper-nav-icon"><i
                                                                    class="ri-map-pin-2-fill"></i></span>
                                                            <span>{{ __('Sub Unit') }}</span>
                                                        </a>
                                                    @else
                                                        <span class="form-stepper-nav-icon"><i
                                                                class="ri-map-pin-2-fill"></i></span>
                                                        <span>{{ __('Sub Unit') }}</span>
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Property Selection Box -->
                                        <div class="select-property-box bg-white theme-border radius-4 p-20 mb-25">
                                            <form
                                                action="{{ route('owner.property.sub_unit.store', ['propertyId' => $propertyId]) }}"
                                                method="POST">
                                                @csrf

                                                <!-- Sub-Unit Fields Container -->
                                                <div id="subUnitFields">
                                                    <div class="sub-unit-group">
                                                        <div class="row align-items-center">
                                                            <!-- Unit Name Input -->
                                                            <div class="col-md-5">
                                                                <label for="unit_name">{{ __('Unit Name') }}</label>
                                                                <input type="text" name="multiple[unit_name][]"
                                                                    class="form-control"
                                                                    placeholder="{{ __('Unit Name') }}" required>
                                                            </div>
                                                            <!-- Amenities Input -->
                                                            <div class="col-md-5">
                                                                <label for="amenities">{{ __('Amenities') }}</label>
                                                                <input type="text" name="multiple[amenities][]"
                                                                    class="form-control"
                                                                    placeholder="{{ __('Amenities') }}">
                                                            </div>
                                                            <!-- Remove Button -->
                                                            <div class="col-md-2 text-right mt-4">
                                                                <button type="button" class="btn removeField"
                                                                    style="display: none;">
                                                                    <i class="ri-delete-bin-6-line"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Action Buttons -->
                                                <div class="row mt-3">
                                                    <div class="col-md-6">
                                                        <button type="button" class="action-button theme-btn mt-25"
                                                            id="addMoreFields">
                                                            {{ __('Add More Sub-Unit') }}
                                                        </button>
                                                    </div>
                                                    <div class="col-md-6 text-right">
                                                        <button type="submit" class="action-button theme-btn mt-25">
                                                            {{ __('Save Sub-Units') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <!-- JavaScript to Manage Dynamic Fields -->
                                        <script>
                                            document.getElementById('addMoreFields').addEventListener('click', function() {
                                                // Clone the first sub-unit group
                                                const newSubUnitGroup = document.querySelector('.sub-unit-group').cloneNode(true);

                                                // Clear input values in the cloned fields
                                                newSubUnitGroup.querySelectorAll('input').forEach(input => input.value = '');

                                                // Display remove button
                                                const removeButton = newSubUnitGroup.querySelector('.removeField');
                                                removeButton.style.display = 'inline-flex';

                                                // Append the new sub-unit group
                                                document.getElementById('subUnitFields').appendChild(newSubUnitGroup);
                                            });

                                            document.getElementById('subUnitFields').addEventListener('click', function(event) {
                                                if (event.target.closest('.removeField')) {
                                                    event.target.closest('.sub-unit-group').remove();
                                                }
                                            });
                                        </script>

                                        <!-- Custom CSS for Styling -->
                                        <style>
                                            .removeField {
                                                width: 25px;
                                                height: 25px;
                                                border-radius: 50%;
                                                display: flex;
                                                align-items: center;
                                                justify-content: center;
                                                font-size: 18px;
                                                color: #fff;
                                                background-color: #dc3545;
                                                border: none;
                                                transition: background 0.3s ease;
                                            }

                                            .removeField:hover {
                                                background-color: #c82333;
                                                opacity: 0.9;
                                            }

                                            .removeField i {
                                                font-size: 16px;
                                            }
                                        </style>

                                    </div>
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
