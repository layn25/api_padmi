<?php

use App\Http\Controllers\api\BullyingController;
use App\Http\Controllers\api\KelulusanController;
use App\Http\Controllers\api\PelanggaranController;
use App\Http\Controllers\api\PrestasiController;
use App\Http\Controllers\api\SiswaController;
use App\Http\Controllers\api\UserController;
use App\Models\Bullying;
use App\Models\Pelanggaran;
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

Route::group(['prefix' => 'siswa'], function () {
    Route::get('/', [SiswaController::class, 'index']);
    Route::get('/{id}', [SiswaController::class, 'show']);
    Route::post('/', [SiswaController::class, 'store']);
    Route::put('/{id}', [SiswaController::class, 'update']);
    Route::delete('/{id}', [SiswaController::class, 'destroy']);
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

Route::group(['prefix' => 'bullying'], function () {
    Route::get('/', [BullyingController::class, 'index']);
    Route::get('/{id}', [BullyingController::class, 'show']);
    Route::post('/', [BullyingController::class, 'store']);
    Route::put('/{id}', [BullyingController::class, 'update']);
    Route::delete('/{id}', [BullyingController::class, 'destroy']);
});

Route::group(['prefix' => 'kelulusan'], function () {
    Route::get('/', [KelulusanController::class, 'index']);
    Route::get('/{id}', [KelulusanController::class, 'show']);
    Route::post('/', [KelulusanController::class, 'store']);
    Route::put('/{id}', [KelulusanController::class, 'update']);
    Route::delete('/{id}', [KelulusanController::class, 'destroy']);
});

Route::group(['prefix' => 'pelanggaran'], function () {
    Route::get('/', [PelanggaranController::class, 'index']);
    Route::get('/{id}', [PelanggaranController::class, 'show']);
    Route::post('/', [PelanggaranController::class, 'store']);
    Route::put('/{id}', [PelanggaranController::class, 'update']);
    Route::delete('/{id}', [PelanggaranController::class, 'destroy']);
});

Route::group(['prefix' => 'prestasi'], function () {
    Route::get('/', [PrestasiController::class, 'index']);
    Route::get('/{id}', [PrestasiController::class, 'show']);
    Route::post('/', [PrestasiController::class, 'store']);
    Route::put('/{id}', [PrestasiController::class, 'update']);
    Route::delete('/{id}', [PrestasiController::class, 'destroy']);
});

