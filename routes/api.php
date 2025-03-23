<?php

use Illuminate\Support\Facades\Route;

Route::post('checkout/result-transfer', [\App\Http\Controllers\CheckoutController::class, 'resultTransfer'])->name('checkout.result-transfer');

