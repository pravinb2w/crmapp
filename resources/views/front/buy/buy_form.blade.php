<div class="modal-dialog modal-lg">
    <style>
        .pay_image {
            height: 100px;
            border: 1px solid;
            border-radius: 5px;
            margin:5px;
            text-align: center;
        }
        .pay_image:hover {
            box-shadow: 0px 1px 2px 3px #3688fc66;
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
        table.p-table th {
            background: linear-gradient(45deg, #0277bd, #4dd0e1);
            color: white;
        }
    </style>
    <style>
        .loader{
        position: absolute;
        top:0px;
        right:0px;
        border: 10px solid #f3f3f3; /* Light grey */
        border-top: 10px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 75px;
        height: 75px;
        animation: spin 0.5s linear infinite;
        background-position:center;
        z-index:10000000;
        opacity: 0.4;
        filter: alpha(opacity=40);
        left: 50%;
        top: 30%;
        display: none;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    </style>
    <div class="modal-content h-100">
        <div class="modal-header px-3 text-center" id="myLargeModalLabel">
            <h4 class="w-100">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="max-height: 99vh;overflow:auto;position: relative;">
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
                                        <div class="col-sm-4">
                                            <label class="text-start" for="name"> Name </label>
                                            <input type="text" class="form-control text-start" placeholder="Customer Name" id="name" name="name" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="text-start" for="email"> Email </label>
                                            <input type="text" class="form-control text-start" placeholder="Customer Email" id="email" name="email" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="text-start" for="mobile_no"> Mobile Number </label>
                                            <input type="text" class="form-control text-start" maxlength="10" placeholder="Customer Mobile Number" id="mobile_no" name="mobile_no" required>
                                        </div>
                                    </div>
                                    <input type="hidden" name="product_id" id="product_id" value="{{ $product_id ?? '' }}">
                                    <div class="row">
                                        <div class="col-sm-12">
                                        
                                            <table class="p-table table table-bordered">
                                                <tr>
                                                    <td class="text-center" colspan="6">
                                                        <label for="" class="text-start">Product Info</label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Product</th>
                                                    <td> {{ $product_info->product_name }}</td>
                                                
                                                    <th>Price</th>
                                                    <td> INR {{ $product_info->price }}</td>
                                                
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
                                    <div class="row card p-3">
                                        <div class="col-sm-12">
                                            <p>Select Payment Gateway</p>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="row">
                                                @if( isset($gateways ) && !empty($gateways) )
                                                    @foreach( $gateways as $gkey => $gvalue)
                                                    <div class="pay_image col-sm-4">
                                                        <input type="radio" name="pay_gateway" id="{{ $gvalue->gateway }}" value="{{ $gvalue->gateway }}">
                                                        <label for="{{ $gvalue->gateway }}">
                                                            @if( $gvalue->gateway == 'paypal')
                                                            <img src="{{asset('assets/images/payments/paypal1.png')}}" width="125" alt="" for="{{ $gvalue->gateway }}">
                                                            @elseif($gvalue->gateway == 'razorpay' )
                                                            <img src="{{asset('assets/images/payments/razor.png')}}"  width="125" alt="" for="{{ $gvalue->gateway }}">
                                                            @elseif($gvalue->gateway == 'ccavenue')
                                                            <img src="{{asset('assets/images/payments/ccavenue.png')}}" width="125"  alt="" for="{{ $gvalue->gateway }}">
                                                            @elseif($gvalue->gateway == 'payumoney')
                                                            <img src="{{asset('assets/images/payments/payumoney.png')}}" width="125"  alt="" for="{{ $gvalue->gateway }}">
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
                                            <button type="button" class="btn btn-light w-100" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
                                        </div>
                                        <div class="col-sm-8">
                                            <button type="submit" class="btn btn-primary btn-sm w-100" id="proceed" > Proceed</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                        </div>  
                    </div>
                </div>
                <div class="loader"></div>
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
                       $('.loader').show();
                    },
                    success: function(response) {
                        var from = $('#from').val();
                        $('#proceed').attr('disabled', false);

                        if(response.error.length > 0 && response.status == "1" ) {
                            toastr.error('Error', response.error );
                            $('.loader').hide();

                        } else {
                            toastr.success('Success', 'Redirect to Payment gateway page' );
                            setTimeout(function(){
                                $('.loader').hide();

                                $('#Mymodal').modal('hide');
                            },100);
                            if( response.payment_method == 'razorpay' ) {
                                if( response.route ){
                                    window.location.href= response.route;
                                }
                            } else if( response.payment_method == 'payumoney' ) {
                                if( response.route ){
                                    window.location.href= response.route;
                                }
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
