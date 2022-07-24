<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CcavenueController extends Controller
{
    public function success_payment(Request $request)
    {
        dd($request);
    }

    public function cancel_payment(Request $request)
    {
        dd($request);
    }

    public function response_handler(Request $request)
    {

        $merchant_data = '';
        $working_key = '81E0204433275CCA7E007B7781545845';
        $access_code = 'AVOQ87JF30BA32QOAB';
        $merchant_id = '976366';
        $orderId = 'ORDTEXT90900';
        foreach ($_POST as $key => $value) {
            $merchant_data .= $key . '=' . $value . '&';
        }
        $merchant_data .= 'order_id=' . $orderId;

        $encrypted_data = encrypt_crypto($merchant_data, $working_key);

        return view('ccavenue-handler-form', compact('encrypted_data', 'access_code'));
    }
}