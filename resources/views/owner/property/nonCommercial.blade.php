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
                                    <h3 class="mb-sm-0">Non Commercial<span class="property-count theme-text-color"> </span>
                                    </h3>
                                </div>
                                <div class="page-title-right">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="{{ route('owner.dashboard') }}" title=></a>
                                        </li>
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
                        {{-- <div class="properties-item-wrap">
                            <div class="row">

                            </div>
                        </div> --}}
                        <div class="container">
                            <!-- Search Form -->
                            <form method="GET" action="{{ route('owner.property.nonCommercial') }}" class="mb-4 text-end">
                                <div class="input-group d-inline-flex">
                                    <input type="text" name="search" class="form-control form-control-sm"
                                        placeholder="Search properties..." value="{{ request('search') }}">
                                    <button type="submit" class="theme-btn btn-sm">Search</button>
                                </div>
                            </form>

                            <!-- Properties List -->
                            <div class="properties-item-wrap">
                                <div class="row">
                                    @foreach ($properties as $property)
                                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                                            <!-- 1 column on small screens, 2 on medium, 3 on large, 4 on xl -->
                                            <div
                                                class="property-item bg-off-white theme-border radius-10 position-relative mb-25">
                                                <div class="property-item-content p-20">
                                                    <h4 class="property-item-title position-relative">
                                                        <a href="{{ route('owner.property.show', $property->id) }}"
                                                            class="color-heading link-hover-effect me-3">{{ substr_replace($property->property_name, '...', 20) }}</a>
                                                    </h4>

                                                    <div
                                                        class="property-item-info d-flex mt-15 flex-wrap bg-white theme-border py-3 px-2 radius-4">
                                                        <div class="property-info-item font-13">
                                                            <strong>Type:</strong>
                                                            <span
                                                                class="text-secondary">{{ ucfirst($property->property_type) }}</span>
                                                        </div>
                                                        <div class="property-info-item font-13">
                                                            <strong>Address:</strong>
                                                            <span class="text-muted">
                                                                {{ $property->region }}, {{ $property->district }},
                                                                {{ $property->street }}
                                                            </span>
                                                        </div>
                                                        <div class="property-info-item font-13">
                                                            <strong>Description:</strong>
                                                            <span
                                                                class="text-muted">{{ Str::limit($property->description, 50) ?? 'N/A' }}</span>
                                                        </div>
                                                        <div class="property-info-item font-13">
                                                            <strong>Units:</strong>
                                                            <span class="text-dark">
                                                                {{ $property->number_of_units ?? ($property->number_of_unit ?? 'N/A') }}
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <a href="{{ route('owner.property.show', $property->id) }}"
                                                        class="theme-btn mt-20 w-100" title="{{ __('View Details') }}">
                                                        <i class="fas fa-eye"></i> View Details
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Pagination Links -->
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $properties->appends(['search' => request('search')])->links() }}
                                </div>
                            </div>
                        </div>







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
