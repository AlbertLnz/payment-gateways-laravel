<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\PaymentGatewaysController;
use Illuminate\Support\Facades\Http;

class PaidController extends Controller
{
    public function izipay(Request $request) {

        // REQUEST WITH 5 ITEMS --> kr-hash ; kr-hash-algorithm ; kr-answer-type ; kr-answer ; kr-hash-key
        // $request->all();

        // 1st validation:
        if($request->get('kr-hash-algorithm') !== 'sha256_hmac') {
            throw new Exception('Invalid hash algorithm!');
        }

        // 2nd validation (delete '/' on 'kr-answer' item):
        $krAnswer = $request->get('kr-answer');
        $krAnswerFiltered = str_replace('\/', '/', $krAnswer);

        // 3rd validation:
        $calculateHash = hash_hmac('sha256', $krAnswerFiltered, env('IZIPAY_HASH_KEY'));

        // 4th validation:
        $validRequest = $request->get('kr-hash') === $calculateHash; // <-- 1: true ; 0: false

        if(!$validRequest) {
            throw new Exception('Invalid hash');
        }

        return redirect()->route('thanks');
    }

    public function niubiz(Request $request) {

        // ORIGINAL REQUEST WITH 1 OBJECT WITH 3 VALUES --> transactionToken ; customerEmail ; channel
        // $request->all();
        // But I need: 'purchaseNumber' & 'amount' ! --> Now 5 values --> transactionToken ; customerEmail ; channel ; purchaseNumber ; amount

        $accessToken = PaymentGatewaysController::niubiz_generateAccessToken();
        $merchantId = config('services.niubiz.merchant_id');

        $url = config('services.niubiz.url_api') . "/api.authorization/v3/authorization/ecommerce/$merchantId";

        $headers = [
            'Authorization' => $accessToken,
            'Content-Type' => 'application/json'
        ];

        $body = [
            'channel' => 'web',
            'captureType' => 'manual',
            'accountable' => true,
            'order' => [
                'tokenId' => $request->transactionToken,
                'purchaseNumber' => $request->purchaseNumber,
                'amount' => $request->amount,
                'currency' => env('NIUBIZ_CURRENCY')
            ],

        ];

        $requestData = Http::withHeaders($headers)->post($url, $body)->json();

        

        if(isset($requestData['dataMap']) && $requestData['dataMap']['ACTION_CODE'] === '000') {
            
            // Response in a Flash Session Variable (only 1 use):
            session()->flash('niubizOK', [
                // 'response' => $requestData,
                'textDescription' => $requestData['dataMap']['ACTION_DESCRIPTION'],
                'purchaseNumber' => $request->purchaseNumber,
                'transactionTime' => $requestData['dataMap']['TRANSACTION_DATE'],
                'cardNumber' => $requestData['dataMap']['CARD'],
                'cardBrand' => $requestData['dataMap']['BRAND'],
                'transactionAmount' => $requestData['order']['amount'] ,
                'transactionCurrency' => $requestData['order']['currency'],
            ]);

            return redirect()->route('thanks');

        } else {
            
            session()->flash('niubizERROR', [
                // 'response' => $requestData,
                'message' => $requestData['data']['ACTION_DESCRIPTION']
            ]);

            return redirect()->route('gateways.index');
        }
    }

    public function paypal(Request $request) {
        $accessToken = PaymentGatewaysController::paypal_generateAccessToken();

        return $accessToken;
    }
}
