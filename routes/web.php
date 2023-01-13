<?php

use App\Http\Controllers\AdminController\CategoryController;
use App\Http\Controllers\AdminController\DiscountController;
use App\Http\Controllers\AdminController\ManufactureController;
use App\Http\Controllers\AdminController\OptionController;
use App\Http\Controllers\AdminController\OptionValueController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('admin.dashboard');
})->name('hompage');

Route::prefix('admin')->group(function () {
    //CategoryController
    Route::group(['controller' => CategoryController::class, 'prefix' => 'category', 'as' => 'category.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{categoryModel}', 'edit')->name('edit');
        Route::patch('update/{categoryModel}', 'update')->name('update');
        Route::delete('destroy/{categoryModel}', 'destroy')->name('destroy');
    });

    //ManufactureController
    Route::group(['controller' => ManufactureController::class, 'prefix' => 'manufacturer', 'as' => 'manufacturer.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{manufactureModel}', 'edit')->name('edit');
        Route::patch('update/{manufactureModel}', 'update')->name('update');
        Route::delete('destroy/{manufactureModel}', 'destroy')->name('destroy');
    });
    Route::group(['controller' => DiscountController::class, 'prefix' => 'discount', 'as' => 'discount.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{manufactureModel}', 'edit')->name('edit');
        Route::patch('update/{manufactureModel}', 'update')->name('update');
        Route::delete('destroy/{manufactureModel}', 'destroy')->name('destroy');
    });
    //OptionController
    Route::group(['controller' => OptionController::class, 'prefix' => 'option', 'as' => 'option.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{optionModel}', 'edit')->name('edit');
        Route::patch('update/{optionModel}', 'update')->name('update');
        Route::delete('destroy/{optionModel}', 'destroy')->name('destroy');
    });

    //OptionValueController
    Route::group(['controller' => OptionValueController::class, 'prefix' => '{option}/value', 'as' => 'value.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{optionValueModel}', 'edit')->name('edit');
        Route::patch('update/{optionValueModel}', 'update')->name('update');
        Route::delete('destroy/{optionValueModel}', 'destroy')->name('destroy');

    });
});
