<div class="modal-dialog modal-xl">
    <style>
        .loader {
            position: absolute;
            top: 0px;
            right: 0px;
            border: 10px solid #f3f3f3;
            /* Light grey */
            border-top: 10px solid #3498db;
            /* Blue */
            border-radius: 50%;
            width: 75px;
            height: 75px;
            animation: spin 0.5s linear infinite;
            background-position: center;
            z-index: 10000000;
            opacity: 0.4;
            filter: alpha(opacity=40);
            left: 50%;
            top: 30%;
            display: none;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Columns */
        .left-column {
            width: 65%;
            position: relative;
            margin-right: 30px;
        }

        .right-column {
            width: 35%;
            /* margin-top: 60px; */
        }

        /* Left Column */
        .left-column img {
            width: 100%;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 1;

        }

        .left-column img.active {
            opacity: 1;
        }

        /* Product Description */
        .product-description {
            border-bottom: 1px solid #E1E8EE;
            margin-bottom: 20px;
        }

        .product-description span {
            font-size: 12px;
            color: #358ED7;
            letter-spacing: 1px;
            text-transform: uppercase;
            text-decoration: none;
        }

        .product-description h1 {
            font-weight: 300;
            font-size: 52px;
            color: #43484D;
            letter-spacing: -2px;
        }

        .product-description p {
            font-size: 16px;
            font-weight: 300;
            color: #86939E;
            line-height: 24px;
        }

        /* Product Color */
        .product-color {
            margin-bottom: 30px;
        }

        .color-choose div {
            display: inline-block;
        }

        .color-choose input[type=&amp;
        quot;
        radio&amp;
        quot;

        ] {
            display: none;
        }

        .color-choose input[type=&amp;
        quot;
        radio&amp;
        quot;

        ]+label span {
            display: inline-block;
            width: 40px;
            height: 40px;
            margin: -1px 4px 0 0;
            vertical-align: middle;
            cursor: pointer;
            border-radius: 50%;
        }

        .color-choose input[type=&amp;
        quot;
        radio&amp;
        quot;

        ]+label span {
            border: 2px solid #FFFFFF;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
        }

        .color-choose input[type=&amp;
        quot;
        radio&amp;
        quot;

        ]#red+label span {
            background-color: #C91524;
        }

        .color-choose input[type=&amp;
        quot;
        radio&amp;
        quot;

        ]#blue+label span {
            background-color: #314780;
        }

        .color-choose input[type=&amp;
        quot;
        radio&amp;
        quot;

        ]#black+label span {
            background-color: #323232;
        }

        .color-choose input[type=&amp;
        quot;
        radio&amp;
        quot;

        ]:checked+label span {
            background-image: url(images/check-icn.svg);
            background-repeat: no-repeat;
            background-position: center;
        }

        /* Cable Configuration */
        .cable-choose {
            margin-bottom: 20px;
            display: flex;
        }

        .cable-choose button {
            border: 2px solid #E1E8EE;
            border-radius: 6px;
            padding: 13px 20px;
            font-size: 14px;
            color: #5E6977;
            background-color: #fff;
            cursor: pointer;
            transition: all .5s;
        }

        .cable-choose button:hover,
        .cable-choose button:active,
        .cable-choose button:focus {
            border: 2px solid #86939E;
            outline: none;
        }

        .cable-config {
            border-bottom: 1px solid #E1E8EE;
            margin-bottom: 20px;
        }

        .cable-config a {
            color: #358ED7;
            text-decoration: none;
            font-size: 12px;
            position: relative;
            margin: 10px 0;
            display: inline-block;
        }

        .cable-config a:before {
            content: &amp;
            quot;
            ?&amp;
            quot;
            ;
            height: 15px;
            width: 15px;
            border-radius: 50%;
            border: 2px solid rgba(53, 142, 215, 0.5);
            display: inline-block;
            text-align: center;
            line-height: 16px;
            opacity: 0.5;
            margin-right: 5px;
        }

        /* Product Price */
        .product-price {
            display: flex;
            align-items: center;
        }

        .product-price span {
            font-size: 26px;
            font-weight: 300;
            color: #43474D;
            margin-right: 20px;
        }

        .cart-btn {
            display: inline-block;
            border: none;
            background-color: #7DC855;
            border-radius: 6px;
            font-size: 16px;
            color: #FFFFFF;
            text-decoration: none;
            padding: 12px 30px;
            transition: all .5s;
        }

        .cart-btn:hover {
            background-color: #64af3d;
        }

        /* Responsive */
        @media (max-width: 940px) {
            .container {
                flex-direction: column;
                margin-top: 60px;
            }

            .left-column,
            .right-column {
                width: 100%;
            }

            .left-column img {
                width: 300px;
                right: 0;
                top: -65px;
                left: initial;
            }
        }

        @media (max-width: 535px) {
            .left-column img {
                width: 220px;
                top: -85px;
            }
        }

        .pay_image {
            margin-right: 8px;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 2px 10px;
        }

        .pay_image:hover {
            box-shadow: 1px 2px 3px 1px #ddd;
        }

        label.error {
            font-size: 10px;
            color: red;
            position: relative !important;
            right: 0%;
            bottom: 0px;
        }

        .modal-body::-webkit-scrollbar {
            width: 3px;
        }

        .modal-body::-webkit-scrollbar-track {
            box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        }

        .modal-body::-webkit-scrollbar-thumb {
            background-color: #4fc3f7;
            outline: 1px solid #0288d1;
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
                        <form action="" id="buy-form" method="POST">

                            <input type="hidden" name="product_id" id="product_id" value="{{ $product_id ?? '' }}">

                            <div class="col-12">

                                @csrf
                                <main class="container"
                                    style="margin: 0 auto;position: relative;
                                padding: 15px;display: flex;">

                                    <!-- Left Column / Headphones Image -->
                                    <div class="left-column">
                                        <img src="{{ $product_info->image ?? 'http://127.0.0.1:8000/storage/files/1/webdesign.png' }}"
                                            alt="">

                                    </div>
                                    <!-- Right Column -->
                                    <div class="right-column">

                                        <!-- Product Description -->
                                        <div class="product-description">
                                            <span>{{ $product_info->package->subscription_name ?? '' }}</span>
                                            <h1>{{ $product_info->product_name ?? '' }}</h1>
                                            <p> {{ $product_info->description ?? '' }} </p>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <span>HSN</span>
                                                <div class="color-choose">
                                                    <div>
                                                        <label
                                                            for="">{{ $product_info->hsn_no ?? 'N/A' }}</label>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <span>Product Code</span>
                                                <div class="color-choose">
                                                    <div>
                                                        <label
                                                            for="">{{ $product_info->product_code ?? 'N/A' }}</label>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                        <!-- Product Configuration -->
                                        <div class="product-configuration">


                                            <!-- Product Color -->
                                            <div class="product-color">
                                                <div class="form-group">
                                                    <span>Name</span>
                                                    <div>
                                                        <input type="text" class="form-control text-start"
                                                            placeholder="Customer Name" id="name" name="name"
                                                            required value="{{ $customer_info->first_name ?? '' }}">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <span>Email</span>
                                                    <div>
                                                        <input type="text" class="form-control text-start"
                                                            placeholder="Customer Email" id="email" name="email"
                                                            required value="{{ $customer_info->email ?? '' }}">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <span>Mobile No</span>
                                                    <div class="d-flex">
                                                        <select name="dial_code" id="dial_code" class="form-control w-25">
                                                            @if( isset( $country ) && !empty( $country ) )
                                                                @foreach ($country as $item)
                                                                    <option value="{{ $item->dial_code }}">{{ $item->dial_code }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        <input type="text" class="form-control text-start"
                                                            maxlength="10" placeholder="Customer Mobile Number"
                                                            id="mobile_no" name="mobile_no" required value="{{ $customer_info->mobile_no ?? '' }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Cable Configuration -->
                                            <div class="cable-config">
                                                <span>Payment Gateway</span>

                                                <div class="cable-choose">
                                                    @if (isset($gateways) && !empty($gateways))
                                                        @foreach ($gateways as $gkey => $gvalue)
                                                            <div class="pay_image ">
                                                                <input type="radio" name="pay_gateway"
                                                                    id="{{ $gvalue->gateway }}"
                                                                    value="{{ $gvalue->gateway }}">
                                                                <label for="{{ $gvalue->gateway }}">
                                                                    @if ($gvalue->gateway == 'paypal')
                                                                        <img src="{{ asset('assets/images/payments/paypal1.png') }}"
                                                                            width="75" alt=""
                                                                            for="{{ $gvalue->gateway }}">
                                                                    @elseif($gvalue->gateway == 'razorpay')
                                                                        <img src="{{ asset('assets/images/payments/razor.png') }}"
                                                                            width="75" alt=""
                                                                            for="{{ $gvalue->gateway }}">
                                                                    @elseif($gvalue->gateway == 'ccavenue')
                                                                        <img src="{{ asset('assets/images/payments/ccavenue.png') }}"
                                                                            width="75" alt=""
                                                                            for="{{ $gvalue->gateway }}">
                                                                    @elseif($gvalue->gateway == 'payumoney')
                                                                        <img src="{{ asset('assets/images/payments/payumoney.png') }}"
                                                                            width="75" alt=""
                                                                            for="{{ $gvalue->gateway }}">
                                                                    @endif
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>

                                            </div>
                                        </div>

                                        <!-- Product Pricing -->
                                        <div class="product-price">
                                            <span>INR {{ $product_info->price }}</span>
                                            {{-- <a href="#" class="cart-btn">Buy Now</a> --}}
                                            <button type="submit" class="cart-btn" id="proceed"> Proceed</button>

                                        </div>
                                    </div>
                                </main>

                            </div>


                        </form>

                    </div>
                </div>
            </div>
            <div class="loader"></div>
        </div>
    </div><!-- /.modal-content -->
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script>
    $(document).ready(function() {

        $('.color-choose input').on('click', function() {
            var headphonesColor = $(this).attr('data-image');

            $('.active').removeClass('active');
            $('.left-column img[data-image = ' + headphonesColor + ']').addClass('active');
            $(this).addClass('active');
        });

    });

    $("#buy-form").validate({
        submitHandler: function(form) {
            $.ajax({
                url: "{{ route('submit.buy.form', $companyCode) }}",
                type: form.method,
                data: $(form).serialize(),
                beforeSend: function() {
                    $('#proceed').attr('disabled', true);
                    $('.loader').show();
                },
                success: function(response) {
                    var from = $('#from').val();
                    $('#proceed').attr('disabled', false);

                    if (response.error.length > 0 && response.status == "1") {
                        toastr.error('Error', response.error);
                        $('.loader').hide();

                    } else {
                        toastr.success('Success', 'Redirect to Payment gateway page');
                        setTimeout(function() {
                            $('.loader').hide();

                            $('#Mymodal').modal('hide');
                        }, 100);
                        if (response.payment_method == 'razorpay') {
                            if (response.route) {
                                window.location.href = response.route;
                            }
                        } else if (response.payment_method == 'payumoney') {
                            if (response.route) {
                                window.location.href = response.route;
                            }
                        } else {
                            if (response.route) {
                                var formValues = response.pay_params;
                                console.log( formValues );
                                var form = document.createElement("form");
                                var nameElement = document.createElement("input"); 
                                var emailElement = document.createElement("input");  
                                var mobileElement = document.createElement("input");  
                                var orderElement = document.createElement("input");  
                                var amountElement = document.createElement("input");  

                                form.method = "POST";
                                form.action = response.route;   

                                nameElement.value = formValues.name;
                                nameElement.name="name";
                                form.appendChild(nameElement);  

                                emailElement.value = formValues.email;
                                emailElement.name="email";
                                form.appendChild(emailElement); 
                                
                                mobileElement.value = formValues.mobile_no;
                                mobileElement.name="mobile_no";
                                form.appendChild(mobileElement); 

                                amountElement.value = formValues.amount;
                                amountElement.name="amount";
                                form.appendChild(amountElement); 

                                orderElement.value = formValues.order_no;
                                orderElement.name="order_no";
                                form.appendChild(orderElement); 


                                document.body.appendChild(form);

                                form.submit();
                                
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
        return /^-?\d*$/.test(value);
    });
</script>
