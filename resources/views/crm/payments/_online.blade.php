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
                <div class="pay_image">
                    <input type="radio" name="pay_gateway" id="paypal" value="paypal">
                    <label for="paypal">
                        <img src="{{asset('assets/images/payments/paypal1.png')}}" width="75" alt="" for="paypal">
                    </label>
                </div>
                <div class="pay_image">
                    <input type="radio" name="pay_gateway" id="ccavenue" value="ccavenue">
                    <label for="ccavenue">
                        <img src="{{asset('assets/images/payments/ccavenue.png')}}" width="75"  alt="" for="ccavenue">
                    </label>
                </div>
                <div class="pay_image">
                    <input type="radio" name="pay_gateway" id="razor" value="razor">
                    <label for="razor">
                        <img src="{{asset('assets/images/payments/razor.png')}}"  width="75" alt="" for="razor">
                    </label>
                </div>
            </div>
        </div>
        
    </div>
</div>

<script>

</script>