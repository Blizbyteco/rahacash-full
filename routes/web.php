<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\OutcomeController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authentication']);

Route::middleware(['auth'])->group(function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index']);
        Route::resource('/user', UserController::class);
        Route::resource('/sparepart', SparepartController::class);
        Route::post('/sparepart/updateStock', [SparepartController::class, 'updateStock'])->name('sparepart.updateStock');
        Route::get('/transaction/outcome', [OutcomeController::class, 'index']);
        Route::get('/transaction/outcome/{id}/detail', [OutcomeController::class, 'detail']);
        Route::get('/transaction/outcome/export/pdf', [OutcomeController::class, 'exportPDF'])->name('transaction.outcome.export-pdf');
        Route::get('/transaction', [TransactionController::class, 'index']);
        Route::get('/transaction/export/pdf', [TransactionController::class, 'exportPDF'])->name('transaction.export-pdf');
    });
    Route::middleware(['role:staff'])->group(function () {
        Route::get('/cashier', [CashierController::class, 'index']);
        Route::post('/cashier', [CashierController::class, 'store']);
    });
    Route::get('/transaction/income', [IncomeController::class, 'index']);
    Route::get('/transaction/income/export/pdf', [IncomeController::class, 'exportPDF'])->name('transaction.income.export-pdf');
    Route::get('/transaction/income/{id}/detail', [IncomeController::class, 'detail']);
});