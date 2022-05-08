<div class="col-12">
    <style>
        .pay_image {
            height: 100px;
            border: 1px solid;
            padding: 27px;
            border-radius: 5px;
            margin:5px;
        }
    </style>
    
    <div class="row mt-2" id="change-row" >
        
        <div class="col-sm-12" id="payment_gateway">
            <label for="cheque_date"> 
                Payment Gateway <span class="text-danger">*</span> 
            </label>
            <div style="display: flex;">
                @if( isset($gateways ) && !empty($gateways) )
                    @foreach( $gateways as $gkey => $gvalue)
                    <div class="pay_image">
                        <input type="radio" name="pay_gateway" id="{{ $gvalue->gateway }}" value="{{ $gvalue->gateway }}">
                        <label for="{{ $gvalue->gateway }}">
                            @if( $gvalue->gateway == 'paypal')
                            <img src="{{asset('assets/images/payments/paypal1.png')}}" width="75" alt="" for="{{ $gvalue->gateway }}">
                            @elseif($gvalue->gateway == 'razorpay' )
                            <img src="{{asset('assets/images/payments/razor.png')}}"  width="75" alt="" for="{{ $gvalue->gateway }}">
                            @elseif($gvalue->gateway == 'ccavenue')
                            <img src="{{asset('assets/images/payments/ccavenue.png')}}" width="75"  alt="" for="{{ $gvalue->gateway }}">
                            @endif
                        </label>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
        
    </div>
</div>

<script>

</script>