<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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

// common resource routes
// index - show all listings
// show - show single listing
// create - show form to create new listing
// store - store new listing
// edit - show form to edit listing
// update - update listing
// destroy - delete listing

// All listings
Route::get('/', [ListingController::class, 'index'])->name('home');


// Update submit
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Update submit
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// Store listing data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// manage listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// Single listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

// Show register and create form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// Create new user
Route::post('/users', [UserController::class, 'store']);

// log user out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// login user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

Route::group(['middleware' => ['auth']], function () {
    
    
    // Show create form
    Route::get('/listings/create', [ListingController::class, 'create']);

    // Edit form
    Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);
    //You can use Resource route Here
    //https://www.itsolutionstuff.com/post/laravel-9-resource-route-and-controller-exampleexample.html
   }
);


// Route::get('/hello', function () {
//     return response('<h1>hello world</h1>', 200)
//         ->header('Content-Type', 'text/plain')
//         ->header('foo', 'bar');
// });

// Route::get('posts/{id}', function ($id) {
//     return response('Post ' . $id);
// })->where('id', '[0-9]+');

// Route::get('/search', function (Request $request) {
//     return $request->name . ' ' . $request->city;
// });
