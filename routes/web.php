<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
USE App\Models\Listing;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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
//all listing
Route::get('/',[ListingController::class,'index'] );
//show create form
Route::get('/listings/create',[ListingController::class,'create'] )->middleware('auth');
// store Listing Data
Route::POST('/listings' , [ListingController::class,'store'])->middleware('auth') ;
//show edite forme
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

//edit submit to update
Route::put('/listings/{listing}', [ListingController::class,'update'])->middleware('auth');
//managelisting
Route::get('/listings/manage',[ListingController::class,'manage'])->middleware('auth');

// delet 
Route::delete('/listings/{listing}', [ListingController::class,'delete'])->middleware('auth');

// Single listing
Route::get('/listings/{listing}' , [ListingController::class,'show']) ;
//show registre
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

//CREAT NEW USER
Route::post('/users', [UserController::class, 'store']);

Route::post('/logout',[UserController::class,'logout'])->middleware('auth');
///show login form
Route::get('/login',[UserController::class,'login'])->name('login')->middleware('guest');
// log in route
Route::post('/users/authenticate',[UserController::class,'authenticate']);
