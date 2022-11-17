<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;

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

Route::get('/listings', [ListingController::class, 'listingShow']);

Route::get('/listings/{listing}', function ( Listing $listing ) {
    return $listing->find($listing);
});

Route::post('/listings', [ListingController::class, 'store']);

Route::delete('/listings/{listing}', [ListingController::class, 'destroy']);

Route::put('/listings/{listing}', [ListingController::class, 'update']);