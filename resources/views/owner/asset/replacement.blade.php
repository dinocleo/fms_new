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
                            <div class="row align-items-center rg-25">
                                <form  class="ajax" method="post" style="display:-webkit-box;" action="{{ route('owner.assets.replacement.fetchLocation') }}" id="fetchLocationFormID">
                                         @csrf                              
                                            <div class="col-md-6">
                                                <div class="property-top-search-bar-left">
                                                    <input autofocus type="text" class="form-control" id="tag" name="tag"
                                                        placeholder="Enter asset Tag">

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="property-top-search-bar-right text-md-end">
                                                    <button type="button" class="theme-btn fetch_location"  
                                                        title="{{ __('Fetch Location') }}">{{ __('Fetch Location') }}</button>
                                                </div>
                                            </div>

                                </form>
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="addModalLabel">{{ __('Current Location') }}</h4>

                                    </div>
                                    <form action="{{ route('owner.assets.save-asset') }}" method="POST"
                                        data-handler="getShowMessage">

                                        @csrf
                                        <div class="modal-body">
                                            <!-- Modal Inner Form Box Start -->
                                            <div class="modal-inner-form-box">

                                                <div class="row">
                                                    <div class="col-md-6 mb-25">
                                                        <label
                                                            class="label-text-title color-heading font-medium mb-2">{{ __('Property') }}</label>
                                                            <input type="text" class="form-control" name="tag"
                                                            placeholder="" readonly id="current_property">
                                                    </div>
                                                    <div class="col-md-6 mb-25">
                                                        <label
                                                            class="label-text-title color-heading font-medium mb-2">{{ __('Unit') }}</label>
                                                            <input type="text" class="form-control" name="tag"
                                                            placeholder="" id="current_unit" readonly>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-md-6 mb-25">
                                                        <label
                                                            class="label-text-title color-heading font-medium mb-2">{{ __('Sub Unit') }}</label>
                                                            <input type="text" class="form-control" name="tag"
                                                            placeholder="" id="current_sub_unit" readonly>
                                                    </div>

                                                </div> 

                                            </div>
                                            <!-- Modal Inner Form Box End -->
                                        </div>

                      
                                    </form>

                                    <div class="modal-header">
                                        <h4 class="modal-title" id="addModalLabel">{{ __('New Location') }}</h4>

                                    </div>
                                    <form action="{{ route('owner.assets.replacement.updateLocation') }}" method="POST" id="updateLocationForm"
                                        data-handler="getShowMessage">

                                        @csrf
                                        <input type="hidden" name="asset_id" id="asset_id">

                                        <div class="modal-body">
                                            <!-- Modal Inner Form Box Start -->
                                            <div class="modal-inner-form-box">

                                                <div class="row">
                                                    <div class="col-md-6 mb-25">
                                                        <label
                                                            class="label-text-title color-heading font-medium mb-2">{{ __('Property') }}</label>
                                                        <select class="form-select flex-shrink-0 property_id"
                                                            name="property_id">
                                                            <option value="" selected>--{{ __('Select New Property') }}--
                                                            </option>
                                                            @foreach ($properties as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-25">
                                                        <label
                                                            class="label-text-title color-heading font-medium mb-2">{{ __('Unit') }}</label>
                                                        <select class="form-select flex-shrink-0 unit_id"
                                                            name="unit_id">
                                                            <option value="">--{{ __('Select New Unit') }}--</option>
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-md-6 mb-25">
                                                        <label
                                                            class="label-text-title color-heading font-medium mb-2">{{ __('Sub Unit') }}</label>
                                                        <select class="form-select flex-shrink-0 sub_unit_id"
                                                            name="sub_unit_id">
                                                            <option value="">--{{ __('Select New Sub Unit') }}--</option>
                                                        </select>
                                                    </div>

                                                </div>

                                            </div>
                                            <!-- Modal Inner Form Box End -->
                                        </div>

                                        <div class="modal-footer justify-content-start" style="padding-top: 0px;">

                                            <button type="button" id="submit_button_id" class="theme-btn submit_button_id me-3 updateLocation"
                                                title="{{ __('Save Asset') }}">{{ __('Save Changes') }}</button>
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

 

<!-- Add Information Modal End -->
<input type="hidden" id="getReplacementRoute" value="{{ route('owner.assets.replacement.fetchLocation') }}">

<input type="hidden" id="getPropertyUnitsRoute" value="{{ route('owner.property.getPropertyUnits') }}">
<input type="hidden" id="getInfoRoute" value="{{ route('owner.maintenance-request.get.info') }}">
<input type="hidden" id="route" value="{{ route('owner.maintenance-request.index') }}">
<input type="hidden" id="getUnitsRoute" value="{{ route('owner.property.sub-unit.getSubUnits') }}">
<input type="hidden" id="newLocationInfo" value="{{ route('owner.assets.replacement.updateLocation') }}">



@endsection
@push('style')
@include('common.layouts.datatable-style')
@endpush

@push('script')
@include('common.layouts.datatable-script')
<script src="{{ asset('assets/js/custom/replacement-request.js') }}"></script>
@endpush