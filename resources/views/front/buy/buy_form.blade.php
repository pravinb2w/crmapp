<div class="modal-dialog modal-lg">
    <style>
        .pay_image {
            height: 100px;
            border: 1px solid;
            padding: 27px;
            border-radius: 5px;
            margin:5px;
        }
        label.error {
            font-size: 10px;
            color: red;
            position: relative;
            text-align: left;
            bottom:0px;
        }
        input.error {
            border: 1px solid red;
        }
    </style>
    <div class="modal-content h-100">
        <div class="modal-header px-3 text-center" id="myLargeModalLabel">
            <h4 class="w-100">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="max-height: 99vh;overflow:auto">
                <div class="modal-body d-flex h-100 p-1">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-12" id="error"></div>
                        </div>
                        <div class="row">
                            <form action="{{ route('submit.buy.form') }}" id="buy-form" method="POST">

                                <div class="col-12">
                                        @csrf
                                        <div class="text-danger pb-3 text-center">
                                                You are not logged in. You can buy without login.
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 text-start">
                                                <label class="text-start" for="name"> Name </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control text-start" placeholder="Customer Name" id="name" name="name" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="text-start" for="email"> Email </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control text-start" placeholder="Customer Email" id="email" name="email" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="text-start" for="mobile_no"> Mobile Number </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control text-start" maxlength="10" placeholder="Customer Mobile Number" id="mobile_no" name="mobile_no" required>
                                            </div>
                                        </div>
                                        <input type="hidden" name="product_id" id="product_id" value="{{ $product_id ?? '' }}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="" class="text-start">Product Info</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <table class="table">
                                                    <tr>
                                                        <th>Product</th>
                                                        <td> {{ $product_info->product_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Price</th>
                                                        <td> INR {{ $product_info->price }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            Description
                                                        </th>
                                                        <td>
                                                            {{ $product_info->description ?? 'N/A'; }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p>Select Payment Gateway</p>
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
                                
                                <div class="col-md-12 mt-3 mb-3 text-end">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
                                        </div>
                                        <div class="col-sm-8">
                                            <button type="submit" class="btn btn-primary btn-sm" id="proceed" > Proceed</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('razorpay.request') }}" id="form-pay">
                                <input type="hidden" id="order_no" name="order_no">
                            </form>
                        </div>  
                    </div>
                </div>
        </div>
    </div><!-- /.modal-content -->
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
      
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script>
    $("#buy-form").validate({
            submitHandler:function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    beforeSend: function() {
                       $('#proceed').attr('disabled', true);
                    },
                    success: function(response) {
                        var from = $('#from').val();
                        $('#proceed').attr('disabled', false);

                        if(response.error.length > 0 && response.status == "1" ) {
                            toastr.error('Error', response.error );
                        } else {
                            toastr.success('Success', 'Redirect to Payment gateway page' );
                            setTimeout(function(){
                                $('#Mymodal').modal('hide');
                            },100);
                            if( response.order_no ) {
                                $('#order_no').val(response.order_no);
                                $('#form-pay').submit();
                            }
                        }
                    }            
                });
            }
        });

    function setInputFilter(textbox, inputFilter) {
    ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
        textbox.addEventListener(event, function() {
        if (inputFilter(this.value)) {
            this.oldValue = this.value;
            this.oldSelectionStart = this.selectionStart;
            this.oldSelectionEnd = this.selectionEnd;
        } else if (this.hasOwnProperty("oldValue")) {
            this.value = this.oldValue;
            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
        } else {
            this.value = "";
        }
        });
    });
    }

setInputFilter(document.getElementById("mobile_no"), function(value) {
  return /^-?\d*$/.test(value); });
        
</script>
