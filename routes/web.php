<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FreteController;

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

Route::get('/', [FreteController::class, 'welcome']);
Route::get('/frete', [FreteController::class, 'create']);
Route::post('/frete', [FreteController::class, 'store']);
Route::delete('/frete/{id}', [FreteController::class, 'delete']);
Route::put('/frete/{id}', [FreteController::class, 'update']);

Route::get('/search', [FreteController::class, 'search']);
Route::post('/search', [FreteController::class, 'welcome']);
