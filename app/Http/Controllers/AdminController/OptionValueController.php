<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\OptionValueRequest\StoreRequest;
use App\Http\Requests\AdminRequest\OptionValueRequest\UpdateRequest;
use App\Models\AdminModel\OptionModel;
use App\Models\AdminModel\OptionValueModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OptionValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $option)
    {
        $option = OptionModel::where('slug', $option)->first();
        if ($request->ajax()) {
            $values = OptionValueModel::where('option_id', $option->id)->orderBy('id', 'DESC')->get();

            return DataTables::of($values)
                ->editColumn('value', function ($value) {
                    return $value->value;
                })
                ->editColumn('status', function ($value) {
                    return $value->status();
                })
                ->editColumn('actions', function ($value) use ($option) {
                    $routeEdit = route('value.edit', [$option->slug,  $value->slug]);
                    $routeDestroy = "'" . route('value.destroy', [$option->slug,  $value->slug]) . "'";
                    $buttonEdit = '<a href = "' . $routeEdit . '" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>';
                    $buttonDestroy = '<a href = "javascript:void(0)" class="ml-2 btn btn-sm btn-danger" onclick="deleteItem(' . $routeDestroy . ')"><i class="fas fa-trash"></i></a>';
                    return $buttonEdit . $buttonDestroy;
                })
                ->rawColumns(['name', 'status', 'actions'])
                ->make(true);
        }
        return view('admin.option.value.index', compact('option'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($option)
    {
        $option = OptionModel::where('slug', $option)->first();
        return view('admin.option.value.create', compact('option'));
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
            if (OptionValueModel::create($request->validated())) {
                return redirect()->back()->withErrors(['success' => 'Thêm value mới thành công!']);
            }
            return redirect()->back()->withErrors(['error' => 'Thêm value mới thất bại!']);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => 'Lỗi chưa xác định!']);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminModel\OptionValueModel  $optionValueModel
     * @return \Illuminate\Http\Response
     */
    public function edit($option, OptionValueModel $optionValueModel)
    {
        $option = OptionModel::where('slug', $option)->first();
        return view('admin.option.value.update', compact('option', 'optionValueModel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminModel\OptionValueModel  $optionValueModel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $option, OptionValueModel $optionValueModel)
    {
        try {
            if ($optionValueModel->update($request->validated())) {
                return redirect()->route('value.index', $option)->withErrors(['success' => 'Cập nhật option value thành công!']);
            }
            return redirect()->back()->withErrors(['error' => 'Cập nhật option value thất bại!']);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => 'Lỗi chưa xác định!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminModel\OptionValueModel  $optionValueModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($option, OptionValueModel $optionValueModel)
    {
        try {
            if ($optionValueModel->delete()) {
                return 1;
            }
            return 0;
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
