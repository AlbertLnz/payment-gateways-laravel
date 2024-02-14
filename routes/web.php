<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', [ProductController::class, 'index'])->name('web.home');

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show')->middleware('auth', 'subscribed');

Route::get('/billing', [BillingController::class, 'index'])->name('billing.index')->middleware('auth');

// Route::get('/user/invoice/{invoice}', function (Request $request, string $invoice) {
//   return $request->user()->downloadInvoice($invoice); <----- downloadInvoice() functio doesn't work...
// });
Route::get('/user/invoice/{invoiceId}', InvoiceController::class)->name('invoice.generatePDF');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

