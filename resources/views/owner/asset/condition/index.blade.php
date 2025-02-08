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
                                                title="{{ __('Dashboard') }}">{{ __('Dashboard') }}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <!-- All tenants Area row Start -->
                    <div class="row">
                        <!-- Tenants Top Bar Start -->
                        <div class="tenants-top-bar">
                            <div class="property-search-inner-bg bg-off-white theme-border radius-4 p-25 pb-0 mb-25">
                                <div class="row">
                                    <div class="col-xl-12 col-xxl-6 tenants-top-bar-left">
                                        <form action="{{ route('owner.assets.condition.store') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                            @if (getOption('app_card_data_show', 1) == 1)
                                                <div class="col-md-6 col-lg-6 col-xl-4 col-xxl-4 mb-25">
                                                    <input type="text" required class="form-control" name="name"  placeholder="Condition Name">
                                                </div>
                                                <div class="col-auto mb-25">
                                                    <button type="submit" class="default-btn theme-btn-purple w-auto"
                                                     >{{ __('Save') }}</button>
                                                </div>
                                            @endif
                                        </div>
                                    </form>
                                </div>

                                   
                                </div>
                            </div>
                        </div>
                        <!-- Tenants Top Bar End -->

                        <!-- Tenants Item Wrap Start -->
                        <div class="tenants-details-layout-wrap position-relative">
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <div class="account-settings-rightside bg-off-white theme-border radius-4 p-25">
                                        <div class="tenants-details-payment-history">
                                            <div class="account-settings-content-box">
                                                <div class="tenants-details-payment-history-table">
                                                    <table id="allDataTable" class="table responsive theme-border p-20">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ __('ID') }}</th>
                                                                <th data-priority="1">{{ __('Name') }}</th>
                                                                <th>{{ __('Status') }}</th>
                                                                {{-- <th>{{ __('Tenant') }}</th> --}}
                                                                <th class="text-center">{{ __('Action') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($list as $item)
                                                                <tr>
                                                                    <td>{{ $item->id }}</td>
                                                                    <td>{{ $item->name }}</td>
                                                                    <td>{{ $item->status }}</td>
                                                                    <td class="text-center">
                                                                        @if ($item->name!=null)
                                                                        <button class="p-1 tbl-action-btn deleteItem"
                                                                            data-formid="delete_row_form_{{ $item->id }}">
                                                                            <span class="iconify"
                                                                                data-icon="ep:delete-filled"></span>
                                                                        </button>
                                                                        <form
                                                                            action="{{ route('owner.assets.condition.delete', [$item->id]) }}"
                                                                            method="post"
                                                                            id="delete_row_form_{{ $item->id }}">
                                                                            {{ method_field('DELETE') }}
                                                                            <input type="hidden" name="_token"
                                                                                value="{{ csrf_token() }}">
                                                                        </form>
                                                                    @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Tenants Item Wrap End -->
                    </div>
                    <!-- All tenants Area row End -->
                </div>
                <!-- Page Content Wrapper End -->
            </div>
        </div>
        <!-- End Page-content -->
    </div>
    {{-- <input type="hidden" id="getAllTenantRoute" value="{{ route('owner.tenant.index', ['type' => 'all']) }}"> --}}
    {{-- <input type="hidden" id="getPropertyUnitsRoute" value="{{ route('owner.property.getPropertyUnits') }}"> --}}

@endsection
@if (getOption('app_card_data_show', 1) != 1)
    @push('style')
        @include('common.layouts.datatable-style')
    @endpush
    @push('script')
        @include('common.layouts.datatable-script')
        <script src="{{ asset('assets/js/custom/tenant-datatable.js') }}"></script>
    @endpush
@endif
@push('script')
    <script src="{{ asset('assets/js/custom/tenant-list.js') }}"></script>
@endpush
