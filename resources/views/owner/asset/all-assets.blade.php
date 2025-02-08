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
                        <h4 class="mb-20">{{ __('All Assets') }}</h4>
                        <div class="property-top-search-bar">
                            <div class="property-search-inner-bg bg-off-white theme-border radius-4 p-25 mb-25">
                                <div class="row align-items-center rg-25">
                                    <div class="col-md-6">
                                        <div class="property-top-search-bar-left">
                                                    <select class="form-select flex-shrink-0 " id="search_property">
                                                        <option value="" selected>{{ __('Select Property') }}</option>
                                                        @foreach ($assets as $asset)
                                                            <option value="{{ $asset->gateway }}">{{ $asset->gateway }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="property-top-search-bar-right text-md-end">
                                            <button type="button" class="theme-btn" id="add"
                                                title="{{ __('Add Assets') }}">{{ __('Add Assets') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Property Top Search Bar End -->

                        <!-- All Maintainer Table Area Start -->
                        <div class="all-maintainer-table-area">
                            <!-- datatable Start -->
                            <div class="bg-off-white theme-border radius-4 p-25">
                                <table id="allMaintenanceDataTable" class="table bg-off-white aaa theme-border dt-responsive">
                                    <thead>
                                        <tr>
                                            <th>{{ __('SL') }}</th>
                                            <th>{{ __('Property') }}</th>
                                            <th>{{ __('Unit Name') }}</th>
                                            <th data-priority="1">{{ __('Issue Name') }}</th>
                                            <th>{{ __('Details') }}</th>
                                            <th>{{ __('Created Date') }}</th>
                                            <th>{{ __('Resolved Date') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- datatable End -->
                        </div>
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
                                        @if(count($categories)>0)
                                        @foreach($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                        @endif                                        
                                    </select>
                                </div>

                                <div class="col-md-6 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Manufacturer') }}</label>
                                    <select class="form-select flex-shrink-0 property_id" name="manufacturer_id">
                                        <option value="" selected>--{{ __('Select Manufacturer') }}--</option>
                                        @if(count($manufacturer)>0)
                                        @foreach($manufacturer as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                        @endif   
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
                                    <label class="label-text-title color-heading font-medium mb-2">{{ __('Condition') }}</label>
                                    <select class="form-select flex-shrink-0 property_id" name="condition_id">
                                        <option value="" selected>--{{ __('Select Condition') }}--</option>
                                        @if(count($conditions)>0)
                                        @foreach($conditions as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                        @endif   
                                    </select>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-6 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Property') }}</label>
                                    <select class="form-select flex-shrink-0 property_id" name="property_id">
                                        <option value="" selected>--{{ __('Select Property') }}--</option>
                                        @foreach ($properties as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                                    <select class="form-select flex-shrink-0 sub_unit_id" name="sub_unit_id">
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
 

    <input type="hidden" id="getPropertyUnitsRoute" value="{{ route('owner.property.getPropertyUnits') }}">
    <input type="hidden" id="getUnitsRoute" value="{{ route('owner.property.sub-unit.getSubUnits') }}">

    {{-- <input type="hidden" id="getSubUnitsRoute" value="{{ route('owner.property.getSubUnits') }}"> --}}

@endsection
@push('style')
    @include('common.layouts.datatable-style')
@endpush

@push('script')
    @include('common.layouts.datatable-script')
    <script src="{{ asset('assets/js/custom/asset.js') }}"></script>
@endpush
