<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ManufactureRequest\StoreRequest;
use App\Models\AdminModel\ManufactureModel;
use Illuminate\Http\Request;

class ManufactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        //dd($request->hasFile('logo'));
        try {
            $dataManufacturer = $request->all();
            if($request->hasFile('logo')) {
                $avatar = $request->logo;
                $nameAvatar = $avatar->getClientOriginalName();
                $dirFolder = 'uploads/image/admin/manufacturer/';
                $newAvatar = $dirFolder . 'logo-' . $request->name . '-' . $nameAvatar;
                $dataManufacturer['logo'] = $newAvatar;   
            }
            
            $manufacture =  ManufactureModel::create($dataManufacturer);
            //dd($manufacture);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminModel\ManufactureModel  $manufactureModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManufactureModel $manufactureModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminModel\ManufactureModel  $manufactureModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManufactureModel $manufactureModel)
    {
        //
    }
}
