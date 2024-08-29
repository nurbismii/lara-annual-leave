<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::post('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('store.cuti');
Route::post('/store/paidleave', [App\Http\Controllers\HomeController::class, 'storePaidLeave'])->name('store.paidleave');
Route::post('/store/unpaidleave', [App\Http\Controllers\HomeController::class, 'storeUnpaidLeave'])->name('store.unpaidleave');
Route::resource('user', '\App\Http\Controllers\UserController');
Route::group(['prefix' => 'api/'], function () {
    route::get('employee', [App\Http\Controllers\ApiController::class, 'searchEmployee']);
    route::get('employee/{id}', [App\Http\Controllers\ApiController::class, 'getEmployeeById']);
});
