<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class PaymentGatewaysController extends Controller
{
    public function __invoke(): View {
        
        return view('gateways.index');

    }
}
