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

        // Niubiz
        $niubiz_sessionToken = $this->niubiz_generateSessionToken();

        return view('gateways.index', compact('iziPay_formToken', 'niubiz_sessionToken'));
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

    public static function niubiz_generateAccessToken() {

        $url = config('services.niubiz.url_api') . '/api.security/v1/security';
        $user = config('services.niubiz.user');
        $password = config('services.niubiz.password');
        
        $auth = base64_encode($user . ':' . $password);

        $header = [
            'Authorization' => "Basic $auth",
        ];

        $response = Http::withHeaders($header)->get($url)->body();

        return $response;
    }
    private function niubiz_generateSessionToken() {
        
        $accessToken = $this->niubiz_generateAccessToken();

        $merchantId = config('services.niubiz.merchant_id');

        $url = config('services.niubiz.url_api') . "/api.ecommerce/v2/ecommerce/token/session/$merchantId";

        $headers = [
            'Authorization' => $accessToken,
            'Content-Type' => 'application/json'
        ];

        $body = [
            "channel" => 'web',
            "amount" => 100, // in dolars (accepts 2 decimals: 100.87)
            "antifraud	" =>  [
                'clientIp' => request()->ip(),
                'merchantDefineData' => [
                    'MDD4'=> auth()->user()->email, // client email
                    'MDD21' => 0, // 1: frequent client ; 0: No frequent client -> depen on your website
                    'MDD32' => auth()->id(), // unique id
                    'MDD75' => 'Registrado', // User is: Registrado, Invitado o Empleado
                    'MDD77' => now()->diffInDays(auth()->user()->created_at) + 1, // how many days when user registered to your website. Minim value must be at least 1!
                ]
            ],
            "customer" => [
                "email" => auth()->user()->email,
            ]
        ];

        $response = Http::withHeaders($headers)->post($url, $body)->json();

        //$response -> Array['sessionKey', 'expirationTime']

        return $response['sessionKey'];
    }
}
