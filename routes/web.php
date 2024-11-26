<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\ShopeeController;

Route::get('/shopee/auth', [ShopeeController::class, 'redirectToShopee']);
Route::get('/callback', [ShopeeController::class, 'handleCallback']);