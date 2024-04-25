<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvestmentsController;
use App\Http\Controllers\TransactionsController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');



});


Route::group(['prefix' => 'shares', 'middleware' => 'verified'], function () {
    Route::get('buy', [InvestmentsController::class, 'buyshares'])->name('buyshares')->middleware('auth');
    Route::post('postbuy', [InvestmentsController::class, 'store'])->name('postbuy')->middleware('auth');
    Route::get('bought', [InvestmentsController::class, 'bought'])->name('bought')->middleware('auth');
    Route::get('sold', [InvestmentsController::class, 'sold'])->name('sold')->middleware('auth');
    Route::post('sellers', [InvestmentsController::class, 'sellers'])->name('getSellers')->middleware('auth');
    Route::post('madepayment', [InvestmentsController::class, 'madepayment'])->name('madepayment')->middleware('auth');
    Route::post('buyers', [InvestmentsController::class, 'buyers'])->name('getBuyers')->middleware('auth');
    Route::post('transaction/dispute', [TransactionsController::class, 'dispute'])->name('dispute')->middleware('auth');
    Route::post('transaction/payer/dispute', [TransactionsController::class, 'disputeproof'])->name('disputeproof')->middleware('auth');
    Route::post('receivedpayment', [InvestmentsController::class, 'receivedpayment'])->name('receivedpayment')->middleware('auth');
});
