<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\PreventiveMaintenance;
use Illuminate\Http\Request;
use App\Http\Requests\MaintenanceRequest;
use App\Services\MaintenanceIssueService;
use App\Services\MaintenanceRequestService;
use App\Services\PropertyService;
use App\Traits\ResponseTrait;
 use App\Models\Ticket;
use App\Models\Maintainer;
class PreventiveMaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     use ResponseTrait;
     public $maintenanceRequestService;
     public $propertyService;
     public $maintenanceIssueService;
 
     public function __construct()
     {
         $this->maintenanceRequestService = new MaintenanceRequestService;
         $this->propertyService = new PropertyService;
         $this->maintenanceIssueService = new MaintenanceIssueService;
     }
 

    public function index()
    {
        //
        return "dfsdfsd";
    }

    public function preventiveMaintenanceRequest(Request $request){
        $data['pageTitle'] = __('Preventive Maintenance');
        $data['properties'] = $this->propertyService->getAll();
        $data['issues'] = $this->maintenanceIssueService->getActiveAll();
        $data['tickets'] = Ticket::orderBy('updated_at', 'desc')->get();
        $data['maintainers'] = Maintainer::orderBy('updated_at', 'desc')->get();
        $data['list'] = PreventiveMaintenance::orderBy('updated_at', 'desc')->simplePaginate();
        // if ($request->ajax()) {
        //     return $this->maintenanceRequestService->getAllData();
        // }
        return view('owner.maintains.preventive-maintenance-request', $data);
    }


    public function preventive_maintenance_store_info(Request $request){


        $newPPM = new PreventiveMaintenance;
        $newPPM->title = $request->title;
        $newPPM->property_id = $request->property_id2;
        $newPPM->unit_id = $request->tiunit_id2tle;
        $newPPM->sub_unit_id = $request->sub_unit_id2;
        $newPPM->issue_id = $request->issue_id;
        $newPPM->multiple_date = $request->multiple_date;
        $newPPM->monthly_recurring = $request->monthly_recurring;
        $newPPM->general_recurring = $request->general_recurring;
        $newPPM->decription = $request->decription;
        $newPPM->save();
        return redirect()->back();



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PreventiveMaintenance  $preventiveMaintenance
     * @return \Illuminate\Http\Response
     */
    public function show(PreventiveMaintenance $preventiveMaintenance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PreventiveMaintenance  $preventiveMaintenance
     * @return \Illuminate\Http\Response
     */
    public function edit(PreventiveMaintenance $preventiveMaintenance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PreventiveMaintenance  $preventiveMaintenance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PreventiveMaintenance $preventiveMaintenance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PreventiveMaintenance  $preventiveMaintenance
     * @return \Illuminate\Http\Response
     */
    public function destroy(PreventiveMaintenance $preventiveMaintenance)
    {
        //
    }
}
