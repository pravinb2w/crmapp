<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\PaymentIntegration;
use Illuminate\Support\Facades\Validator;

class BuyController extends Controller
{
    public function get_buy_form(Request $request){
        $product_id = $request->product_id;
        $product_info = Product::find($product_id);
        $gateways = PaymentIntegration::all();
        $modal_title = 'Buy Now';
        $params = array(
            'product_info' => $product_info,
            'product_id' => $product_id,
            'modal_title' => $modal_title,
            'gateways' => $gateways
        );
        return view('front.buy.buy_form', $params);
    }
}
