@extends('owner.layouts.app')

@push('style')
<style>
.page-link {
    color: #ffffff;
    background: #28252b;
    margin: 9px;
}

    </style>
@endpush
@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Your script goes here
        $('.save_bulk').hide(); // Show loading spinner
    });
    document.addEventListener('DOMContentLoaded', function() {
        const bulkAssetFile = document.getElementById('bulk_asset_file');
        const mainBulkField = document.getElementById('main_bulk_field');
        const saveBulkButton = document.querySelector('.save_bulk');
        bulkAssetFile.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                if (file.type !== 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' &&
                    file.type !== 'application/vnd.ms-excel') {
                    alert('Please upload a valid Excel file.');
                    bulkAssetFile.value = '';
                    mainBulkField.style.display = 'none';
                    return;
                }
                $('.save_bulk').show();
                const reader = new FileReader();
                reader.onload = function(e) {
                    const data = new Uint8Array(e.target.result);
                    const workbook = XLSX.read(data, {
                        type: 'array'
                    });
                    const firstSheetName = workbook.SheetNames[0];
                    const worksheet = workbook.Sheets[firstSheetName];
                    const json = XLSX.utils.sheet_to_json(worksheet, {
                        header: 1
                    });
                    const headers = json[0];
                    const rows = json.slice(1);
                    const selectOptions = headers.map(header =>
                        `<option value="${header}">${header}</option>`).join('');
                    // Populate the selects with options dynamically
                    document.querySelectorAll('#main_bulk_field select').forEach(select => {
                        select.innerHTML =
                            `<option value="" selected>--Select Column--</option>${selectOptions}`;
                    });
                    mainBulkField.style.display = 'block';
                    // Now store the data for each column as an array
                    const columnsData = {};
                    headers.forEach((header, index) => {
                        columnsData[header] = rows.map(row => row[index]);
                    });
                    // Store the array of data in a hidden input field, or prepare it for submission
                    saveBulkButton.addEventListener('click', function() {
                        const formData = new FormData(document.getElementById(
                            'bulkAssetForm'));
                        const columns = {};
                        // For each column, add the corresponding row data to the FormData
                        for (const [column, data] of Object.entries(columnsData)) {
                            columns[column] = data; // Assign the column array
                        }
                        formData.append('columns', JSON.stringify(columns));
                        fetch(bulkAssetForm.action, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').getAttribute(
                                        'content')
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                // alert(data)
                                if (data.message == 'success') {
                                    alert('Bulk imported successfully!');
                                    location.reload();
                                } else {
                                    alert('Error saving bulk assets.');
                                }
                            })
                            .catch(error => {
                                alret(data);
                                alert(error)
                                // console.error('Error:', error);
                            });
                    });
                };
                reader.readAsArrayBuffer(file);
            }
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
@endpush
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
                      <div class="property-top-search-bar">
                        <div class="property-search-inner-bg bg-off-white theme-border radius-4 p-25 mb-25">
                            <div class="row align-items-center rg-25">
                                <div class="col-md-6">
                                    <div class="property-top-search-bar-left">
                                        {{-- <select class="form-select flex-shrink-0 " id="search_property">
                                            <option value="" selected>{{ __('--Select Category--') }}</option>
                                            @foreach ($categories as $item)
                                            <option value="{{ $item->name }}">{{ $item->name }}
                                            </option>
                                            @endforeach
                                        </select> --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="property-top-search-bar-right text-md-end">
                                        <button type="button" class="theme-btn" id="add" style=""
                                            title="{{ __('Add Asset') }}">{{ __('Add Asset') }}</button>
                                        <button type="button" class="default-btn theme-btn-purple w-auto" id="add2"
                                            title="{{ __('Add In Bulk') }}">{{ __('Add In Bulk') }}</button>
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
                            <table id="allAssetsDataTable1" class="table bg-off-white aaa theme-border dt-responsive" style="  margin-top: 10px;">
                                <thead>
                                    <tr>
                                        {{-- <th>{{ __('Image') }}</th> --}}
                                        {{-- <th>{{ __('Name') }}</th> --}}
                                        {{-- <th>{{ __('Name') }}</th> --}}
                                        <th>{{ __('Tag') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Property') }}</th>
                                        {{-- <th>{{ __('Property') }}</th> --}}
                                        {{-- <th>{{ __('Property') }}</th> --}}
                                        <th>{{ __('Unit') }}</th>
                                        <th>{{ __('SubUnit') }}</th>
                                        <th>{{ __('Condition') }}</th>
                                        {{-- <th>{{ __('Action') }}</th> --}}
                                    </tr>
                                </thead>

                                <tbody>

                                    @if(count($list))
                                    @foreach($list as $item)
                                    <tr>
                                        <td>{{ $item->tag }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>

                                            @if($item->Property!=null)
                                            
                                            {{ $item->Property->name }}


                                            @endif


                                        </td>
                                        <td>@if($item->propertyUnit!=null)
                                            
                                            {{ $item->propertyUnit->unit_name }}


                                            @endif</td>
                                        <td>
                                            @if($item->SubUnit!=null)
                                            
                                            {{ $item->SubUnit->name }}


                                            @endif

                                        </td>
                                        <td>
                                            
                                            @if($item->condition!=null)
                                            
                                            {{ $item->condition }}


                                            @endif


                                        </td>
                                        {{-- <td> --}}
                                            
{{-- 
                                            <button type="button" class="theme-btn" style= "display: inline-flex
                                            ;
                                                align-items: center;
                                                cursor: pointer;
                                                outline: none;
                                                z-index: 99;
                                                padding: 4px 5px !important;
                                                line-height: 20px;
                                                justify-content: center;
                                                border-radius: 4px;
                                                font-weight: 500 !important;
                                                color: var(--white-color);
                                                border: 1px solid transparent;background-color: var(--button-primary-color);
                                                border-radius: 4px;
                                                padding: 3px;
                                                color: white;
                                                font-weight: 700;" title="Replace">View More</button>
                                         --}}


                                        {{-- </td> --}}

                                        
                                    </tr>
                                    @endforeach
                                    {{ $list->links() }}

                                    @endif
                                  
                                  
                                </tbody>
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
            <div class="modal-header" style="margin-bottom:10px">
                <h4 class="modal-title" id="addModalLabel">{{ __('Add Asset') }}</h4>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span class="iconify"
                        data-icon="akar-icons:cross"></span></button>
            </div>

            @if(count($depreciation_class)==0)<p style="color:red"> Please register depreciation Class First </p>@endif
            @if(count($categories)==0)<p style="color:red"> Please register category First </p>@endif
            @if(count($manufacturer)==0)<p style="color:red"> Please register manufacturer First </p>@endif
            @if(count($conditions)==0)<p style="color:red"> Please asset conditions First </p>@endif

            <form action="{{ route('owner.assets.save-asset') }}" method="POST" data-handler="getShowMessage">

                @csrf
                <div class="modal-body">
                    <!-- Modal Inner Form Box Start -->
                    <div class="modal-inner-form-box">

                        <div class="row">
                            <div class="col-md-6 mb-25">
                                <label class="label-text-title color-heading font-medium mb-2">{{ __('Name') }}</label>
                                <input required type="text" class="form-control" name="name">

                            </div>
                            <div class="col-md-6 mb-25">
                                <label class="label-text-title color-heading font-medium mb-2">{{ __('Tag') }}</label>
                                <input required type="text" class="form-control" name="tag">

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
                                <label
                                    class="label-text-title color-heading font-medium mb-2">{{ __('Condition') }}</label>
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
                                <label class="label-text-title color-heading font-medium mb-2">{{ __('Unit') }}</label>
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
                                <select class="form-select flex-shrink-0 vendor_id" name="vendor_id">
                                    <option value="" selected>--{{ __('Select Vendor') }}--</option>
                                    @if(count($vendor)>0)
                                    @foreach ($vendor as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-25">
                                <label
                                    class="label-text-title color-heading font-medium mb-2">{{ __('Purchase Cost (TZS)') }}</label>
                                <input type="Number" class="form-control" name="purchase_cost">

                            </div>

                            <div class="col-md-6 mb-25">
                                <label
                                    class="label-text-title color-heading font-medium mb-2">{{ __('Depreciation Class') }}</label>
                                <select required class="form-select flex-shrink-0 depreciation_class_id"
                                    name="depreciation_class_id">
                                    <option value="">--{{ __('Select Depreciation Class') }}--</option>
                                    @if(count($depreciation_class)>0)
                                    @foreach ($depreciation_class as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                    @endif

                                </select>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-25">
                                <label
                                    class="label-text-title color-heading font-medium mb-2">{{ __('Status') }}</label>
                                <select required class="form-select flex-shrink-0 status" name="status">
                                    <option value="">--{{ __('Select Status Class') }}--</option>

                                    <option value="active">Active</option>
                                    <option value="disposed">Disposed</option>
                                    =

                                </select>

                            </div>

                            <div class="col-md-6 mb-25">
                                {{-- <label   class="label-text-title color-heading font-medium mb-2">{{ __('Depreciation Class') }}</label>
                                --}}

                                <div class="col-md-12">
                                    <label
                                        class="label-text-title color-heading font-medium mb-2">{{ __('Image') }}</label>
                                    <input type="file" class="form-control" name="image">
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-25">
                                <label
                                    class="label-text-title color-heading font-medium mb-2">{{ __('Missing Description') }}</label>
                                <textarea class="form-control details" name="missing_description"
                                    placeholder="{{ __('Description') }}"></textarea>
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

<div class="modal fade" id="addModal2" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addModalLabel">{{ __('Bulk Assets') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span class="iconify"
                        data-icon="akar-icons:cross"></span></button>
            </div>
            <form id="bulkAssetForm" enctype="multipart/form-data" action="{{ route('owner.assets.save-bulk-asset') }}"
                method="POST" data-handler="getShowMessage">

                @csrf
                <div class="modal-body">
                    <!-- Modal Inner Form Box Start -->
                    <div class="modal-inner-form-box">

                        <div class="row">
                            <div class="col-md-12 mb-25">
                                <label
                                    class="label-text-title color-heading font-medium mb-2">{{ __('                                                                                                                                     ') }}</label>
                                <input type="file" id="bulk_asset_file" name="bulk_asset_file"
                                    class="form-control details"></textarea>
                            </div>

                        </div>

                        <div class="row" id="main_bulk_field" style="display: none">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table theme-border p-20" style="">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Imported Column') }}</th>
                                                <th>{{ __('System Column') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> <select class="form-select flex-shrink-0 " name="column1"
                                                        id="column1">
                                                        <option value="" selected>{{ __('--Select Name Field--') }}
                                                        </option>
                                                    </select>
                                                </td>
                                                <td>Name</td>
                                            </tr>

                                            <tr>
                                                <td> <select class="form-select flex-shrink-0 " name="column2"
                                                        id="column2">
                                                        <option value="" selected>{{ __('--Select Tag Field--') }}
                                                        </option>
                                                    </select>
                                                </td>
                                                <td>Tag</td>
                                            </tr>

                                            <tr>
                                                <td> <select class="form-select flex-shrink-0 " name="column3"
                                                        id="column3">
                                                        <option value="" selected>{{ __('--Select Category Field--') }}
                                                        </option>
                                                    </select>
                                                </td>
                                                <td>Category</td>
                                            </tr>

                                            <tr>
                                                <td> <select class="form-select flex-shrink-0 " name="column4"
                                                        id="column4">
                                                        <option value="" selected>
                                                            {{ __('--Select Manufacturer Field--') }}</option>
                                                    </select>
                                                </td>
                                                <td>Manufacturer</td>
                                            </tr>

                                            <tr>
                                                <td> <select class="form-select flex-shrink-0 " name="column5"
                                                        id="column5">
                                                        <option value="" selected>
                                                            {{ __('--Select Purchase Date Field--') }}</option>
                                                    </select>
                                                </td>
                                                <td>Purchase Date</td>
                                            </tr>

                                            <tr>
                                                <td> <select class="form-select flex-shrink-0 " name="column6"
                                                        id="column6">
                                                        <option value="" selected>{{ __('--Select Condition Field--') }}
                                                        </option>
                                                    </select>
                                                </td>
                                                <td>Condition</td>
                                            </tr>

                                            <tr>
                                                <td> <select class="form-select flex-shrink-0 " name="column7"
                                                        id="column7">
                                                        <option value="" selected>{{ __('--Select Property Field--') }}
                                                        </option>
                                                    </select>
                                                </td>
                                                <td>Property</td>
                                            </tr>

                                            <tr>
                                                <td> <select class="form-select flex-shrink-0 " name="column8"
                                                        id="column8">
                                                        <option value="" selected>{{ __('--Select Unit Field--') }}
                                                        </option>
                                                    </select>
                                                </td>
                                                <td>Unit</td>
                                            </tr>

                                            <tr>
                                                <td> <select class="form-select flex-shrink-0 " name="column9"
                                                        id="column9">
                                                        <option value="" selected>{{ __('--Select Sub Unit Field--') }}
                                                        </option>
                                                    </select>
                                                </td>
                                                <td>Sub Unit</td>
                                            </tr>

                                            <tr>
                                                <td> <select class="form-select flex-shrink-0 " name="column10"
                                                        id="column10">
                                                        <option value="" selected>{{ __('--Select Vendor Field--') }}
                                                        </option>
                                                    </select>
                                                </td>
                                                <td>Vendor</td>
                                            </tr>

                                            <tr>
                                                <td> <select class="form-select flex-shrink-0 " name="column12"
                                                        id="column12">
                                                        <option value="" selected>
                                                            {{ __('--Select Depreciation Class Field--') }}</option>
                                                    </select>
                                                </td>
                                                <td>Depreciation Class</td>
                                            </tr>

                                            <tr>
                                                <td> <select class="form-select flex-shrink-0 " name="column13"
                                                        id="column13">
                                                        <option value="" selected>{{ __('--Select Status Field--') }}
                                                        </option>
                                                    </select>
                                                </td>
                                                <td>Status</td>
                                            </tr>

                                            <tr>
                                                <td> <select class="form-select flex-shrink-0 " name="column14"
                                                        id="column14">
                                                        <option value="" selected>
                                                            {{ __('--Select Missing Descpt Field--') }}</option>
                                                    </select>
                                                </td>
                                                <td>Missing Desription</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Modal Inner Form Box End -->
                </div>

                <div class="modal-footer justify-content-start">
                    <button type="button" class="theme-btn-back me-3" data-bs-dismiss="modal"
                        title="{{ __('Back') }}">{{ __('Back') }}</button>
                    <button type="button" class="theme-btn me-3 save_bulk"
                        title="{{ __('Save Bulk') }}">{{ __('Save Bulk') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<input type="hidden" id="getPropertyUnitsRoute" value="{{ route('owner.property.getPropertyUnits') }}">
<input type="hidden" id="getUnitsRoute" value="{{ route('owner.property.sub-unit.getSubUnits') }}">
<input type="hidden" id="Assetroute" value="{{ route('owner.assets.getList') }}">
<input type="hidden" id="bulkLink" value="{{ route('owner.assets.save-bulk-asset') }}">
{{-- getReplacementRoute --}}
{{-- <input type="hidden" id="getSubUnitsRoute" value="{{ route('owner.property.getSubUnits') }}"> --}}

@endsection
@push('style')
@include('common.layouts.datatable-style')
@endpush

@push('script')
@include('common.layouts.datatable-script')
<script src="{{ asset('assets/js/custom/asset.js') }}"></script>
@endpush