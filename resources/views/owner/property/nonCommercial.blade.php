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
                                    <h3 class="mb-sm-0">Non Commercial<span
                                            class="property-count theme-text-color">  </span></h3>
                                </div>
                                <div class="page-title-right">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('owner.dashboard') }}"
                                                title=></a></li>
                                        <li class="breadcrumb-item active" aria-current="page"></li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- All Property Area row Start -->
                    <div class="row">
                        <!-- Property Top Search Bar Start -->
                        <div class="property-top-search-bar">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('owner.property.nonCommercialAdd') }}" class="theme-btn mb-25"
                                        title={{ __('Add New Non Commercial') }}>{{ __('Add New Non Commercial') }}</a>
                                </div>
                            </div>
                        </div>
                        <!-- Property Top Search Bar End -->

                        <!-- Properties Item Wrap Start -->
                        <div class="properties-item-wrap">
                            <div class="row">
                            </div>
                        </div>
                        <!-- Properties Item Wrap End -->
                    </div>
                    <!-- All Property Area row End -->
                </div>
                <!-- Page Content Wrapper End -->
            </div>
        </div>
        <!-- End Page-content -->
    </div>
    <input type="hidden" id="getAllPropertyRoute" value="{{ route('owner.property.allProperty') }}">
@endsection
@if (getOption('app_card_data_show', 1) != 1)
    @push('style')
        @include('common.layouts.datatable-style')
    @endpush
    @push('script')
        @include('common.layouts.datatable-script')
        <script src="{{ asset('assets/js/custom/propery-datatable.js') }}"></script>
    @endpush
@endif
