<?php

// use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\AssetController;
use App\Http\Controllers\Owner\FleetController;
use App\Http\Controllers\Owner\ReportController;
use App\Http\Controllers\Owner\TenantController;
use App\Http\Controllers\Owner\TicketController;
use App\Http\Controllers\Owner\ExpenseController;
use App\Http\Controllers\Owner\GatewayController;
use App\Http\Controllers\Owner\InvoiceController;
use App\Http\Controllers\Owner\SettingController;
use App\Http\Controllers\Owner\CurrencyController;
use App\Http\Controllers\Owner\DocumentController;
use App\Http\Controllers\Owner\LocationController;
use App\Http\Controllers\Owner\PropertyController;
use App\Http\Controllers\Tenancy\DomainController;
use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Owner\KycConfigController;
use App\Http\Controllers\Owner\ComplianceController;
use App\Http\Controllers\Owner\MaintainerController;
use App\Http\Controllers\Owner\TeamMemberController;
use App\Http\Controllers\Owner\ExpenseTypeController;
use App\Http\Controllers\Owner\InformationController;
use App\Http\Controllers\Owner\InvoiceTypeController;
use App\Http\Controllers\Owner\NoticeBoardController;
use App\Http\Controllers\Owner\TicketTopicController;
use App\Http\Controllers\Owner\ManufacturerController;
use App\Http\Controllers\Owner\RolePermissionController;
use App\Http\Controllers\Owner\VendorContractController;
use App\Http\Controllers\Owner\SpaceManagementController;
use App\Http\Controllers\Owner\EnergyManagementController;
use App\Http\Controllers\Owner\InvoiceRecurringController;
use App\Http\Controllers\Owner\MaintenanceIssueController;
use App\Http\Controllers\Owner\MaintenanceRequestController;
use App\Http\Controllers\Owner\NonCommercialPropertyController;
use App\Http\Controllers\Owner\SubUnitController;
use App\Http\Controllers\Owner\AssetStatusController;


Route::group(['prefix' => 'owner', 'as' => 'owner.', 'middleware' => ['auth', 'owner']], function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('top-search', [DashboardController::class, 'topSearch'])->name('top.search');
    Route::get('notification', [DashboardController::class, 'notification'])->name('notification');

    Route::group(['prefix' => 'property', 'as' => 'property.'], function () {
        Route::get('all-property', [PropertyController::class, 'allProperty'])->name('allProperty')->middleware('can:Manage Property');
        Route::get('non-commercial', [PropertyController::class, 'nonCommercialProperty'])->name('nonCommercial')->middleware('can:Manage Property');
        Route::get('add-non-commercial', [PropertyController::class, 'nonCommercialPropertyAdd'])->name('nonCommercialAdd')->middleware('can:Manage Property');

        Route::get('property/information', [PropertyController::class, 'propertyInformation'])->name('information');
        Route::post('property/store', [NonCommercialPropertyController::class, 'storeProperty'])->name('property.store');
        Route::get('property/location', [PropertyController::class, 'propertyLocation'])->name('location');

        Route::get('property/location', [PropertyController::class, 'propertyLocation'])->name('location');
        Route::get('property/unit/{propertyId}', [NonCommercialPropertyController::class, 'propertyUnit'])->name('unit');
        Route::post('property/unit/{propertyId}', [NonCommercialPropertyController::class, 'storeUnitDetails'])->name('non_unit.store')->middleware('can:Manage Property');
        // Route::post('property/sub-unit/{propertyId}', [NonCommercialPropertyController::class, 'storeSubUnitDetails'])->name('sub_unit.store')->middleware('can:Manage Property');
        Route::get('property/{id}/sub-units', [NonCommercialPropertyController::class, 'propertySubUnit'])->name('subUnits')->middleware('can:Manage Property');
        Route::post('property/{propertyId}/sub-units/store', [NonCommercialPropertyController::class, 'storeSubUnitDetails'])->name('sub_unit.store')->middleware('can:Manage Property');

        Route::get('/owner/property/nonCommercial/{id}', [NonCommercialPropertyController::class, 'showNonCommercialProperty'])
    ->name('owner.property.show');




                // Space Management
            Route::get('space-management', [SpaceManagementController::class, 'index'])->name('space.index');
            // Route::get('space-management/create', [SpaceManagementController::class, 'create'])->name('space.create');
            // Route::post('space-management/store', [SpaceManagementController::class, 'store'])->name('space.store');
            // Route::get('space-management/{id}', [SpaceManagementController::class, 'show'])->name('space.show');
            // Route::get('space-management/{id}/edit', [SpaceManagementController::class, 'edit'])->name('space.edit');
            // Route::put('space-management/{id}', [SpaceManagementController::class, 'update'])->name('space.update');
            // Route::delete('space-management/{id}', [SpaceManagementController::class, 'destroy'])->name('space.destroy');




            // Energy Management
        Route::get('energy-management', [EnergyManagementController::class, 'index'])->name('energy.index');
        Route::get('energy-management/create', [EnergyManagementController::class, 'create'])->name('energy.create');
        Route::post('energy-management/store', [EnergyManagementController::class, 'store'])->name('energy.store');
        Route::get('energy-management/{id}', [EnergyManagementController::class, 'show'])->name('energy.show');
        Route::get('energy-management/{id}/edit', [EnergyManagementController::class, 'edit'])->name('energy.edit');
        Route::put('energy-management/{id}', [EnergyManagementController::class, 'update'])->name('energy.update');
        Route::delete('energy-management/{id}', [EnergyManagementController::class, 'destroy'])->name('energy.destroy');


         // Vendor and Contractor Management
        Route::get('vendor', [VendorContractController::class, 'index'])->name('vendor.index');
        // Route::get('vendor/create', [VendorController::class, 'create'])->name('vendor.create');
        // Route::post('vendor/store', [VendorController::class, 'store'])->name('vendor.store');
        // Route::get('vendor/{id}', [VendorController::class, 'show'])->name('vendor.show');
        // Route::get('vendor/{id}/edit', [VendorController::class, 'edit'])->name('vendor.edit');
        // Route::put('vendor/{id}', [VendorController::class, 'update'])->name('vendor.update');
        // Route::delete('vendor/{id}', [VendorController::class, 'destroy'])->name('vendor.destroy');


        // Compliance and Risk Management
        Route::get('compliance', [ComplianceController::class, 'index'])->name('compliance.index');
        // Route::get('compliance/create', [ComplianceController::class, 'create'])->name('compliance.create');
        // Route::post('compliance/store', [ComplianceController::class, 'store'])->name('compliance.store');
        // Route::get('compliance/{id}', [ComplianceController::class, 'show'])->name('compliance.show');
        // Route::get('compliance/{id}/edit', [ComplianceController::class, 'edit'])->name('compliance.edit');
        // Route::put('compliance/{id}', [ComplianceController::class, 'update'])->name('compliance.update');
        // Route::delete('compliance/{id}', [ComplianceController::class, 'destroy'])->name('compliance.destroy');


        Route::get('fleet-management', [FleetController::class, 'index'])    ->name('fleetManagement');


        Route::get('all-unit', [PropertyController::class, 'allUnit'])->name('allUnit')->middleware('can:Manage Property');
        Route::get('own-property', [PropertyController::class, 'ownProperty'])->name('ownProperty')->middleware('can:Manage Property');
        Route::get('lease-property', [PropertyController::class, 'leaseProperty'])->name('leaseProperty')->middleware('can:Manage Property');
        Route::get('add', [PropertyController::class, 'add'])->name('add');
        Route::get('show/{id}', [PropertyController::class, 'show'])->name('show');
        Route::get('edit/{id}', [PropertyController::class, 'edit'])->name('edit');
        Route::delete('destroy/{id}', [PropertyController::class, 'destroy'])->name('destroy');
        Route::get('delete/{id}', [PropertyController::class, 'destroy'])->name('delete');
        Route::post('property-information/store', [PropertyController::class, 'propertyInformationStore'])->name('property-information.store');
        Route::post('location/store', [PropertyController::class, 'locationStore'])->name('location.store');
        Route::post('unit/store', [PropertyController::class, 'unitStore'])->name('unit.store');
        Route::delete('unit/delete/{id}', [PropertyController::class, 'unitDelete'])->name('unit.delete');
      

        

        Route::group(['prefix' => 'sub-unit', 'as' => 'sub-unit.'], function () {
            // Route::get('sub-unit-list', [SubUnitController::class, 'subUnitList'])->name('index')->middleware('can:Manage Property');
            Route::post('store', [SubUnitController::class, 'store'])->name('store');
            Route::get('getSubUnits', [SubUnitController::class, 'getSubUnits'])->name('getSubUnits');
        });
        
        Route::post('rent-charge/store', [PropertyController::class, 'rentChargeStore'])->name('rentCharge.store');
        Route::get('image/doc', [PropertyController::class, 'getImageDoc'])->name('image.doc');
        Route::post('image/store/{id?}', [PropertyController::class, 'imageStore'])->name('image.store');
        Route::get('image/delete/{id}', [PropertyController::class, 'imageDelete'])->name('image.delete');
        Route::post('thumbnail-image/update/{id}', [PropertyController::class, 'thumbnailImageUpdate'])->name('thumbnailImage.update');

        Route::get('get-property-information', [PropertyController::class, 'getPropertyInformation'])->name('getPropertyInformation');
        Route::get('get-location', [PropertyController::class, 'getLocation'])->name('getLocation');
        Route::get('get-unit', [PropertyController::class, 'getUnitByPropertyId'])->name('getUnitByPropertyId');
        Route::get('get-unit-by-property-ids', [PropertyController::class, 'getUnitByPropertyIds'])->name('getUnitByPropertyIds');
        Route::get('get-rent-charge', [PropertyController::class, 'getRentCharge'])->name('getRentCharge');
        Route::get('get-property-units', [PropertyController::class, 'getPropertyUnits'])->name('getPropertyUnits');
        Route::get('get-property-with-units-by-id', [PropertyController::class, 'getPropertyWithUnitsById'])->name('getPropertyWithUnitsById');
        Route::get('own-property-search', [PropertyController::class, 'ownPropertySearch'])->name('own-property-search');
    });

    Route::group(['prefix' => 'tenant', 'as' => 'tenant.'], function () {
        Route::get('/', [TenantController::class, 'index'])->name('index')->middleware('can:Manage Tenant');
        Route::get('create', [TenantController::class, 'create'])->name('create');
        Route::get('edit/{id}', [TenantController::class, 'edit'])->name('edit');
        Route::post('store', [TenantController::class, 'store'])->name('store');
        Route::get('document/delete/{id}', [TenantController::class, 'documentDestroy'])->name('document.destroy');
        Route::get('details/{id}', [TenantController::class, 'details'])->name('details');
        Route::post('close-history-store/{id}', [TenantController::class, 'closeHistoryStore'])->name('close.history.store');
        Route::post('delete', [TenantController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'information', 'as' => 'information.'], function () {
        Route::get('/', [InformationController::class, 'index'])->name('index')->middleware('can:Manage Information');
        Route::post('store', [InformationController::class, 'store'])->name('store');
        Route::get('get-info', [InformationController::class, 'getInfo'])->name('get.info'); // ajax
        Route::get('delete/{id}', [InformationController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'maintainer', 'as' => 'maintainer.'], function () {
        Route::get('/', [MaintainerController::class, 'index'])->name('index')->middleware('can:Manage Maintains');
        Route::post('store', [MaintainerController::class, 'store'])->name('store');
        Route::get('get-info', [MaintainerController::class, 'getInfo'])->name('get.info'); // ajax
        Route::get('delete/{id}', [MaintainerController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'maintenance-request', 'as' => 'maintenance-request.'], function () {
        Route::get('/', [MaintenanceRequestController::class, 'index'])->name('index')->middleware('can:Manage Maintains');
        Route::post('store', [MaintenanceRequestController::class, 'store'])->name('store');
        Route::get('get-info', [MaintenanceRequestController::class, 'getInfo'])->name('get.info'); // ajax
        Route::post('status-change', [MaintenanceRequestController::class, 'statusChange'])->name('status.change');
        Route::get('delete/{id}', [MaintenanceRequestController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'notice-board', 'as' => 'noticeboard.'], function () {
        Route::get('/', [NoticeBoardController::class, 'index'])->name('index')->middleware('can:Manage Noticeboard');
        Route::post('store', [NoticeBoardController::class, 'store'])->name('store');
        Route::get('get-info', [NoticeBoardController::class, 'getInfo'])->name('get.info'); // ajax
        Route::get('delete/{id}', [NoticeBoardController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'expense', 'as' => 'expense.'], function () {
        Route::get('/', [ExpenseController::class, 'index'])->name('index')->middleware('can:Manage Expenses');
        Route::get('details/{id}', [ExpenseController::class, 'details'])->name('details');
        Route::post('store', [ExpenseController::class, 'store'])->name('store');
        Route::post('update/{id}', [ExpenseController::class, 'update'])->name('update');
        Route::get('destroy/{id}', [ExpenseController::class, 'destroy'])->name('destroy');
        Route::post('new-expense-type', [ExpenseController::class, 'expenseTypeStore'])->name('expenseType.store');
    });

    Route::group(['prefix' => 'documents', 'as' => 'documents.'], function () {
        Route::get('/', [DocumentController::class, 'index'])->name('index')->middleware('can:Manage Documents');
        Route::get('status/{id}', [DocumentController::class, 'statusChange'])->name('status');
        Route::get('get-info', [DocumentController::class, 'getInfo'])->name('get.info'); // ajax
        Route::post('reject-reason', [DocumentController::class, 'rejectReasonStore'])->name('reject.reason.store');
        Route::get('delete/{id}', [DocumentController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'invoice', 'as' => 'invoice.'], function () {
        Route::get('/', [InvoiceController::class, 'index'])->name('index')->middleware('can:Manage Billing');
        Route::get('paid', [InvoiceController::class, 'paidInvoiceIndex'])->name('paid');
        Route::get('pending', [InvoiceController::class, 'pendingInvoiceIndex'])->name('pending');
        Route::get('bank-pending', [InvoiceController::class, 'bankPendingInvoice'])->name('bank.pending');
        Route::get('overdue', [InvoiceController::class, 'overDueInvoiceIndex'])->name('overdue');
        Route::get('details/{id}', [InvoiceController::class, 'details'])->name('details');
        Route::post('store', [InvoiceController::class, 'store'])->name('store');
        Route::put('update/{id}', [InvoiceController::class, 'update'])->name('update');
        Route::get('destroy/{id}', [InvoiceController::class, 'destroy'])->name('destroy');
        Route::get('types', [InvoiceController::class, 'types'])->name('types');
        Route::post('payment/status', [InvoiceController::class, 'paymentStatus'])->name('payment.status');
        Route::get('print/{id}', [InvoiceController::class, 'print'])->name('print');
        Route::post('pay/{id}', [InvoiceController::class, 'pay'])->name('pay');
        Route::post('sendNotification', [InvoiceController::class, 'sendNotification'])->name('send.notification');
        Route::get('get-currency-by-gateway', [InvoiceController::class, 'getCurrencyByGateway'])->name('get.currency');
        // recurring
        Route::group(['prefix' => 'recurring-setting', 'as' => 'recurring-setting.'], function () {
            Route::get('/', [InvoiceRecurringController::class, 'index'])->name('index')->middleware('can:Manage Billing');
            Route::post('store', [InvoiceRecurringController::class, 'store'])->name('store');
            Route::get('details/{id}', [InvoiceRecurringController::class, 'details'])->name('details');
            Route::get('destroy/{id}', [InvoiceRecurringController::class, 'destroy'])->name('destroy');
        });
    });

    Route::group(['prefix' => 'location', 'as' => 'location.'], function () {
        Route::get('country-list', [LocationController::class, 'countryList'])->name('country.list');
        Route::get('state-list', [LocationController::class, 'stateList'])->name('state.list');
        Route::get('city-list', [LocationController::class, 'cityList'])->name('city.list');
    });

    Route::get('cache-clear', [SettingController::class, 'cache_clear'])->name('cache.clear');

    Route::group(['prefix' => 'ticket', 'as' => 'ticket.'], function () {
        Route::get('/', [TicketController::class, 'index'])->name('index')->middleware('can:Manage Ticket');
        Route::get('details/{id}', [TicketController::class, 'details'])->name('details');
        Route::post('reply', [TicketController::class, 'reply'])->name('reply');
        Route::get('status-change', [TicketController::class, 'statusChange'])->name('status.change');
    });

    Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
        Route::get('earning', [ReportController::class, 'earning'])->name('earning')->middleware('can:Manage Report');
        Route::get('loss-profit', [ReportController::class, 'lossProfitByMonth'])->name('loss-profit.by.month')->middleware('can:Manage Report');
        Route::get('expenses', [ReportController::class, 'expenses'])->name('expenses')->middleware('can:Manage Report');
        Route::get('lease', [ReportController::class, 'lease'])->name('lease')->middleware('can:Manage Report');
        Route::get('occupancy', [ReportController::class, 'occupancy'])->name('occupancy')->middleware('can:Manage Report');
        Route::get('maintenance', [ReportController::class, 'maintenance'])->name('maintenance')->middleware('can:Manage Report');
        Route::get('tenant', [ReportController::class, 'tenant'])->name('tenant')->middleware('can:Manage Report');
    });

    Route::group(['prefix' => 'assets', 'as' => 'assets.'], function () {
        Route::get('all_assets', [AssetController::class, 'getList'])->name('getList')->middleware('can:Manage Asset');
         Route::post('save-asset', [AssetController::class, 'save_asset'])->name('save-asset')->middleware('can:Manage Asset');
        Route::post('save-bulk-asset', [AssetController::class, 'saveBulkAsset'])->name('save-bulk-asset')->middleware('can:Manage Asset');
        Route::get('replacement', [AssetController::class, 'replacement'])->name('replacement')->middleware('can:Manage Asset');
        Route::get('dispose', [AssetController::class, 'dispose'])->name('dispose')->middleware('can:Manage Asset');
        Route::post('disposeAsset', [AssetController::class, 'disposeAsset'])->name('disposeAsset')->middleware('can:Manage Asset');
        Route::post('save_depreciation_class', [AssetController::class, 'save_depreciation_class'])->name('save_depreciation_class')->middleware('can:Manage Asset');
        Route::post('save_manufacturer', [AssetController::class, 'save_manufacturer'])->name('save_manufacturer')->middleware('can:Manage Asset');
         Route::delete('manufacturer/delete/{id}', [ManufacturerController::class, 'destroy'])->name('manufacturer.delete');
        Route::get('category', [AssetController::class, 'dispose'])->name('category')->middleware('can:Manage Asset');
        Route::get('vendor', [AssetController::class, 'dispose'])->name('vendor')->middleware('can:Manage Asset');
        Route::get('manufacturer', [AssetController::class, 'manufacturer'])->name('manufacturer')->middleware('can:Manage Asset');
        Route::get('depreciation_class', [AssetController::class, 'depreciation_class'])->name('depreciation_class')->middleware('can:Manage Asset');
    

        


        Route::group(['prefix' => 'vendor', 'as' => 'replacement.'], function () {
            Route::get('replacement', [AssetController::class, 'replacement'])->name('replacement')->middleware('can:Manage Asset');
            // Route::delete('vendor/delete/{id}', [VendorController::class, 'destroy'])->name('delete');
        });
        
        Route::group(['prefix' => 'vendor', 'as' => 'replacement.'], function () {
            Route::get('replacement', [AssetController::class, 'replacement'])->name('replacement')->middleware('can:Manage Asset');
            Route::post('fetchLocation', [AssetController::class, 'fetchLocation'])->name('fetchLocation')->middleware('can:Manage Asset');
            Route::post('updateLocation', [AssetController::class, 'updateLocation'])->name('updateLocation')->middleware('can:Manage Asset');
        });

        Route::group(['prefix' => 'vendor', 'as' => 'vendor.'], function () {
            Route::get('vendor-list', [AssetController::class, 'vendorList'])->name('index')->middleware('can:Manage Asset');
            Route::post('store', [AssetController::class, 'storeVendor'])->name('store');
            Route::delete('vendor/delete/{id}', [VendorController::class, 'destroy'])->name('delete');
        });
          
          Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
            Route::get('category-list', [AssetController::class, 'categoryList'])->name('index')->middleware('can:Manage Asset');
            Route::post('store', [AssetController::class, 'storeCategory'])->name('store');
            Route::delete('category/delete/{id}', [AssetCategoryController::class, 'destroy'])->name('delete');
        });
        
        Route::group(['prefix' => 'status', 'as' => 'status.'], function () {
            Route::get('status-list', [AssetStatusController::class, 'index'])->name('index')->middleware('can:Manage Asset');
            Route::post('store', [AssetStatusController::class, 'store'])->name('store');
            Route::delete('status/delete/{id}', [AssetStatusController::class, 'destroy'])->name('delete');
        });
          
        Route::group(['prefix' => 'condition', 'as' => 'condition.'], function () {
            Route::get('condition-list', [ConditionController::class, 'index'])->name('index')->middleware('can:Manage Asset');
            Route::post('store', [ConditionController::class, 'store'])->name('store');
            Route::delete('status/delete/{id}', [ConditionController::class, 'destroy'])->name('delete');
        });
          
    });

    // Start:: Setting
    Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
        Route::get('general-setting', [SettingController::class, 'generalSetting'])->name('general-setting');
        Route::post('general-settings-update', [SettingController::class, 'generalSettingUpdate'])->name('general-setting.update');
        Route::get('color-setting', [SettingController::class, 'colorSetting'])->name('color-setting');
        Route::get('tax-setting', [SettingController::class, 'taxSetting'])->name('tax-setting')->middleware('can:Manage Settings');
        Route::post('tax-setting-update', [SettingController::class, 'taxSettingUpdate'])->name('tax-update');
        Route::get('smtp-setting', [SettingController::class, 'smtpSetting'])->name('smtp.setting');
        Route::post('general-settings-env-update', [SettingController::class, 'generalSettingEnvUpdate'])->name('general-setting-env.update');

        //Start:: Currency Settings
        Route::group(['prefix' => 'currency', 'as' => 'currency.'], function () {
            Route::get('', [CurrencyController::class, 'index'])->name('index');
            Route::post('store', [CurrencyController::class, 'store'])->name('store');
            Route::put('update/{id}', [CurrencyController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [CurrencyController::class, 'delete'])->name('destroy');
        });
        //End:: Currency Settings

        Route::group(['prefix' => 'gateway', 'as' => 'gateway.'], function () {
            Route::get('/', [GatewayController::class, 'index'])->name('index')->middleware('can:Manage Settings');
            Route::post('store', [GatewayController::class, 'store'])->name('store');
            Route::get('get-info', [GatewayController::class, 'getInfo'])->name('get.info');
            Route::get('delete/{gateway}', [GatewayController::class, 'delete'])->name('delete');
            Route::get('sync', [GatewayController::class, 'sync'])->name('sync');
        });

        Route::group(['prefix' => 'document-config', 'as' => 'document-config.'], function () {
            Route::get('/', [KycConfigController::class, 'index'])->name('index')->middleware('can:Manage Settings');
            Route::post('store', [KycConfigController::class, 'store'])->name('store');
            Route::get('get-info', [KycConfigController::class, 'getInfo'])->name('get.info'); // ajax
            Route::delete('delete/{id}', [KycConfigController::class, 'delete'])->name('delete');
        });

        Route::group(['prefix' => 'maintenance-issue', 'as' => 'maintenance-issue.'], function () {
            Route::get('/', [MaintenanceIssueController::class, 'index'])->name('index')->middleware('can:Manage Settings');
            Route::post('store', [MaintenanceIssueController::class, 'store'])->name('store');
            Route::get('get-info', [MaintenanceIssueController::class, 'getInfo'])->name('get.info'); // ajax
            Route::delete('delete/{id}', [MaintenanceIssueController::class, 'delete'])->name('delete');
        });

        Route::group(['prefix' => 'ticket-topic', 'as' => 'ticket-topic.'], function () {
            Route::get('/', [TicketTopicController::class, 'index'])->name('index')->middleware('can:Manage Settings');
            Route::post('store', [TicketTopicController::class, 'store'])->name('store');
            Route::delete('destroy/{id}', [TicketTopicController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'expense-type', 'as' => 'expense-type.'], function () {
            Route::get('/', [ExpenseTypeController::class, 'index'])->name('index')->middleware('can:Manage Settings');
            Route::post('store', [ExpenseTypeController::class, 'store'])->name('store');
            Route::delete('destroy/{id}', [ExpenseTypeController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'invoice-type', 'as' => 'invoice-type.'], function () {
            Route::get('/', [InvoiceTypeController::class, 'index'])->name('index')->middleware('can:Manage Settings');
            Route::post('store', [InvoiceTypeController::class, 'store'])->name('store');
            Route::delete('destroy/{id}', [InvoiceTypeController::class, 'destroy'])->name('destroy');
        });
    });
    // setting end

    // Tenancy setting
    Route::group(['prefix' => 'domain', 'as' => 'domain.'], function () {
        Route::get('/', [DomainController::class, 'index'])->name('index')->middleware('can:Manage Domain Config');
        Route::post('store', [DomainController::class, 'store'])->name('store');
        Route::get('info', [DomainController::class, 'info'])->name('info');
    });

    Route::group(['prefix' => 'role-permission', 'as' => 'role-permission.'], function () {
        Route::get('roles', [RolePermissionController::class, 'getRoleData'])->name('role-list')->middleware('can:Manage Team');
        Route::get('get-info', [RolePermissionController::class, 'getInfo'])->name('get-info');
        Route::post('store', [RolePermissionController::class, 'store'])->name('store');
        Route::get('delete/{id}', [RolePermissionController::class, 'delete'])->name('delete');
        Route::get('permission/{id}', [RolePermissionController::class, 'permission'])->name('permission');
        Route::post('permission-update', [RolePermissionController::class, 'permissionUpdate'])->name('permission-update');
    });

    Route::group(['prefix' => 'team-member', 'as' => 'team-member.'], function () {
        Route::get('/', [TeamMemberController::class, 'index'])->name('index')->middleware('can:Manage Team');
        Route::get('edit/{id}', [TeamMemberController::class, 'edit'])->name('edit');
        Route::post('store', [TeamMemberController::class, 'store'])->name('store');
        Route::get('delete/{id}', [TeamMemberController::class, 'delete'])->name('delete');
    });

     
});