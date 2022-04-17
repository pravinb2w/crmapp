@extends('crm.layouts.template')

@section('content')

<div class="container-fluid">
                        
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
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
                    <form class="form-horizontal modal-body" id="payments-form" method="POST" action="{{ route('payments.save') }}" autocomplete="off">
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
                                <label for="payment_type"> Payment Type </label>
                                <div class="row mt-2" >
                                    <div class="col-sm-3 rounded border p-2 text-center">
                                        <input type="radio" name="payment_method" role="button" class="edit form-check-input" id="online" checked="checked">
                                        <label class="form-check-label" for="online" role="button" > Online </label>
                                    </div>
                                    <div class="col-sm-3 rounded border p-2 text-center">
                                        <input type="radio" name="payment_method" role="button" class="edit form-check-input" id="offline" checked="checked">
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
                                <a href="{{ route('payments') }}" class="btn btn-dark"> Cancel</a>
                                <button type="submit" class="btn btn-info" id="save">Save</button>
                            </div>
                        </div>
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
                    $('#error').addClass('alert alert-danger');
                    response.error.forEach(display_errors);
                } else {
                    $('#error').addClass('alert alert-success');
                    response.error.forEach(display_errors);
                    setTimeout(function(){
                        $('#Mymodal').modal('hide');
                    },100);
                    ReloadDataTableModal('pagetype-datatable');
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
            url: "{{ route('payments.autocomplete.customer') }}",
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
            url: "{{ route('payments.customer.deal_info') }}",
            method:'POST',
            data: {customer_id:customer_id},
            success:function(response){
                console.log(response);
                $('#deal_data').html(response);
            }      
        });
}
</script>

@endsection
    