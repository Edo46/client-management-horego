<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonInChargeController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\ManageUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (Auth::check()){
        return response()->redirectTo('home');
    } else {
        return response()->redirectTo('login');
    }
});

Auth::routes();

Route::get('/logout', function () {
    Auth::logout();
    return response()->redirectTo('/login');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'manage-pic'], function () {
        Route::get('/', [PersonInChargeController::class, 'index']);
        Route::get('/data', [PersonInChargeController::class, 'ajaxTable']);
        Route::get('/list', [PersonInChargeController::class, 'list']);
        Route::post('/input', [PersonInChargeController::class, 'input']);
        Route::post('/edit/{id}', [PersonInChargeController::class, 'edit']);
        Route::post('/delete/{id}', [PersonInChargeController::class, 'delete']);
    });

    Route::group(['prefix' => 'manage-organisation'], function () {
        Route::get('/', [OrganisationController::class, 'index']);
        Route::get('/data', [OrganisationController::class, 'ajaxTable']);
        Route::post('/input', [OrganisationController::class, 'input']);
        Route::post('/edit/{id}', [OrganisationController::class, 'edit']);
        Route::post('/delete/{id}', [OrganisationController::class, 'delete']);
    });
});

Route::group(['middleware' => ['role:super_admin', 'auth']], function () {
    Route::group(['prefix' => 'manage-user'], function () {
        Route::get('/', [ManageUserController::class, 'index']);
        Route::get('/data', [ManageUserController::class, 'ajaxTable']);
        Route::post('/input', [ManageUserController::class, 'input']);
        Route::post('/edit/{id}', [ManageUserController::class, 'edit']);
        Route::post('/delete/{id}', [ManageUserController::class, 'delete']);
    });
});

