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
                        <h4 class="mb-20">{{ __('All Pending Maintanance') }}</h4>
                        <div class="property-top-search-bar">
                            <div class="property-search-inner-bg bg-off-white theme-border radius-4 p-25 mb-25">
                                <div class="row align-items-center rg-25">
                                    <div class="col-md-6">
                                        <div class="property-top-search-bar-left">
                                                    <select class="form-select flex-shrink-0 " id="search_property">
                                                        <option value="" selected>{{ __('Select Property') }}</option>
                                                        @foreach ($properties as $property)
                                                            <option value="{{ $property->name }}">{{ $property->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="property-top-search-bar-right text-md-end">

                                            <button type="button" class="theme-btn" id="preventive"
                                                title="{{ __('Preventive Maintenance') }}" style="margin:2px">{{ __('Create Preventive Maintenance') }}</button>
                                      

                                            <button type="button" class="theme-btn" id="add"
                                                title="{{ __('Add Maintenance Request') }}"  style="margin:2px">{{ __('Create Maintenance Request') }}</button>
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
                    <h4 class="modal-title" id="addModalLabel">{{ __('Create Maintenance Request') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                            class="iconify" data-icon="akar-icons:cross"></span></button>
                </div>
                <form class="ajax" action="{{ route('owner.maintenance-request.store') }}" method="POST"
                    data-handler="getShowMessage">
                    <div class="modal-body">
                        <!-- Modal Inner Form Box Start -->
                        <div class="modal-inner-form-box">
                            <div class="row">
                                <div class="col-md-6 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Property') }}</label>
                                    <select class="form-select flex-shrink-0 property_id" name="property_id">
                                        <option value="" selected>--{{ __('Select Property') }}--</option>
                                        @foreach ($properties as $property)
                                            <option value="{{ $property->id }}">{{ $property->name }}</option>
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
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Created Date') }}</label>
                                    <div class="custom-datepicker">
                                        <div class="custom-datepicker-inner position-relative">
                                            <input type="text" class="datepicker form-control start_date"
                                                   name="created_date" autocomplete="off" placeholder="dd-mm-yy" required>
                                            <i class="ri-calendar-2-line"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="row">
                                <div class="col-md-6 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Issue (Type)') }}</label>
                                    <select class="form-select flex-shrink-0 issue_id" name="issue_id">
                                        <option value="">--{{ __('Select Issue') }}--</option>
                                        @foreach ($issues as $issue)
                                            <option value="{{ $issue->id }}">{{ $issue->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Status') }}</label>
                                    <select class="form-select flex-shrink-0 status" name="status">
                                        <option value="4" selected>{{ __('Open') }}</option>
                                        <option value="2">{{ __('In Progress') }}</option>
                                        <option value="3">{{ __('Pending') }}</option>
                                        {{-- <option value="1">{{ __('Completed') }}</option> --}}

                                    </select>
                                </div>
                            </div>
                          
                            
                            
                            <div class="row">
                                {{-- <div class="col-md-6 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Issue') }}</label>
                                    <select class="form-select flex-shrink-0 issue_id" name="issue_id">
                                        <option value="">--{{ __('Select Issue') }}--</option>
                                        @foreach ($issues as $issue)
                                            <option value="{{ $issue->id }}">{{ $issue->name }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="col-md-6 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Related Ticket') }}</label>
                                    <select class="form-select flex-shrink-0 status" name="ticket_id">
                                        <option selected value="">--Select Ticket--</option>
                                        @if(count($tickets))
                                       @foreach($tickets as $item)
                                        <option value="{{ $item->id }}">{{ __($item->title) }} - <small> {{ __($item->ticket_no) }}</small></option>
                                        @endforeach
                                        @endif
                                      
                                    </select>
                                </div>

                                <div class="col-md-6 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Maintainer') }}</label>
                                    <select class="form-select flex-shrink-0 status" name="maintainer">
                                        <option selected value="">--Select Ticket--</option>
                                        @if(count($maintainers))
                                       @foreach($maintainers as $item)
                                        <option value="{{ $item->id }}">{{ __($item->user->first_name) }} {{ __($item->user->last_name) }}</option>
                                        @endforeach
                                        @endif
                                      
                                    </select>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-12 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Details') }}</label>
                                    <textarea class="form-control details" name="details" placeholder="{{ __('Details') }}"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Attach') }}</label>
                                    <input type="file" class="form-control" name="attach">
                                </div>
                            </div>
                        </div>
                        <!-- Modal Inner Form Box End -->
                    </div>

                    <div class="modal-footer justify-content-start">
                        <button type="button" class="theme-btn-back me-3" data-bs-dismiss="modal"
                            title="{{ __('Back') }}">{{ __('Back') }}</button>
                        <button type="submit" class="theme-btn me-3"
                            title="{{ __('Add Request') }}">{{ __('Add Request') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="PreventiveModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form  action="{{ route('owner.maintenance-request.preventive_maintenance_store_info') }}" method="POST">
                    @csrf
                {{-- <div class="modal-header">
                    <h4 class="modal-title" id="addModalLabel">{{ __('Create Maintenance Request') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                            class="iconify" data-icon="akar-icons:cross"></span></button>
                </div> --}}
                <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl p-6 relative">
                    <h2 class="text-2xl font-bold mb-4 text-blue-600">Preventive Maintenance</h2>
                    
                    <div clas="row">
                    <label class="block mb-2">Title:</label>
                    <input required name="title" type="text" class="w-full p-2 border rounded mb-3" placeholder="Enter title">
                    </div>
                    
                    {{-- <label class="block mb-2">Description:</label> --}}
                    <div clas="row">

                    <label class="block mb-2">Property:</label>
                    <select required class="w-full p-2 border rounded mb-3 property_id"  name="property_id2">
                        <option value="" selected>--{{ __('Select Property') }}--</option>
                        @foreach ($properties as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>


                    <label class="block mb-2">Unit:</label>
                    <select class="w-full p-2 border rounded mb-3 unit_id"  name="unit_id2">
                        <option value="">--{{ __('No Unit Selected') }}--</option>

                    </select>
                    

                    <label class="block mb-2">Sub Unit:</label>
                    <select class="w-full p-2 border rounded mb-3 sub_unit_id" name="sub_unit_id2">
                        <option value="">--{{ __('No Select Sub Unit Selected') }}--</option>

                    </select>
                    
                </div>

              
                <div clas="row">

                    <label class="block mb-2">Issue:</label>
                    <select required class="w-full p-2 border rounded mb-3" name="issue_id">
                        {{-- <option>--Select Issue--</option> --}}
                        <option value="" selected>--{{ __('Select Issue') }}--</option>
                        @foreach ($issues as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <div clas="row">

                    
                    <label class="block mb-2">Assigned To:</label>
                    <select class="w-full p-2 border rounded mb-3">
                        <option>Cat1</option>
                        <option>Cat2</option> 
                    </select>
                </div> --}}

                <div clas="row">
                    <label class="block mb-2">Select Dates:</label>
                    <input required id="datePicker" name="multiple_date" type="text" class="w-full p-2 border rounded mb-3" placeholder="Select multiple dates">
                    
                </div>

                <div clas="row">

                    <label required class="block mb-2">Monthly Recurring:</label>
                    <select name="monthly_recurring" class="w-full p-2 border rounded mb-3">
                        <option selected>--Select--</option>
                        <option value="every_january" >Every January</option>
                        <option value="every_february">Every February</option> 
                        <option value="every_march">Every March</option> 
                        <option value="every_april">Every April</option> 
                        <option value="every_may">Every May</option> 
                        <option value="every_june">Every June</option> 
                        <option value="every_july">Every July</option> 
                        <option value="every_agost">Every Agost</option> 
                        <option value="every_september">Every September</option> 
                        <option value="every_october">Every October</option> 
                        <option value="every_november">Every November</option> 
                        <option value="every_december">Every December</option>   
                    </select>                    

                </div>

                
                <div clas="row">

                    <label class="block mb-2">General Recurring:</label>
                    <select name="general_recurring" class="w-full p-2 border rounded mb-3">
                        <option selected>--Select--</option>
                        <option>Every Week</option>
                        <option>Every Month</option> 
                        <option>Every Year</option> 
                        <option>Every Two Years</option> 

                    </select>                    

                </div>

                    <br>
                    <p>


                        <textarea name="decription" columns="50" style="width: -webkit-fill-available;" rows="4" class="w-full p-2 border rounded mb-3" placeholder="Enter description"></textarea>

                        </p>

                    
                    <div class="flex justify-end gap-3">
                        <button onclick="closeModal()" class="theme-btn" style="color:white; background:red">Cancel</button>
                        <button type="submit" class="theme-btn">Save</button>
                    </div>
                </div>

            </form>


                    
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editModalLabel">{{ __('Edit Maintenance Request') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                            class="iconify" data-icon="akar-icons:cross"></span></button>
                </div>
                <form class="ajax" action="{{ route('owner.maintenance-request.store') }}" method="POST"
                    data-handler="getShowMessage">
                    <input type="hidden" name="id" id="id">
                    <div class="modal-body">
                        <!-- Modal Inner Form Box Start -->
                        <div class="modal-inner-form-box">
                            <div class="row">
                                <div class="col-md-6 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Property') }}</label>
                                    <select class="form-select flex-shrink-0 property_id" name="property_id">
                                        <option value="" selected>--{{ __('Select Property') }}--</option>
                                        @foreach ($properties as $property)
                                            <option value="{{ $property->id }}">{{ $property->name }}</option>
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
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Issue') }}</label>
                                    <select class="form-select flex-shrink-0 issue_id" name="issue_id">
                                        <option value="">--{{ __('Select Issue') }}--</option>
                                        @foreach ($issues as $issue)
                                            <option value="{{ $issue->id }}">{{ $issue->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Status') }}</label>
                                    <select class="form-select flex-shrink-0 status" name="status">
                                        <option value="1">{{ __('Completed') }}</option>
                                        <option value="2">{{ __('In Progress') }}</option>
                                        <option value="3">{{ __('Pending') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Created Date') }}</label>
                                    <div class="custom-datepicker">
                                        <div class="custom-datepicker-inner position-relative">
                                            <input type="text" class="datepicker form-control created_date"
                                                   name="created_date" autocomplete="off" placeholder="dd-mm-yy" required>
                                            <i class="ri-calendar-2-line"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-25">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Details') }}</label>
                                    <textarea class="form-control details" name="details" placeholder="{{ __('Details') }}"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Attach') }}</label>
                                    <input type="file" class="form-control" name="attach">
                                </div>
                            </div>
                        </div> 
                        <!-- Modal Inner Form Box End -->
                    </div>

                    <div class="modal-footer justify-content-start">
                        <button type="button" class="theme-btn-back me-3" data-bs-dismiss="modal"
                            title="{{ __('Back') }}">{{ __('Back') }}</button>
                        <button type="submit" class="theme-btn me-3"
                            title="{{ __('Update') }}">{{ __('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="viewModalLabel">{{ __('Details') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
                            class="iconify" data-icon="akar-icons:cross"></span></button>
                </div>
                <form class="ajax" action="{{ route('owner.maintenance-request.status.change') }}" method="POST"
                    data-handler="getShowMessage">
                    <input type="hidden" name="id" id="viewId">
                    <div class="modal-body">
                        <div class="view-information-page-modal-content">
                            <div class="maintenance-request-view-top-box mb-25">
                                <div class="row align-items-start">
                                    <div class="col-md-8">
                                        <div class="view-information-page-box mb-25">
                                            <label
                                                class="label-text-title color-heading font-medium mb-2">{{ __('Issue') }}</label>
                                            <p class="issue_name"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4 text-start text-lg-end">
                                        <select class="form-select status" name="status" id="statusSelect">
                                            <option value="1">{{ __('Completed') }}</option>
                                            <option value="2">{{ __('In Progress') }}</option>
                                            <option value="3">{{ __('Pending') }}</option>
                                        </select>
                                    </div>
                                    <div class="resolved-date-field d-none-content">
                                        <div class="col-md-6 mb-25">
                                            <label class="label-text-title color-heading font-medium mb-2">{{__('Resolved Date')}}</label>
                                            <div class="custom-datepicker">
                                                <div class="custom-datepicker-inner position-relative">
                                                    <input type="text" class="datepicker form-control resolved_date" name="resolved_date"
                                                           autocomplete="off" placeholder="dd-mm-yy">
                                                    <i class="ri-calendar-2-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row align-items-start">
                                    <div class="col-md-6">
                                        <div class="view-information-page-box ">
                                            <label
                                                class="label-text-title color-heading font-medium mb-2">{{ __('Property') }}
                                                : </label>
                                            <span class="property_name"></span>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="view-information-page-box ">
                                            <label
                                                class="label-text-title color-heading font-medium mb-2">{{ __('Unit') }}
                                                : </label>
                                            <span class="unit_name"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="view-information-page-box mb-25">
                                <label class="label-text-title color-heading font-medium mb-2">{{ __('Ticket No') }}</label>
                                <p class="--"></p>
                            </div>


                            <div class="view-information-page-box mb-25">
                                <label class="label-text-title color-heading font-medium mb-2">{{ __('Details') }}</label>
                                <p class="view_details"></p>
                            </div>
                            <div class="view-information-page-box mb-25">
                                <label class="label-text-title color-heading font-medium mb-2">{{ __('Attach') }} :
                                </label>
                                <a href="" class="attach" target="_blank"></a>
                            </div>
                            <div class="view-information-page-box mb-25">
                                <label class="label-text-title color-heading font-medium mb-2">{{ __('Amount') }}</label>
                                <input type="number" class="form-control amount" name="amount" step="any"
                                    value="0" placeholder="{{ __('Amount') }}">
                            </div>
                            <div class="view-information-page-box mb-25">
                                <label class="label-text-title color-heading font-medium mb-2">{{ __('Invoice') }}</label>
                                <input type="file" class="form-control" name="invoice">
                                <small><a href="" target="_blank" class="invoice"></a></small>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer justify-content-start">
                        <button type="button" class="theme-btn-back me-3" data-bs-dismiss="modal"
                            title="{{ __('Back') }}">{{ __('Back') }}</button>
                        <button type="submit" class="theme-btn me-3"
                            title="{{ __('Update') }}">{{ __('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Information Modal End -->
    <input type="hidden" id="getPropertyUnitsRoute" value="{{ route('owner.property.getPropertyUnits') }}">
    <input type="hidden" id="getInfoRoute" value="{{ route('owner.maintenance-request.get.info') }}">
    <input type="hidden" id="route" value="{{ route('owner.maintenance-request.index') }}">
    <input type="hidden" id="getUnitsRoute" value="{{ route('owner.property.sub-unit.getSubUnits') }}">
    <input type="hidden" id="getPropertyUnitsRoute" value="{{ route('owner.property.getPropertyUnits') }}">
@endsection
@push('style')
    @include('common.layouts.datatable-style')
@endpush

@push('script')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
         document.addEventListener("DOMContentLoaded", function() {
        flatpickr("#datePicker", {
            mode: "multiple",
            dateFormat: "Y-m-d",
            theme: "dark"
        });
    });
    
    function closeModal() {
        document.getElementById("calendarModal").classList.add("hidden");
    }</script>

    @include('common.layouts.datatable-script')
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ asset('assets/js/custom/maintenance-request.js') }}"></script>

    
@endpush
