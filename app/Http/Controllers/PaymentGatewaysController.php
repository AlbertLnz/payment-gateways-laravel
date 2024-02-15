<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PaymentGatewaysController extends Controller
{
    public function index(): View {
        
        // IziPay
        $iziPay_formToken = $this->izipay_generateFormToken();

        return view('gateways.index', compact('iziPay_formToken'));
    }

    private function izipay_generateFormToken() {

        // IziPay config service:
        $url = config('services.izipay.url');
        $clientId = config('services.izipay.client_id');
        $clientSecret = config('services.izipay.client_secret');

        $auth = base64_encode($clientId . ':' . $clientSecret);

        $headers = [
            'Authorization' => "Basic $auth",
            'Content-Type' => 'application/json'
        ];

        $body = [
            "amount" => 100 * 100, // 100 USD * cents
            "currency" => "USD", // my credentials only works in dolars (USD)
            "orderId" =>  Str::random(20),
            "customer" => [
                "email" => auth()->user()->email,
            ]
        ];

        $response = Http::withHeaders($headers)->post($url, $body)->json();

        return $response['answer']['formToken'];
    }
}
