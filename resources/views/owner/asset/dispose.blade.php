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
                                    <h3 class="mb-sm-0">{{ $pageTitle }}</h3>
                                </div>
                                <div class="page-title-right">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('owner.dashboard') }}"
                                                title="Dashboard">{{ __('Dashboard') }}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Information Page Area row Start -->
                    <div class="row">
                        <!-- Property Top Search Bar Start -->
                        {{-- <h4 class="mb-20">{{ __('All Assets') }}</h4> --}}
                        <div class="property-top-search-bar">
                            <div class="property-search-inner-bg bg-off-white theme-border radius-4 p-25 mb-25">
                                <div class="row">
                                    <div class="col-xl-12 col-xxl-6 tenants-top-bar-left">
                                        <form action="{{ route('owner.assets.disposeAsset') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                            @if (getOption('app_card_data_show', 1) == 1)
                                                <div class="col-md-6 col-lg-6 col-xl-4 col-xxl-4 mb-25">
                                                    <input type="text" required class="form-control" name="tag"  placeholder="Enter Asset Tag">
                                                </div>
                                                <div class="col-auto mb-25">
                                                    <button type="submit" class="theme-btn"
                                                     >{{ __('Dispose') }}</button>
                                                </div>
                                            @endif
                                        </div>
                                    </form>
                                </div>

                                   
                                </div>
                            </div>
                        </div>
                        <!-- Property Top Search Bar End -->

                        <!-- All Maintainer Table Area Start -->
                     
                        <!-- All Maintainer Table Area End -->
                    </div>
                    <!-- Information Page Area row End -->
                </div>
                <!-- Page Content Wrapper End -->
            </div>
        </div>
        <!-- End Page-content -->
    </div>

    <!-- Add Information Modal Start -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addModalLabel">{{ __('Add Asset') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                            class="iconify" data-icon="akar-icons:cross"></span></button>
                </div>
                <form class="ajax" action="{{ route('owner.assets.save-asset') }}" method="POST"
                    data-handler="getShowMessage">
                    <div class="modal-body">
                        <!-- Modal Inner Form Box Start -->
                        <div class="modal-inner-form-box">

                            <div class="row">
                                <div class="col-md-6 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Name') }}</label>
                                        <input type="text" class="form-control" name="name">

                                </div>
                                <div class="col-md-6 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Tag') }}</label>
                                        <input type="text" class="form-control" name="tag">

                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-6 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Category') }}</label>
                                    <select class="form-select flex-shrink-0 category_id" name="category_id">
                                        <option value="">--{{ __('Select Category') }}--</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Manufacturer') }}</label>
                                    <select class="form-select flex-shrink-0 property_id" name="manufacturer_id">
                                        <option value="" selected>--{{ __('Select Manufacturer') }}--</option>
                                        @foreach ($assets as $asset)
                                            <option value="{{ $asset->id }}">{{ $asset->gateway }}</option>
                                        @endforeach
                                    </select>
                                </div>
                               
                            </div>



                            <div class="row">
                                <div class="col-md-6 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Purchase Date') }}</label>
                                        <input type="date" class="form-control" name="purchase_date">

                                </div>
                                <div class="col-md-6 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Condition') }}</label>
                                    <select class="form-select flex-shrink-0 property_id" name="condition_id">
                                        <option value="" selected>--{{ __('Select Condition') }}--</option>
                                        @foreach ($assets as $asset)
                                            <option value="{{ $asset->id }}">{{ $asset->gateway }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-6 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Property') }}</label>
                                    <select class="form-select flex-shrink-0 property_id" name="property_id">
                                        <option value="" selected>--{{ __('Select Property') }}--</option>
                                        @foreach ($assets as $asset)
                                            <option value="{{ $asset->id }}">{{ $asset->gateway }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Unit') }}</label>
                                    <select class="form-select flex-shrink-0 unit_id" name="unit_id">
                                        <option value="">--{{ __('Select Unit') }}--</option>
                                    </select>
                                </div>

                              
                            </div>

                            
                            <div class="row">
                             

                                <div class="col-md-6 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Sub Unit') }}</label>
                                    <select class="form-select flex-shrink-0 unit_id" name="unit_id">
                                        <option value="">--{{ __('Select Sub Unit') }}--</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Vendor') }}</label>
                                    <select class="form-select flex-shrink-0 property_id" name="vendor_id">
                                        <option value="" selected>--{{ __('Select Vendor') }}--</option>
                                        @foreach ($assets as $asset)
                                            <option value="{{ $asset->id }}">{{ $asset->gateway }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>



                            
                            <div class="row">
                              
                                <div class="col-md-6 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Purchase Cost (TZS)') }}</label>
                                        <input type="Number" class="form-control" name="name">

                                </div>

                                <div class="col-md-6 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Depreciation Class') }}</label>
                                    <select class="form-select flex-shrink-0 depreciation_class_id" name="depreciation_class_id">
                                        <option value="">--{{ __('Select Depreciation Class') }}--</option>
                                    </select>
                                </div>
                            </div>

                          
                           
                            <div class="row">
                                <div class="col-md-12 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Missing Description') }}</label>
                                    <textarea class="form-control details" name="missing_description" placeholder="{{ __('Description') }}"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Image') }}</label>
                                    <input type="file" class="form-control" name="image">
                                </div>
                            </div>
                        </div>
                        <!-- Modal Inner Form Box End -->
                    </div>

                    <div class="modal-footer justify-content-start">
                        <button type="button" class="theme-btn-back me-3" data-bs-dismiss="modal"
                            title="{{ __('Back') }}">{{ __('Back') }}</button>
                        <button type="submit" class="theme-btn me-3"
                            title="{{ __('Save Asset') }}">{{ __('Save Asset') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 
    <!-- Add Information Modal End -->
    <input type="hidden" id="getInfoRoute" value="{{ route('owner.maintenance-request.get.info') }}">
    <input type="hidden" id="route" value="{{ route('owner.maintenance-request.index') }}">
    <input type="hidden" id="getPropertyUnitsRoute" value="{{ route('owner.property.getPropertyUnits') }}">
@endsection
@push('style')
    @include('common.layouts.datatable-style')
@endpush

@push('script')
    @include('common.layouts.datatable-script')
    <script src="{{ asset('assets/js/custom/maintenance-request.js') }}"></script>
@endpush
