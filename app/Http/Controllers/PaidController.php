<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\PaymentGatewaysController;
use Illuminate\Support\Facades\Http;

class PaidController extends Controller
{
    public $paymentController;

    public function __construct(){
        $this->paymentController = new PaymentGatewaysController();
    }

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

        // Example route: http://laravel_payment_gateways.test/paid/paypal?amount=100
        $order = $this->paymentController->paypal_generateOrder($request->amount);

        return $order;
    }
    public function capturePaypalOrder(Request $request)  {

        $accessToken = $this->paymentController->paypal_generateAccessToken();
        $orderID = $request->orderID;

        $url = config('services.paypal.url');

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => $accessToken,
        ];

        $body = [
            'intent' => 'CAPTURE'
        ];

        $response = Http::withHeaders($headers)->post($url."/v2/checkout/orders/$orderID/capture", $body)->json();

        if(!isset($response['status'])|| $response['status'] !== 'COMPLETED') {
            throw new Exception('Error al capturar el pago');
        } else{

            return $response;
        }
    }

    public function payu(Request $request) {

        $apiKey = config('services.payu.api_key');

        // Página de confirmación: https://developers.payulatam.com/latam/es/docs/integrations/webcheckout-integration/confirmation-page.html
        
        $merchantId = $request->merchant_id;
        $referenceSale = $request->reference_sale;
        $value = $request->value;
        $currency = $request->currency;
        $statePol = $request->state_pol;

        $newValue = number_format($value, 1, '.', ''); // newValue same as '$New_value' from '/thanks' page

        $sign = md5($apiKey . '~' . $merchantId . '~' . $referenceSale . '~' . $newValue . '~' . $currency . '~' . $statePol);

        // statePol codes: https://developers.payulatam.com/latam/es/docs/getting-started/response-codes-and-variables.html#response-codes-sent-to-the-confirmation-page
        if ($sign === $request->sign) {
            if ($statePol == 4) { // === Aprobada
                dd('Tarjeta aceptada');
            }
            else if($statePol == 6) { // === Declinada
                throw new Exception('Tarjeta declinada');
            }
        }
    }
}
