<?php

use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\Customization\FaqController;
use App\Http\Controllers\Customization\PageController;
use App\Http\Controllers\Share\UtilsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/statuses',                     [UtilsController::class, 'statuses']);
Route::get('/divisions',                    [UtilsController::class, 'divisions']);
Route::get('/districts/{division}',         [UtilsController::class, 'districts']);
Route::get('/upazilas/{district}',          [UtilsController::class, 'upazilas']);
Route::get('/unions/{upazila}',             [UtilsController::class, 'unions']);
