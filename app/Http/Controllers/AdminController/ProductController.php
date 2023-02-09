<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\ProductRequest\StoreRequest;
use App\Models\AdminModel\CategoryModel;
use App\Models\AdminModel\ManufactureModel;
use App\Models\AdminModel\OptionModel;
use App\Models\AdminModel\OptionProductModel;
use App\Models\AdminModel\OptionValueModel;
use App\Models\AdminModel\ProductModel;
use App\Models\AdminModel\ProductSkuModel;
use App\Models\AdminModel\VariantModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){ 
            $products = ProductModel::get();
            return DataTables::of($products)
            ->editColumn('thumbnail', function($product){
                $url= asset($product->thumbnail);
                return '<img src="' . $url . '" border="0" width="40" class="img" align="center" justify="center"/>';
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
        ///
        //
        $test = OptionValueModel::join('options','option_values.option_id' , '=','options.id' )->get(['option_values.*','options.name'])->groupBy(['name']);
        //dd($test);
        foreach($test as $t){
            //dd($t);
            foreach($t as $a){
                //$t->add();
            }
        }
        $size = OptionValueModel::where('option_id', $options->first()->id)->with('option')->get();
        $colour = OptionValueModel::where('option_id', $options->last()->id)->with('option')->get();
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
            }
        }
        return view('admin.product.create',compact([
            'arrOptions',
            'arr',
            'options',
            'manufactures',
            'categorys',
            'size',
            'colour',
            'test'
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
        
        $arr = json_decode($request->option);
        $Array = [[]];
        $html = [];
        $result = array(array());
        foreach ($arr as $key => $values) {
            $append = array();
            foreach($result as $product) {
                foreach($values as $item) {
                    $infors = OptionValueModel::where('id' , $item)->get();
                    foreach($infors as $infor){
                        $product[$infor->option_id] = [
                            'id' => $infor->id,
                            'name' =>  $infor->value
                        ];
                        //$product[] = $product;
                        $append[] = $product;
                    }       
                }
            }
            $result = $append;
        }
         $op = [];
        $productInfor = ProductModel::all()->last(); 
        $product = $product->id ?? 0;
        foreach($result as $arr){
            $html[] .='<div class="card card-default collapsed-card">
            <div class="card-header">
                <h3 class="card-title"><label>'. $arr[2]['name'] . '-' . $arr[1]['name'] .'</label></h3>
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
                            <label for="exampleInputEmail1">Product Sku</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter product sku" fdprocessedid="qqg4co" value=" #ProductSku' . $product + 1 . $arr[2]['id'] . $arr[1]['id'] .'" name="sku[]">
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input images" id="customFile"
                                    name="images[]">
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
                            <input type="number" class="form-control" id="quantity_sku" placeholder="Enter Quantity" fdprocessedid="31p86p" name="quantitySku[]" >
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        }
        $q = json_encode($html);
        return response()->json($q); 
        
    }

    public function apiQuantity(Request $request){
        $arr = json_decode($request->quantity);
        return response()->json(array_sum($arr)); 
    }


    public function store(StoreRequest $request)
    {
        try {
            //dd($request);
            $productData = $request->except(['Color','Size','priceSku','quantitySku','images','sku']);
            if($request->hasFile('thumbnail')){
                $thumbnail = $request->thumbnail;
                $nameThumbnail = $thumbnail->getClientOriginalName();
                $dirFolder = 'uploads/image/admin/product/';
                $newThumbnail = $dirFolder . 'product-thumbnail' . '-' . $request->name .  '-' . $nameThumbnail;
                $productData['thumbnail'] = $newThumbnail;
            }
            $product = ProductModel::create($productData);
            
            if(!empty($product)){
                $thumbnail->move($dirFolder, $newThumbnail);
                $productInfor = ProductModel::all()->last();
                if(!empty($request->Size) && !empty($request->Color) && !empty($request->priceSku) && !empty($request->quantitySku) && !empty($request->images) && !empty($request->sku)){
                    $arrOptionProduct = [];
                    foreach($request->Size as $size){
                        $optionValue = OptionValueModel::where('id', $size)->value('option_id');
                        $arrOptionProduct[] = [
                            'product_id' => $productInfor->id,
                            'option_value_id' => $size,
                            'option_id' => $optionValue,
                        ];
                    }
                    
                    foreach($request->Color as $color){
                        $optionValue = OptionValueModel::where('id', $color)->value('option_id');
                        $arrOptionProduct[] = [
                            'product_id' =>  $productInfor->id,
                            'option_value_id' => $color,
                            'option_id' => $optionValue,
                        ];
                    }
                
                    $OptionProduct = new OptionProductModel();
                    $OptionProduct::insert($arrOptionProduct);
                    foreach($request->priceSku as $key => $price){
                        $priceSku[$key] = $price;
                    };
                    foreach($priceSku as $key => $quantity){
                        $quanPriceSku[$key] = [
                            'price' => $quantity,
                            'quantity' => $request->quantitySku[$key],
                            'sku' => $request->sku[$key]
                        ]
                        ;
                    };
                    //dd($quanPriceSku , $arrOptionProduct,$request->images);
                    foreach($request->images as $key => $thumbnailProductSku){
                        $optionProductId = OptionProductModel::where([
                            ['option_value_id', $key],
                            ['product_id', $productInfor->id]
                            ])->value('id');
                            //dd($optionProductId);
                        if($request->hasFile('images')){
                            //dd(1);
                            $thumbnailSku = $thumbnailProductSku;
                            $nameThumbnailSku = $thumbnailSku->getClientOriginalName();
                            $dirFolder = 'uploads/image/admin/product/';
                            $newThumbnailSku = $dirFolder .  'product_thumbnail_sku' . '_' . $request->name .  '-' . $nameThumbnailSku;
                            //dd($newThumbnail);
                            $productSkus[] = [
                                'product_id' =>$productInfor->id,
                                'thumbnail' =>$newThumbnailSku,
                                'price' => $quanPriceSku[$key]['price'],
                                'stock' => $quanPriceSku[$key]['quantity'],
                                'sku' => $quanPriceSku[$key]['sku'],
                                'activated' => '1',
                                'created_at' =>Carbon::now(),
                                'updated_at' =>Carbon::now(),
                            ];
                        }
                    }
                    //dd($productSkus);
                    $product_Sku = new ProductSkuModel();
                    $product_Sku->insert($productSkus);
                    if(!empty($product_Sku)){
                        $thumbnailSku->move($dirFolder, $newThumbnailSku);
                        foreach($request->Color as $color){
                            $colorValue = OptionValueModel::where('id', $color)->value('option_id');
                            $variant = [
                                'option_value_id' => $color,
                                'option_id' => $colorValue,
                            ];
                            foreach( $request->Size as  $size){
                                $sizeValue = OptionValueModel::where('id', $size)->value('option_id');
                                $variantColors[] = [
                                    $variant,
                                    $variantColor = [
                                    'option_value_id' => $size,
                                    'option_id' => $sizeValue,]
                                ];
                            }
                        }
                        foreach($variantColors as $key => $values){
                            foreach($values as $keyA =>  $value){
                                $variantProduct[] = [
                                    "option_value_id" =>  $value['option_value_id'],
                                    "option_id" => $value['option_id'],
                                    'sku_id' => $request->sku[$key],
                                    'product_id' => $productInfor->id, 
                                    'created_at' =>Carbon::now(),
                                    'updated_at' =>Carbon::now(),
                                ];
                            }
                            //dd($variants);
                        }
                        $variants = new VariantModel();
                        $variants->insert($variantProduct);
                        //DD($variantProduct,$request->sku, $variantColors);
                        if(!empty($variants)){
                            return redirect()->route('product.index')->withErrors(['success' => 'Thêm sản phẩm mới thành công!']); 
                        }
                    } 
                }
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
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
