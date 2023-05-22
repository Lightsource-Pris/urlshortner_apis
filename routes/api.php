<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortnerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('')->as('api.')->group(function () {
    Route::post('/shorten', [ShortnerController::class, 'createEntry']);
    Route::get('/redirect_url/{name}', [ShortnerController::class, 'createRedirection']);
});
 