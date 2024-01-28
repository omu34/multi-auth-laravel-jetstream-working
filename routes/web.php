<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clients\ApplicationController;
use App\Http\Controllers\Employees\ClientController;
use App\Http\Controllers\Admin\UserController;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'role:client', 'prefix' => 'client', 'as' => 'client.'], function() {
        Route::resource('/client/applications', ApplicationController::class);
    });
   Route::group(['middleware' => 'role:employee', 'prefix' => 'employee', 'as' => 'employee.'], function() {
       Route::resource('/employee/clients', ClientController::class);

   });
    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::resource('users', UserController::class);
    });
});
