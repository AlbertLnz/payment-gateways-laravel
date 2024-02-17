<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaidController;
use App\Http\Controllers\PaymentGatewaysController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WebhookController;
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

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show')->middleware('auth');

Route::view('/thanks', 'thanks')->name('thanks');

Route::post('/stripe/webhook', [WebhookController::class, 'handleWebhook'])->name('stripe.handleWebhook');

// --------------

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show')->middleware('auth', 'subscribed');

Route::get('/billing', [BillingController::class, 'index'])->name('billing.index')->middleware('auth');

// Route::get('/user/invoice/{invoice}', function (Request $request, string $invoice) {
//   return $request->user()->downloadInvoice($invoice); <----- downloadInvoice() functio doesn't work...
// });
Route::get('/user/invoice/{invoiceId}', InvoiceController::class)->name('invoice.generatePDF');

// --------------

Route::get('/payment-gateways', [PaymentGatewaysController::class, 'index'])->name('gateways.index');

Route::post('/paid/izipay', [PaidController::class, 'izipay'])->name('paid.izipay');
Route::post('/paid/niubiz', [PaidController::class, 'niubiz'])->name('paid.niubiz');
Route::post('/paid/paypal', [PaidController::class, 'paypal'])->name('paid.paypal');
Route::post('/paid/capture-paypal-order', [PaidController::class, 'capturePaypalOrder'])->name('paid.capturePaypalOrder');
Route::post('/paid/payu', [PaidController::class, 'payu'])->name('paid.payu');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

