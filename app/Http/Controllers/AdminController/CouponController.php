<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\CouponRequest\StoreRequest;
use App\Http\Requests\AdminRequest\CouponRequest\UpdateRequest;
use App\Models\AdminModel\CouponModel;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $coupons = CouponModel::get();
            //dd($coupons);
            return DataTables::of($coupons)
            ->editColumn('id', function($coupon){
                return $coupon->id;
            })
            ->editColumn('name', function($coupon){
                return $coupon->name;
            })
            ->editColumn('code', function($coupon){
                return $coupon->code;
            })
            ->editColumn('type',function($discount){
                return $discount->type();
            })
            ->editColumn('stock', function($coupon){
                return $coupon->stock;
            })
            ->editColumn('time_start', function($coupon){
                return ConvertDateTime($coupon->time_start);
            })
            ->editColumn('time_end', function($coupon){
                return $coupon->time_end;
            })
            ->editColumn('value',function($discount){
                return $discount->value();
            })
            ->editColumn('actions', function ($coupon) {
                $routeEdit = route('coupon.edit', $coupon->name);
                $routeDestroy = "'" . route('coupon.destroy', $coupon->name) . "'";
                $buttonEdit = '<a href = "' . $routeEdit . '" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>';
                $buttonDestroy = '<a href = "javascript:void(0)" class="ml-2 btn btn-sm btn-danger" onclick="deleteItem(' . $routeDestroy . ')"><i class="fas fa-trash"></i></a>';
                return $buttonEdit . $buttonDestroy;
            })
            ->rawColumns(['id','name', 'code','type','stock', 'time_start', 'time_end', 'value', 'actions'])
            ->make(true);
        }
        return view('admin.coupon.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create');
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
            //dd($request);
           
            $coupon = CouponModel::create($request->all());
            if(!empty($coupon)){
                return redirect()->route('coupon.index')
                    ->withErrors(['success' => 'Thêm mới dữ liệu thành công']);
            }
            //dd( Hash::make($request->name));
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdminModel\CouponModel  $couponModel
     * @return \Illuminate\Http\Response
     */
    public function show(CouponModel $couponModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminModel\CouponModel  $couponModel
     * @return \Illuminate\Http\Response
     */
    public function edit(CouponModel $couponModel)
    {
        return view('admin.coupon.update', compact('couponModel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminModel\CouponModel  $couponModel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, CouponModel $couponModel)
    {
        try {
            $coupon = $couponModel->update($request->all());
            if($coupon){
                return redirect()->route('coupon.index')
                    ->withErrors(['success' => 'Sửa dữ liệu thành công']);
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminModel\CouponModel  $couponModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(CouponModel $couponModel)
    {
        try {
            if ($couponModel->delete()) {
                return 1;
            }
            return 0;
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
