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
use PhpParser\Node\Stmt\Foreach_;
use Termwind\Components\Dd;

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
        // if(!empty($request->product_id)){
        //     $optionProduct = OptionProductModel::where('product_id', $request->product_id)->get();
        //     $variants = VariantModel::where('product_id', $request->product_id)->get();

        //     //DD($variants);
        //     foreach($variants as $variant){
        //         //dd($variant);
        //         $product_Sku = ProductSkuModel::where('product_id', $request->product_id)->get();
        //         $productSkus = ProductSkuModel::where([
        //             ['product_id', $variant->product_id],
        //             ['sku', $variant->sku_id]
        //         ])->groupBy('sku')->get();
                
        //         foreach($productSkus as $productSku){
        //             //dd($productSku);
        //             $arrSku[$variant->option_id][] = [
        //                 'option_value' => $variant->option_value_id,
        //                 'sku' =>$productSku->sku,
        //                 'price' => $productSku->price,
        //                 'stock' => $productSku->stock
        //             ];
        //         }
        //     }
        // }
        // else{
        //     $productSkus = [];
        // }
        $html = [];
        $result = array(array());
        foreach ($arr as $key => $values) {
            $append = array();
            foreach($result as $product) {
                foreach($values as $item) {
                    $infors = OptionValueModel::where('id' , $item)->get();
                    foreach($infors as $infor){
                        if(!empty($request->product_id)){
                                $product[$infor->option_id] = [
                                    'id' => $infor->id,
                                    'name' =>  $infor->value,
                                ];
                            $append[] = $product;
                        }
                        else{
                            $product[$infor->option_id] = [
                                'id' => $infor->id,
                                'name' =>  $infor->value,
                            ];
                            $append[] = $product;
                        }
                    }       
                }
            }
            $result = $append;
        }
        //dd($result);
        $productInfor = ProductModel::all()->last(); 
        $product = $productInfor->id ?? 0;
        $odd = array();
        $even = array();
        if(!empty($request->product_id)){$productSku = ProductSkuModel::where('product_id', $request->product_id)->get();
            
            foreach($productSku as $sku){
                //dd($sku);
                $variants = VariantModel::where('sku_id', $sku['sku'])->get(['option_value_id','sku_id'])->toArray();
                $pathSku[] = [
                    'sku' => $sku['sku'],
                    'stock' => $sku['stock'],
                    'price' => $sku['price'],
                ];
                foreach ($variants as $k => $v) 
                {
                    if ($k % 2 == 0) {
                        $even[] = $v;
                    }
                    else {
                        $odd[] = $v;
                    }
                }
            }
            $newArray = [];
            foreach($odd as $index => $value) {
                //dd($value);
                if(isset($even[$index])) {
                    //dd($even[$index]['option_value_id']);
                    $newArray[$even[$index]['option_value_id']][$value['option_value_id']] = [
                        'sku' =>   $even[$index]['sku_id']
                    ];
                }
                
            }
        }
        else{
            $newArray = [];
        }
        foreach($result as  $arr){
                if(!empty($request->product_id)){
                    if(isset($newArray[$arr[2]['id']][$arr[1]['id']])){
                        $productSkuInfor = ProductSkuModel::where('sku' , $newArray[$arr[2]['id']][$arr[1]['id']]['sku'])->get();
                    }
                }
                else{
                    $productSkuInfor = '';
                }
                
                $thumbnailSku = (isset($newArray[$arr[2]['id']][$arr[1]['id']])) ? ("http://laravelshop.test/" . $productSkuInfor[0]->thumbnail) : "https://upload.wikimedia.org/wikipedia/commons/b/b1/Loading_icon.gif?20151024034921";
                $thumbnailImageSku = (isset($newArray[$arr[2]['id']][$arr[1]['id']])) ? ($productSkuInfor[0]->thumbnail) : "";
                $newProductSkuName = ("#ProductSku" . $product + 1 . $arr[2]['id'] . $arr[1]['id']);
                $skuId = (isset($newArray[$arr[2]['id']][$arr[1]['id']])) ? ($productSkuInfor[0]->sku) : $newProductSkuName;
                $html[] .='<div class="card card-default collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title"><label>'. $arr[2]['name'] . '-' . $arr[1]['name'] .'</label></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                fdprocessedid="lq7q1n">
                                <i class="fas fa-plus"></i>
                            </button>
                           
                        </div>
                    </div>
        
                    <div class="card-body" style="display: none;">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Sku</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter product sku" fdprocessedid="qqg4co" value="'. (($newArray[$arr[2]['id']][$arr[1]['id']]['sku'])  ?? $newProductSkuName).'" name="sku[]" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input images" id="customFile"
                                            name="images['. $skuId .']">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                        <input type="hidden" value="' . $thumbnailImageSku . '" name="thumbnailSku['. $skuId .']">
                                    </div>
                                    <div class="d-flex justify-content-center mw-100" id="preview_logo">
                                        <img src="'. $thumbnailSku .'"
                                            alt="" style="width: 200px;" class="" id="thumbnail_Sku">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="price_sku">Price</label>
                                    <input type="number" class="form-control" id="price_sku" placeholder="Enter price" fdprocessedid="31p86p" name="priceSku['. $skuId .']" value="'. ((isset($newArray[$arr[2]['id']][$arr[1]['id']])) ? ($productSkuInfor[0]->price) : '') .'">
                                </div>
                                <div class="form-group">
                                    <label for="quantity_sku">Quantity</label>
                                    <input type="number" class="form-control" id="quantity_sku" placeholder="Enter Quantity" fdprocessedid="31p86p" name="quantitySku['. $skuId .']" value="'. ((isset($newArray[$arr[2]['id']][$arr[1]['id']])) ? ($productSkuInfor[0]->stock) : '') .'">
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
            $productData = $request->except(['Color','Size','priceSku','quantitySku','images','sku','thumbnailSku']);
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
                        ];
                    };
                    foreach($request->images as $key => $thumbnailProductSku){
                        $optionProductId = OptionProductModel::where([
                            ['option_value_id', $key],
                            ['product_id', $productInfor->id]
                            ])->value('id');
                            //dd($optionProductId);
                        if($request->hasFile('images')){
                            $thumbnailSku = $thumbnailProductSku;
                            $nameImage = explode('#',$key);
                            $nameThumbnailSku = $thumbnailSku->getClientOriginalName();
                            $dirFolder = 'uploads/image/admin/product/';
                            $newThumbnailSku = $dirFolder .  'product_thumbnail_sku' . '_' . $nameImage[1] .  '-' . $nameThumbnailSku;
                            $productSkus[] = [
                                'product_id' =>$productInfor->id,
                                'thumbnail' =>$newThumbnailSku,
                                'price' => $quanPriceSku[$key]['price'],
                                'stock' => $quanPriceSku[$key]['quantity'],
                                'sku' => $key,
                                'activated' => '1',
                                'created_at' =>Carbon::now(),
                                'updated_at' =>Carbon::now(),
                            ];
                            $thumbnailSku->move($dirFolder, $newThumbnailSku);
                        }
                    }
                    $product_Sku = new ProductSkuModel();
                    $product_Sku->insert($productSkus);
                    
                    
                    if(!empty($product_Sku)){
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
                        }
                        $variants = new VariantModel();
                        $variants->insert($variantProduct);
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
        //dd($productModel);
        $productSkus = ProductSkuModel::where('product_id',$productModel->id)->get();
        $optionValue = OptionValueModel::join('options','option_values.option_id' , '=','options.id' )->get(['option_values.*','options.name'])->groupBy(['name']);
        //dd($optionValue);
        $arr = [];
        $optionProducts = OptionProductModel::where('product_id', $productModel->id)->get()->all();
        //dd($optionProducts);
        foreach($optionProducts as $optionProduct){
            $arr[$optionProduct->option_value_id] =
                $optionProduct->option_value_id 
            ; 
            
        }
        //dd($arr);
        //dd($optionProduct !== []);
        $manufactures = ManufactureModel::get();
        $categorys = CategoryModel::whereNotNull('parent_id')->get();
        $variants = VariantModel::where('product_id', $productModel->id)->get();
        return view('admin.product.update',compact([
            'productSkus','optionValue','optionProducts','variants','manufactures','categorys','productModel','arr'
        ]));
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
        //dd($request);
        try {
            $productData = $request->except(['Color','Size','sku','thumbnailSku','priceSku','quantitySku']);
            
            if($request->hasFile('thumbnail')){
                $thumbnail = $request->thumbnail;
                $nameThumbnail = $thumbnail->getClientOriginalName();
                $dirFolder = 'uploads/image/admin/product/';
                $newThumbnail = $dirFolder . 'product-thumbnail' . '-' . $request->name .  '-' . $nameThumbnail;
                $productData['thumbnail'] = $newThumbnail;
                @unlink($productModel->thumbnail);
            }
            else{
                $productData['thumbnail'] = $productModel['thumbnail'];
            }
            $product = $productModel->update($productData);
            if(!empty($product)){
                if(!empty($thumbnail)){
                    $thumbnail->move($dirFolder, $newThumbnail);
                }
                
                
                if(!empty($request->Color) && !empty($request->Size) && !empty($request->sku) && !empty($request->thumbnailSku) && !empty($request->priceSku) && !empty($request->quantitySku)){
                    
                    $arrOptionProduct = [];
                    foreach($request->Size as $size){
                        $optionValue = OptionValueModel::where('id', $size)->value('option_id');
                        $arrOptionProduct[] = [
                            'product_id' => $productModel->id,
                            'option_value_id' => $size,
                            'option_id' => $optionValue,
                        ];
                    }
                    
                    foreach($request->Color as $color){
                        $optionValue = OptionValueModel::where('id', $color)->value('option_id');
                        $arrOptionProduct[] = [
                            'product_id' =>  $productModel->id,
                            'option_value_id' => $color,
                            'option_id' => $optionValue,
                        ];
                    }
                    // dd($arrOptionProduct);
                    
                    OptionProductModel::where('product_id', $productModel->id)->delete();
                    $OptionProduct = new OptionProductModel();
                    $OptionProduct::insert($arrOptionProduct);
                    //dd($request->sku[]);
                    foreach($request->priceSku as $key => $price){
                        $priceSku[$key] = $price;
                    };
                    foreach($priceSku as $key => $quantity){
                        //dd($quantity);
                        $quanPriceSku[$key] = [
                            'price' => $quantity,
                            'quantity' => $request->quantitySku[$key],
                            //'sku' => $request->sku[$key]
                        ]
                        ;
                    };
                    
                    //dd($quanPriceSku,$request->sku );
                    $productSkus = [];
                    if(!empty($request->images)){
                        $InforProductSkus = ProductSkuModel::where('product_id', $productModel->id)->get();
                        foreach($request->sku as  $InforProductSku){ 
                            if(isset($request->images[$InforProductSku])){
                                $nameImage = explode('#',$InforProductSku);
                                //dd($nameImage[1]);
                                $thumbnailSku = $request->images[$InforProductSku];
                                //dd(100);
                                $nameThumbnailSku = $thumbnailSku->getClientOriginalName();
                                $dirFolder = 'uploads/image/admin/product/';
                                $newThumbnailSku = $dirFolder .  'product_thumbnail_sku' . '_'  . $nameImage[1] .  '-' . $nameThumbnailSku;
                                //dd($newThumbnailSku);
                                @unlink($request->thumbnailSku[$InforProductSku]);
                                $thumbnailSku->move($dirFolder, $newThumbnailSku);
                            }
                            else{
                                $newThumbnailSku = $request->thumbnailSku[$InforProductSku];
                            }
                            $arr[] = [
                                'product_id' =>$productModel->id,
                                'thumbnail' =>$newThumbnailSku,
                                'price' => $quanPriceSku[$InforProductSku]['price'],
                                'stock' => $quanPriceSku[$InforProductSku]['quantity'],
                                'sku' => $InforProductSku,
                                'activated' => '1',
                                'created_at' =>Carbon::now(),
                                'updated_at' =>Carbon::now(),
                            ];
                        }
                        //Dd($arr, $request->thumbnailSku);
                    }
                    else{
                        //dd(10);
                        $InforProductSkus = ProductSkuModel::where('product_id', $productModel->id)->get();
                        foreach($request->sku as  $InforProductSku){ 
                            $newThumbnailSku = $request->thumbnailSku[$InforProductSku];
                            //dd($newThumbnailSku);
                            $arr[] = [
                                'product_id' =>$productModel->id,
                                'thumbnail' =>$newThumbnailSku,
                                'price' => $quanPriceSku[$InforProductSku]['price'],
                                'stock' => $quanPriceSku[$InforProductSku]['quantity'],
                                'sku' => $InforProductSku,
                                'activated' => '1',
                                'created_at' =>Carbon::now(),
                                'updated_at' =>Carbon::now(),
                            ];
                            //DD($arr);
                            //$newThumbnailSku->move($dirFolder, $newThumbnailSku);
                        }
                    }//dd($arr);
                    //dd(3);
                    // //dd($productSkus);

                    VariantModel::where('product_id', $productModel->id)->delete();
                    ProductSkuModel::where('product_id', $productModel->id)->delete();
                    //dd($a);
                    $product_Sku = new ProductSkuModel();
                    $product_Sku->insert($arr);

                    if(!empty($product_Sku)){
                        //dd(50);
                        foreach($request->Color as $color){
                            $colorValue = OptionValueModel::where('id', $color)->value('option_id');
                            $variant = [
                                'option_value_id' => $color,
                                'option_id' => $colorValue,
                            ];
                            foreach( $request->Size as $size){
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
                            foreach($values as  $value){
                                $variantProduct[] = [
                                    "option_value_id" =>  $value['option_value_id'],
                                    "option_id" => $value['option_id'],
                                    'sku_id' => $request->sku[$key],
                                    'product_id' => $productModel->id, 
                                    'created_at' =>Carbon::now(),
                                    'updated_at' =>Carbon::now(),
                                ];
                            }
                            //dd($variants);
                        }
                        //dd($request);
                        //dd($variantProduct);
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminModel\ProductModel  $productModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductModel $productModel)
    {
        try {
            $variants = VariantModel::where('product_id' , $productModel->id)->get()->all();
            $productSkus = ProductSkuModel::where('product_id' , $productModel->id)->get()->all();
            $optionProducts = OptionProductModel::where('product_id' , $productModel->id)->get()->all();

            if(!empty($variants)){
                foreach($variants as $variant){
                    $variant->delete();
                }
                foreach($productSkus as $productSku){
                    $productSku->delete();
                }
                foreach($optionProducts as $optionProduct){
                    $optionProduct->delete();
                }
                $productModel->delete();
                return 1;
            }
            elseif(empty($variants)){
                $productModel->delete();
                return 1;
            }
            else{
                return 0;
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
        
    }
}
