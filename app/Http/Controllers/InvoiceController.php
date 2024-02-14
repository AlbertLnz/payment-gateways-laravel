<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Invoice;

class InvoiceController extends Controller
{
    public function __invoke(string $invoiceId) {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $invoice = Invoice::retrieve($invoiceId);

        return redirect($invoice->invoice_pdf);
    }
}
