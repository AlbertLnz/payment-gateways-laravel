<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

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
        // But I need: 'purchaseNumber' & 'amount' ! --> Now 5 values



        return $request->all();
    }
}
