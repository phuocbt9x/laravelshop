<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest\ManufactureRequest\StoreRequest;
use App\Http\Requests\AdminRequest\ManufactureRequest\UpdateRequest;
use App\Models\AdminModel\ManufactureModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ManufactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $manufactures = ManufactureModel::get();
            //dd($manufactures);
            return DataTables::of($manufactures)
            ->editColumn('id', function($manufacture){
                //dd($manufacture->id);
                return $manufacture->id;
            })
            ->editColumn('name', function($manufacture){
                return $manufacture->name;
            })
            ->editColumn('slug', function($manufacture){
                return $manufacture->slug;
            })
            ->editColumn('logo', function($manufacture){
                $url= asset($manufacture->logo);
                //dd($url);
                return '<img src="'.$url.'" border="0" width="100" class="img" align="center" />';
            })
            ->editColumn('website', function($manufacture){
                return $manufacture->website;
            })
            ->editColumn('phone', function($manufacture){
                return $manufacture->phone;
            })
            ->editColumn('actions', function ($manufacture) {
                $routeEdit = route('manufacturer.edit', $manufacture->slug);
                $routeDestroy = "'" . route('manufacturer.destroy', $manufacture->slug) . "'";
                $buttonEdit = '<a href = "' . $routeEdit . '" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>';
                $buttonDestroy = '<a href = "javascript:void(0)" class="ml-2 btn btn-sm btn-danger" onclick="deleteItem(' . $routeDestroy . ')"><i class="fas fa-trash"></i></a>';
                return $buttonEdit . $buttonDestroy;
            })
            ->rawColumns(['id', 'name', 'slug', 'logo', 'website', 'phone', 'actions'])
            ->make(true);
        }
        
        return view('admin.manufacturer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manufacturer.create');
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
            $dataManufacturer = $request->all();
            if($request->hasFile('logo')) {
                $avatar = $request->logo;
                $nameAvatar = $avatar->getClientOriginalName();
                $dirFolder = 'uploads/image/admin/manufacturer/';
                $newAvatar = $dirFolder . 'logo-' . $request->name . '-' . $nameAvatar;
                $dataManufacturer['logo'] = $newAvatar;   
            }
            //dd($dataManufacturer);
            //dd($manufacture);
            $manufacture =  ManufactureModel::create($dataManufacturer);
            
            if (!empty($manufacture)) {
                
                $avatar->move($dirFolder, $newAvatar);
                return redirect()->route('manufacturer.index')
                    ->withErrors(['success' => 'Thêm mới dữ liệu thành công']);
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdminModel\ManufactureModel  $manufactureModel
     * @return \Illuminate\Http\Response
     */
    public function show(ManufactureModel $manufactureModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminModel\ManufactureModel  $manufactureModel
     * @return \Illuminate\Http\Response
     */
    public function edit(ManufactureModel $manufactureModel)
    {
        return view('admin.manufacturer.update', compact('manufactureModel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminModel\ManufactureModel  $manufactureModel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, ManufactureModel $manufactureModel)
    {
        try {
            $dataManufacture = $request->all();
            if ($request->hasFile('logo')) {
                $logo = $request->logo;
                $nameAvatar = $logo->getClientOriginalName();
                $dirFolder = 'uploads/image/admin/manufacturer/';
                $newAvatar = $dirFolder . 'logo-' . $request->name . '-' . $nameAvatar;
                $dataManufacture['logo'] = $newAvatar;
                @unlink($manufactureModel->logo);
            }
            else{
                $dataManufacture['logo'] = $manufactureModel->logo;
            }
            $manufacture = $manufactureModel->update($dataManufacture);
            if (!empty($manufacture)) {
                if (!empty($logo)) {
                    $logo->move($dirFolder, $newAvatar);
                }
                return redirect()->route('manufacturer.index')
                    ->withErrors(['success' => 'Dữ liệu cập nhật thành công']);
            }
            
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminModel\ManufactureModel  $manufactureModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManufactureModel $manufactureModel)
    {
        try {
            if ($manufactureModel->delete()) {
                return 1;
            }
            return 0;
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
