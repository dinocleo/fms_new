<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Models\DepreciationClass;
use App\Models\Manufacturer;
use App\Models\Vendor;
use App\Models\AssetCategory;
use App\Models\Property;
use App\Models\AssetStatus;
use App\Models\Condition;
use App\Services\Assets\AssetService;
use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{

    use ResponseTrait;
    public $assetsService;
    public $depreciationClassService;

    public function __construct()
    {   
        $this->assetsService = new AssetService;
        $this->depreciationClassService = new DepreciationClass;
    }


    public function saveBulkAsset(Request $request){
        // return "sdfs";
        return $this->assetsService->saveBulkAsset($request);

    }
    public function updateLocation(Request $request){

        // return $request->asset_id;

        $asset = Asset::where('id', $request->asset_id)->first();

        if( $asset!=null){
        // $item = Asset::where('id',$id)->first();
        $asset->property_id = $request->property_id;
        $asset->unit_id = $request->unit_id;
        $asset->sub_unit_id = $request->sub_unit_id;
        $asset->save();
        }

        if($asset){
            return response(array("message"=>"success"));
        }else{
            return response(array("message"=>"fail"));

        }

    }

    public function fetchLocation(Request $request){
        $tag = $request->tag;
        return $this->assetsService->fetchAssetLocationByTag($tag);
    }

    public function disposeAsset(Request $request){
        $asset = Asset::where('tag', $request->tag)->first();

            if( $asset!=null){
            // $item = Asset::where('id',$id)->first();
            $asset->status_id = 10;
            $asset->save();
            }
                    
                


            return redirect()->back();   

       }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function manufacturer(){
        $data['pageTitle'] = __('Manufacturer');
        $data['manufacturer'] = Manufacturer::all(); // 
        return view('owner.asset.manufacturer.index', $data);
     }

 
     
    public function  replacement(){
        $data['pageTitle'] = __('Replacement'); 
        $data['properties'] = Property::all();
        $data['assets'] = Asset::all(); 
        return view('owner.asset.replacement', $data);
    }



    public function getList(Request $request)
    {
        $data['pageTitle'] = __('Asset List');
        $data['depreciation_class'] = DepreciationClass::where('status','active')->get(); 
        // $data['vendor'] = Vendor::all(); 
        $data['property'] = Property::all();
        $data['status'] = AssetStatus::all();
        $data['vendor'] = Vendor::all();
        $data['conditions'] = Condition::all();
        $data['manufacturer'] = Manufacturer::all();
        $data['categories'] = AssetCategory::all();
        $data['properties'] = Property::all();
        $data['list'] = Asset::all();
        if ($request->ajax()) {
            return $this->assetsService->getAllData();
        }
        return view('owner.asset.all-assets', $data);

    }

    public function storeCategory(Request $request){
        $request->validate([
            'name' => 'required|unique:depreciation_classes,name',
        ]);

        $category = new AssetCategory();
        $category->name = $request->name;
        $category->added_by = Auth::user()->id;
        $category->save();
        return redirect()->back();

    }


    public function storeVendor(Request $request){
        
        $request->validate([
            'name' => 'required|unique:vendors,name',
        ]);

        $vendor = new Vendor();
        $vendor->name = $request->name;
        $vendor->added_by = Auth::user()->id;
        $vendor->save();
        return redirect()->back();
    }

    public function save_asset(Request $request){
        // $request->validate([
        //     'name' => 'required|unique:vendors,name',
        // ]);
        $asset = new Asset();
        $asset->name = $request->name;
        $asset->tag = $request->tag;
        $asset->status_id = $request->status_id;
        $asset->category_id = $request->category_id;
        $asset->manufacturer_id = $request->manufacturer_id;
        $asset->condition_id = $request->condition_id;
        $asset->property_id = $request->property_id;
        $asset->unit_id = $request->unit_id;
        $asset->sub_unit_id = $request->sub_unit_id;
        $asset->vendor_id = $request->vendor_id;
        $asset->purchase_cost = $request->purchase_cost;
        $asset->added_by = Auth::user()->id;
        $asset->save();

        return redirect()->back();
    }

    public function dispose()
    {
        //
        $data['pageTitle'] = __('Dispose Asset');
        $data['assets'] = Asset::all(); // Fetch all assets directly
        return view('owner.asset.dispose', $data);
  
    }

    // public function categoryList(){
    //     $data['pageTitle'] = __('Vendor');
    //     $data['list'] = Vendor::all(); // Fetch all assets directly
    //     return view('owner.asset.vendor.index', $data);
     
    // }
  
    public  function vendorList(){
        $data['pageTitle'] = __('Vendor');
        $data['list'] = Vendor::all(); // Fetch all assets directly
        return view('owner.asset.vendor.index', $data);
    }

    public function categoryList(){
        $data['pageTitle'] = __('Category');
        $data['list'] = AssetCategory::all(); // Fetch all assets directly
        return view('owner.asset.category.index', $data);
  
    }

    public function depreciation_class(){
        $data['pageTitle'] = __('Depreciation Class');
        $data['depreciation_class'] = DepreciationClass::all(); 
        return view('owner.asset.depreciation-class.index', $data);
    }

    public function save_depreciation_class(Request $request){
      
        $request->validate([
            'name' => 'required|unique:depreciation_classes,name',
            'formula' => 'required|string',
        ]);

        $depreciation_class = new DepreciationClass();
        $depreciation_class->name = $request->name;
        $depreciation_class->added_by = Auth::user()->id;
        $depreciation_class->formula = $request->formula;
        $depreciation_class->save();
        return redirect()->back();
        
    }


    public function save_manufacturer(Request $request){
      
        $request->validate([
            'name' => 'required|unique:depreciation_classes,name',
        ]);

        $manufacturer = new Manufacturer();
        $manufacturer->name = $request->name;
        $manufacturer->added_by = Auth::user()->id;
        $manufacturer->save();
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
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function show(Asset $asset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function edit(Asset $asset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asset $asset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asset $asset)
    {
        //
    }
}
