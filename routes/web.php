<?php

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

Route::get('/' , function(){
    return view('admin.dashboard');
})->name('hompage');
Route::get('/create' , function(){
    return view('admin.category.create');
})->name('category.index');
Route::get('/index' , function(){
    return view('admin.category.index');
})->name('category.index');
