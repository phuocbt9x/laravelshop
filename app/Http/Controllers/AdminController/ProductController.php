<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\AdminModel\CategoryModel;
use App\Models\AdminModel\ManufactureModel;
use App\Models\AdminModel\OptionModel;
use App\Models\AdminModel\OptionValueModel;
use App\Models\AdminModel\ProductModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
       // $arr_colour =explode(",",$request->colour);
        //$arr_colour =explode("[",$arr_colour[1]);
        //dd($request->colour);
        if($request->ajax()){ 
            $products = ProductModel::get();
            return DataTables::of($products)
            ->editColumn('thumbnail', function($product){
                $url= asset($product->thumbnail);
                return '<img src="' . $url . '" border="0" width="40" class="img" align="center" justify="center"/>';
                //return '<img src="'. $url .'" style=" border: 0; width: 40px;height:100%;display:flex; align-items: center;justify-content: center" class="img" />';
            })
            ->editColumn('name', function($product){
                return $product->name;
            })
            ->editColumn('slug', function($product){
                return $product->slug;
            })
            ->editColumn('price', function($product){
                return '<span class="text-danger">' .  $product->Price() . '</span>';
            })
            ->editColumn('quantity', function($product){
                return $product->quantity;
            })
            ->editColumn('manufacturer', function($product){
                return '<span class="text-primary">' . $product->manufacturer_name() . '</span>' ;
            })
            ->editColumn('category', function($product){
                return '<span class="text-primary">' . $product->category_name() . '</span>';
            })
            ->editColumn('actions', function ($product) {
                $routeEdit = route('product.edit', $product->slug);
                $routeDestroy = "'" . route('product.destroy', $product->slug) . "'";
                $buttonEdit = '<a href = "' . $routeEdit . '" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>';
                $buttonDestroy = '<a href = "javascript:void(0)" class="ml-2 btn btn-sm btn-danger" onclick="deleteItem(' . $routeDestroy . ')"><i class="fas fa-trash"></i></a>';
                return $buttonEdit . $buttonDestroy;
            })
            ->rawColumns([ 'thumbnail', 'name', 'slug', 'price', 'quantity', 'manufacturer',  'category', 'actions'])
            ->make(true);
        }
        
        return view('admin.product.index');
    }
    public function demo1()
    {
        return view('admin.product.demo1');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $arr = [];
        $options = OptionModel::get();
        
        $size = OptionValueModel::where('option_id', $options->first()->id)->with('option')->get();
        $colour = OptionValueModel::where('option_id', $options->last()->id)->with('option')->get();
        //dd($colour);
        $manufactures = ManufactureModel::get();
        $categorys = CategoryModel::whereNotNull('parent_id')->get();
        foreach($options as $option){
            $optionValues = OptionValueModel::where('option_id', $option->id)->orderBy('id' ,'ASC')->get();
                $arrOptions[] = [
                    'id' => $option->id,
                    'name' => $option->name
                ];
            foreach($optionValues as $optionValue){
                
                    $arr[$option->name  ]=[
                            $option->id => $option->name,
                            'option' => $option->name,
                            'value' => $optionValue->value
                        ];
                
                //dd($optionValue->id);
                //dd($optionValues);
                    
                
                
            }
            
        }
        //$option_exp = explode('',);
        //dd($options->first()->id);
        return view('admin.product.create',compact([
            'arrOptions',
            'arr',
            'options',
            'manufactures',
            'categorys',
            'size',
            'colour'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function api(Request $request)
    {
        //dd(json_decode($request->colour));
        //dd($request);
        // //dd($request);
        $arr = json_decode($request->colour);
        $Array = [];
        $html = [];
        foreach($arr as $colour){
            //dd($colour);
            $infors = OptionValueModel::where('id' , $colour)->get();
            
            foreach($infors as $infor){
                $Array[] = [
                'id' => $infor->id,
                'name' => $infor->value
                ];
                
            }
            
        }
        foreach($Array as $arr){
            //dd($arr);
            // <div class="form-group row">
            //                 <label for="quantity" class="col-sm-2 col-form-label">'. $arr['name'] .'</label>
            //                 <div class="col-sm-10">
            //                     <input type="number" class="form-control" id="colour"  name="colour"
            //                         placeholder="colour" fdprocessedid="c5qs9" value="'. $arr['name'] .'">
            //                 </div>
            //             </div>
            $html[] .='<div class="card card-default collapsed-card">
            <div class="card-header">
                <h3 class="card-title"><label>'. $arr['name'] .'</label></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                        fdprocessedid="lq7q1n">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"
                        fdprocessedid="rqoqek">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="card-body" style="display: none;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input files" id="customFile"
                                    name="files[]">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <div class="d-flex justify-content-center mw-100" id="preview_logo">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b1/Loading_icon.gif?20151024034921"
                                    alt="" style="width: 200px;" class="" id="thumbnail_Sku">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price_sku">Price</label>
                            <input type="number" class="form-control" id="price_sku" placeholder="Enter price" fdprocessedid="31p86p" name="priceSku[]">
                        </div>
                        <div class="form-group">
                            <label for="quantity_sku">Quantity</label>
                            <input type="number" class="form-control" id="quantity_sku" placeholder="Enter Quantity" fdprocessedid="31p86p" name="quantitySku[]">
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        }
        $q = json_encode($html);
        //dd($q);
        //return response()->json($q); 
        return response()->json($q); 
        
    }
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdminModel\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function show(ProductModel $productModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminModel\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductModel $productModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminModel\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductModel $productModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminModel\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductModel $productModel)
    {
        //
    }
}
