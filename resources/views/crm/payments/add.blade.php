@extends('crm.layouts.template')

@section('content')

<div class="container-fluid">
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
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard', $companyCode) }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Payments</li>
                    </ol>
                </div>
                <h4 class="page-title">Payments </h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal modal-body" id="payments-form" method="POST" action="{{ route('payments.save', $companyCode) }}" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-3">
                                <label for="name" class="col-form-label">Customer <span class="text-danger">*</span></label>                   
                                <input type="text" name="customer" id="customer" class="form-control"autocomplete="off" required>
                                <input type="hidden" name="customer_id" id="customer_id">
                                <div id="result" class="typeahead-custom"></div>
                            </div>
                            <div class="col-3" id="deal_data">
                                @include('crm.payments._deal_select')
                            </div>
                            <div class="col-6">
                                <label for="payment_type"> Payment Mode </label>
                                <div class="row mt-2" >
                                    <div class="col-sm-3 rounded border p-2 text-center">
                                        <input type="radio" name="payment_mode" onclick="return get_payment_page(this.value)" value="online" role="button" class="edit form-check-input" id="online" checked="checked">
                                        <label class="form-check-label" for="online" role="button" > Online </label>
                                    </div>
                                    <div class="col-sm-3 rounded border p-2 text-center">
                                        <input type="radio" name="payment_mode" value="offline" onclick="return get_payment_page(this.value)" role="button" class="edit form-check-input" id="offline" checked="checked">
                                        <label class="form-check-label" for="offline" role="button" > Offline </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row" id="payment-content">
                            @include('crm.payments._offline')
                        </div>
                        <div class="row">
                            <div class="col-12 text-end">
                                <a href="{{ route('payments', $companyCode) }}" class="btn btn-dark"> Cancel</a>
                                <button type="submit" class="btn btn-info" id="save">Save</button>
                                <button type="submit" class="btn btn-success" id="pay">Pay</button>
                            </div>
                        </div>
                        <div class="loader"></div>
                    </form>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>
    </div>
</div>
<script>
$('#result').hide();

$("#payments-form").validate({
    submitHandler:function(form) {
        $.ajax({
            url: form.action,
            type: form.method,
            data: $(form).serialize(),
            beforeSend: function() {
                $('#error').removeClass('alert alert-danger');
                $('#error').html('');
                $('#error').removeClass('alert alert-success');
                $('#save').html('Loading...');
            },
            success: function(response) {
                $('#save').html('Save');
                if(response.error.length > 0 && response.status == "1" ) {
                    toastr.error('Error', response.error );
                } else {
                    toastr.success('Success', response.error );
                    if( response.pay_gateway == 'razorpay' ) {
                        setTimeout(function(){
                            window.location.href="{{ route('payments.initiate', ['payment_gateway' => 'razorpay', 'companyCode' => $companyCode]) }}";
                        },100);
                    } else {
                        setTimeout(function(){
                            window.location.href="{{ route('payments', $companyCode) }}";
                        },100);
                    }
                    
                }
            }            
        });
    }
});

$('.price').on('keypress', function (event) {
    var regex = new RegExp("^[0-9.]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});

$('#customer').keyup(function(){
    var inputs = this.value;
    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    $.ajax({
            url: "{{ route('payments.autocomplete.customer', $companyCode) }}",
            method:'POST',
            data: {org:inputs},
            success:function(response){
                $('#result').html(response);
                $('#result').show();
            }      
        });
})

function  get_payment_customer_typeahead(customer_id, first_name){
    $('#customer').val(first_name);
    $('#customer_id').val(customer_id);
    $('#result').hide();

    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    $.ajax({
            url: "{{ route('payments.customer.deal_info', $companyCode) }}",
            method:'POST',
            data: {customer_id:customer_id},
            success:function(response){
                console.log(response);
                $('#deal_data').html(response);
            }      
        });
}

function get_deal_amount(invoice_id) {
    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    $.ajax({
            url: "{{ route('payments.customer.deal_amount', $companyCode) }}",
            method:'POST',
            data: {invoice_id:invoice_id},
            beforeSend:function(){
                $('#deal_amount').removeClass('badge bg-warning');
                $('#deal_amount').html('');
            },
            success:function(response){
                if( response.amount) {
                    $('#deal_amount').addClass('badge bg-warning');
                    $('#deal_amount').html('Amount: '+response.amount);
                }
            }      
        });
}

$('#pay').hide();

function get_payment_page(mode) {
    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    $.ajax({
        url: "{{ route('payments.get_page', $companyCode) }}",
        method:'POST',
        data: {mode:mode},
        beforeSend:function(){
            $('.loader').show();
        },
        success:function(response){
            $('.loader').hide();
            console.log(mode);
            if(mode == 'online') {
                $('#pay').show();
                $('#save').hide();
            } else {
                $('#pay').hide();
                $('#save').show();

            }
            $('#payment-content').html(response);
        }      
    });
}

</script>

@endsection
    