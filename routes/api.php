<?php

use App\Http\Controllers\AddressBookController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', [LoginController::class, 'apiLogin']);

//Route::get('/address-book', [AddressBookController::class, 'index']);
//Route::post('/address-book', [AddressBookController::class, 'store']);
//Route::delete('/address-book/{addressBook}', [AddressBookController::class, 'destroy']);
//Route::get('/address-book/edit/{addressBook}', [AddressBookController::class, 'edit']);
//Route::put('/address-book/{addressBook}', [AddressBookController::class, 'update']);
//
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::apiResource('address-book', AddressBookController::class)->middleware('auth:sanctum');

