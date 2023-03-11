<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChildrenRegisterController;

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

//========= Children Register Section ====================

   Route::get('/', [ChildrenRegisterController::class, 'register_form'])->name('children_register');
   Route::post('get-states-by-country', [ChildrenRegisterController::class, 'getState']);
   Route::post('get-cities-by-state', [ChildrenRegisterController::class, 'getCity']);
   Route::post('/children_details_store', [ChildrenRegisterController::class, 'register_children_details_store'])->name('children_details_store');

//ajax CURD OPERATION WITH DATATABLE
Route::get('/pickedup_view_data', [ChildrenRegisterController::class, 'view_record'])->name('children_pickedup_view_data');
Route::post('/store', [ChildrenRegisterController::class, 'store'])->name('store');
Route::get('/fetchall', [ChildrenRegisterController::class, 'fetchAll'])->name('fetchAll');
Route::delete('/delete', [ChildrenRegisterController::class, 'delete'])->name('delete');
Route::get('/edit', [ChildrenRegisterController::class, 'edit'])->name('edit');
Route::post('/update', [ChildrenRegisterController::class, 'update'])->name('update');

//========= Children Register Section end ====================
