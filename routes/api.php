<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CatatanController;
use App\Http\Controllers\Api\RencanaController;
use App\Http\Controllers\Api\PenggunaController;

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

// Route::get('/index/{id}', function ($id) {
//     return 'penggunas'.$id;
// });

Route::apiResource('/pengguna', PenggunaController::class);
Route::apiResource('/rencana', RencanaController::class);
Route::apiResource('/catatan', CatatanController::class);
