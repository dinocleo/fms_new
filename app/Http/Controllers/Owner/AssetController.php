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

use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{
    use ResponseTrait;
    public $assetsService;
    public $depreciationClassService;

    public function __construct()
    {
        $this->assetsService = new Asset;
        $this->depreciationClassService = new DepreciationClass;
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

    public function all_assets()
    {
        $data['pageTitle'] = __('Asset List');
        $data['depreciation_class'] = DepreciationClass::all(); 
        $data['vendor'] = Vendor::all(); 
        $data['property'] = Property::all();
        $data['status'] = AssetStatus::all();
        // $data['status'] = Sattus::all();
        $data['conditions'] = Condition::all();
        $data['manufacturer'] = Manufacturer::all();
        $data['categories'] = AssetCategory::all();
        $data['properties'] = Property::all();
        $data['assets'] = Asset::all();
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
    public function dispose()
    {
        //
        $data['pageTitle'] = __('Disposable Asset List');
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
