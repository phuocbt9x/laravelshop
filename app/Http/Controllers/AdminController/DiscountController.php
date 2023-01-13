<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\DiscountRequest\StoreRequest;
use App\Models\AdminModel\DiscountModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        //dd($discounts);
        if($request->ajax()){
            $discounts = DiscountModel::get();
            //dd($discounts);
            return DataTables::of($discounts)
            ->editColumn('name',function($discount){
                return $discount->name;
            })
            ->editColumn('slug',function($discount){
                return $discount->slug;
            })
            ->editColumn('type',function($discount){
                return $discount->type();
            })
            ->editColumn('value',function($discount){
                return $discount->value();
            })
            ->addColumn('actions', function($discount){
                $routeEdit = route('discount.edit' ,$discount->slug);
                $routeDestroy = route('discount.destroy' ,$discount->slug);
                $btnEdit = '<a href ="' . $routeEdit . '" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>';
                $buttonDestroy = '<a href = "javascript:void(0)" class="ml-2 btn btn-sm btn-danger" onclick="deleteItem(' . $routeDestroy . ')"><i class="fas fa-trash"></i></a>';
                return $btnEdit . $buttonDestroy;
            })
            ->rawColumns(['name','slug', 'type', 'value', 'actions'])
            ->make();
        }
        return view('admin.discount.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.discount.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            //dd($request->all());
            $discount = DiscountModel::create($request->all());
            //dd($discount);
            if($discount){
                return redirect()->route('discount.index')->withErrors(['success' => 'Thêm mới dữ liệu thành công']);;
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdminModel\DiscountModel  $discountModel
     * @return \Illuminate\Http\Response
     */
    public function show(DiscountModel $discountModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminModel\DiscountModel  $discountModel
     * @return \Illuminate\Http\Response
     */
    public function edit(DiscountModel $discountModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminModel\DiscountModel  $discountModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DiscountModel $discountModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminModel\DiscountModel  $discountModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(DiscountModel $discountModel)
    {
        //
    }
}
