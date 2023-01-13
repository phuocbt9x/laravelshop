<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\OptionRequest\StoreRequest;
use App\Http\Requests\AdminRequest\OptionRequest\UpdateRequest;
use App\Models\AdminModel\OptionModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $options = OptionModel::orderBy('id', 'DESC')->get();

            return DataTables::of($options)
                ->editColumn('name', function ($option) {
                    return $option->name;
                })
                ->editColumn('status', function ($option) {
                    return $option->status();
                })
                ->editColumn('actions', function ($option) {
                    $routeEdit = route('option.edit', $option->slug);
                    $routeDestroy = "'" . route('option.destroy', $option->slug) . "'";
                    $buttonEdit = '<a href = "' . $routeEdit . '" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>';
                    $buttonDestroy = '<a href = "javascript:void(0)" class="ml-2 btn btn-sm btn-danger" onclick="deleteItem(' . $routeDestroy . ')"><i class="fas fa-trash"></i></a>';
                    return $buttonEdit . $buttonDestroy;
                })
                ->rawColumns(['name', 'status', 'actions'])
                ->make(true);
        }
        return view('admin.option.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.option.create');
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
            if (OptionModel::create($request->validated())) {
                return redirect()->back()->withErrors(['success' => 'Thêm option mới thành công!']);
            }
            return redirect()->back()->withErrors(['error' => 'Thêm option mới thất bại!']);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => 'Lỗi chưa xác định!']);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminModel\OptionModel  $optionModel
     * @return \Illuminate\Http\Response
     */
    public function edit(OptionModel $optionModel)
    {
        return view('admin.option.update', compact('optionModel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminModel\OptionModel  $optionModel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, OptionModel $optionModel)
    {
        try {
            if ($optionModel->update($request->validated())) {
                return redirect()->route('option.index')->withErrors(['success' => 'Cập nhật option thành công!']);
            }
            return redirect()->back()->withErrors(['error' => 'Cập nhật option thất bại!']);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => 'Lỗi chưa xác định!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminModel\OptionModel  $optionModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(OptionModel $optionModel)
    {
        try {
            if ($optionModel->delete()) {
                return 1;
            }
            return 0;
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
