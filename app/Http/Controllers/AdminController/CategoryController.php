<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\CategoryRequest\StoreRequest;
use App\Http\Requests\AdminRequest\CategoryRequest\UpdateRequest;
use App\Models\AdminModel\CategoryModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = CategoryModel::orderBy('id', 'DESC')->get();

            return DataTables::of($categories)
                ->editColumn('name', function ($category) {
                    return $category->name;
                })
                ->editColumn('parent', function ($category) {
                    return $category->parentCategory->name;
                })
                ->editColumn('status', function ($category) {
                    return $category->status();
                })
                ->editColumn('actions', function ($category) {
                    $routeEdit = route('category.edit', $category->id);
                    $routeDestroy = "'" . route('category.destroy', $category->id) . "'";
                    $buttonEdit = '<a href = "' . $routeEdit . '" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>';
                    $buttonDestroy = '<a href = "javascript:void(0)" class="ml-2 btn btn-sm btn-danger" onclick="deleteItem(' . $routeDestroy . ')"><i class="fas fa-trash"></i></a>';
                    return $buttonEdit . $buttonDestroy;
                })
                ->rawColumns(['name', 'parent', 'status', 'actions'])
                ->make(true);
        }
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategoryModel::where('activated', 1)->whereNull('parent_id')->get();
        return view('admin.category.create', compact('categories'));
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
            if (CategoryModel::create($request->validated())) {
                return redirect()->back()->withErrors(['success' => 'Thêm category mới thành công!']);
            }
            return redirect()->back()->withErrors(['error' => 'Thêm category mới thất bại!']);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => 'Lỗi chưa xác định!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminModel\CategoryModel  $categoryModel
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryModel $categoryModel)
    {
        //Còn lỗi bản thân danh mục không thể làm con của chính nó! FIX sau, khoai quá :((
        $categories = CategoryModel::where('activated', 1)->whereNull('parent_id')->get();
        return view('admin.category.update', compact('categories', 'categoryModel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminModel\CategoryModel  $categoryModel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, CategoryModel $categoryModel)
    {
        try {
            if ($categoryModel->update($request->validated())) {
                return redirect()->back()->withErrors(['success' => 'Cập nhật category thành công!']);
            }
            return redirect()->back()->withErrors(['error' => 'Cập nhật category thất bại!']);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => 'Lỗi chưa xác định!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminModel\CategoryModel  $categoryModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryModel $categoryModel)
    {
        try {
            //dd($categoryModel->delete());
            if ($categoryModel->delete()) {
                return 1;
            }
            return 0;
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
