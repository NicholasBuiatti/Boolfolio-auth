<?php

use App\Http\Controllers\Api\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LeadController;
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

Route::get('projects', [ProjectController::class, 'index']);
//MESSO SOPRA A {PROJECT:ID} PERCHè LAVARVEL ALTRIMENTI ENTRA IN QUELLO LI INVECE CHE IN FAVORITE
Route::get('projects/favorite', [ProjectController::class, 'favorite']);
Route::get('projects/types', [ProjectController::class, 'types']);
Route::get('projects/languages', [ProjectController::class, 'languages']);
Route::get('projects/{project:id}', [ProjectController::class, 'show']);


//CREO LA ROTTA DA CUI RECUPERO I DATI DAL FRONT END
Route::post('/contacts', [LeadController::class, 'store']);
