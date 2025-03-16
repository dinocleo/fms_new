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
use Illuminate\Support\Facades\DB;
use App\Models\propertyUnit;

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


         // $tag
         DB::beginTransaction();
         try {
 
             
 
             // Get the uploaded file
             // $file = $request->file('bulk_asset_file');
             // $columns = json_decode($request , true);
 $name = $request->input('column1');
 $tag = $request->input('column2');
 $category = $request->input('column3');
 $manufacturer = $request->input('column4');
 $purchase_date = $request->input('column5');
 $Condition = $request->input('column6');
 $Property = $request->input('column7');
 $Unit = $request->input('column8');
 $sub_unit = $request->input('column9');
 $Vendor = $request->input('column10');
 $depreciation_class = $request->input('column12');
 $Status = $request->input('column13');
 $missing_description = $request->input('column14');
  
 $data = json_decode($request->input('columns'),true);
 
 // Loop through the "Name" array and print its corresponding values
 // return $data;
 for ($i = 0; $i < count($data['Name']); $i++) {
 
     if(isset($tag) && $tag!=null && $name!=null){
 
         $asset_tag_check = Asset::where('tag', $data[$tag][$i])->first();
             if($asset_tag_check==null){
                 $asset = new Asset();
 
                 if(isset($name) && $name!=null){
                     $asset->name = $data[$name][$i];
                 }
                 if(isset($tag) && $tag!=null){
                     $asset->tag = $data[$tag][$i];
                 }
                 $asset->status = "active";
                 $asset->category_id = 1;
                 $asset->manufacturer_id = 1;
 
                      $asset->save();
                    //  dd($asset);

                }

            }

        }
                DB::commit();
                // $message = getErrorMessage($e, $e->getMessage());
                $response = ['response' => true, 'error' => false, 'message' => 'success'];
                return response()->json($response, 200);

            } catch (\Exception $e) {
                DB::rollBack();
                // $message = getErrorMessage($e, $e->getMessage());
                $response = ['response' => true, 'error' => true, 'message' => 'fail'];
                return response()->json($response, 200);
    
    
            }


                     return redirect()->back();
        // return $this->assetsService->saveBulkAsset($request);

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
            $asset->status = 10;
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
                        
                            
                        $assets = Asset::orderBy('updated_at', 'desc')->where('status', "active")->get();
                        return datatables($assets)
                        ->addIndexColumn()
                        ->addColumn('image', function ($item) {
                            return '<div class="tenants-tbl-info-object d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="http://127.0.0.1:8000/assets/images/no-image.jpg"
                                        class="rounded-circle avatar-md tbl-user-image"
                                        alt="">
                                    </div>
                                </div>';
                        })
                        
                        
                        ->addColumn('tag', function ($item) {
                            return $item->tag;
                        })
                        ->addColumn('name', function ($item) {
                            return $item->name;
                        })
                        ->addColumn('category', function ($item) {
                            if($item->AssetCategory!=null){
                                return $item->AssetCategory->name;
                            }else{
                                return "";
                            }
                        })
                        ->addColumn('manufacturer', function ($item) {
                            if($item->Manufacturer!=null){
                                return $item->Manufacturer->name;
                            }else{
                                return "";
                            }
                        })
                        ->addColumn('property', function ($item) {
                            if($item->Property!=null){
                                return $item->Property->name;
                            }else{
                                return "";
                            }
                        })
                        ->addColumn('unit', function ($item) {
                            if($item->propertyUnit!=null){
                                return $item->propertyUnit->name;
                            }else{
                                return "";
                            }
                        })
                        ->addColumn('sub_unit', function ($item) {
                            if($item->SubUnit!=null){
                                return $item->SubUnit->name;
                            }else{
                                return "";
                            }
                        })
                            ->addColumn('action', function ($item) {
                            

                // return '<button type="button class="theme-btn" style= "display: inline-flex
                // ;
                //     align-items: center;
                //     cursor: pointer;
                //     outline: none;
                //     z-index: 99;
                //     padding: 4px 5px !important;
                //     line-height: 20px;
                //     justify-content: center;
                //     border-radius: 4px;
                //     font-weight: 500 !important;
                //     color: var(--white-color);
                //     border: 1px solid transparent;background-color: var(--button-primary-color);
                //     border-radius: 4px;
                //     padding: 3px;
                //     color: white;
                //     font-weight: 700;" title="Replace">View More</button>';

                        })
                        ->rawColumns(['image', 'tag','name', 'category', 'manufacturer','property','unit','sub_unit','status', 'action'])
                        ->make(true);


        }
        // return $data;

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
        $asset->status = $request->status;
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
