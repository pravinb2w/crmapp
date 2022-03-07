
<form id="invoice-form"  method="POST" action="{{ route('deals.save-invoice') }}" autocomplete="off">
    @csrf
    <input type="hidden" name="deal_id" value="{{ $id ?? '' }}">
    <div class="row">
        <div class="col-6">
            <h5> Customer Details</h5>
            <div class="form-group  d-flex">
                <label for="" class="col-3"> To : </label>
                <input type="text" name="customer" class="form-control" value="{{ $info->customer->first_name }}" readonly>
                <input type="hidden" name="customer_id" id="customer_id" value="{{ $info->customer_id }}">
            </div>
            <div class="form-group  d-flex mt-1">
                <label for="" class="col-3"> Address : </label>
                <textarea name="address" id="address" cols="30" rows="3" class="form-control">{{ $info->company->address ?? '' }}</textarea>
            </div>
            <div class="form-group d-flex mt-1">
                <label for="" class="col-3">Email</label>
                <input type="text" name="email" id="email" value="{{ $info->customer->email }}" class="form-control">
            </div>
        </div>
        
        <div class="col-6">
            <h5>Invoice Details</h5>
            <div class="form-group d-flex">
                <label for="" class="col-3"> Invoice No : </label>
                <input type="text" name="invoice_no" id="invoice_no" value="{{ $invoice_no ?? '' }}" class="form-control">
            </div>
            <div class="form-group d-flex mt-1">
                <label for="" class="col-3"> Issue Date : </label>
                <input type="text" name="issue_date" id="issue_date" class="form-control datepicker w-100" value="{{ date('d-m-Y', strtotime($info->created_at)) }}">
            </div>
            <div class="form-group d-flex mt-1">
                <label for="" class="col-3"> Due Date : </label>
                <input type="text" name="due_date" id="due_date" class="form-control datepicker w-100" value="{{ date('d-m-Y', strtotime($info->expected_completed_date)) }}">
            </div>
            <div class="form-group d-flex mt-1">
                <label for="" class="col-3">Currency</label>
                <input type="text" name="currency" id="currency" class="form-control">
            </div>
        </div>
    </div>
    <div class="row mt-2 mb-1">
        <hr>
    </div>
    <div class="row">
        <h5> Invoice Items</h5>
        @php
            $limit = 0;
            if( isset( $info->deal_products ) && !empty($info->deal_products)) {
                $limit = count( $info->deal_products) -1;
            }
        @endphp
        <input type="hidden" name="limit" id="limit" value="{{ $limit }}">
        @php
            $limit = 0;
        @endphp
        <div class="col-12" id="invoice-items">
            @include('crm.invoice._items')
        </div>
        <div class="mt-2">
            <a href="javascript:;"  onclick="return get_add_items()">
                <i class="fa fa-plus"></i>
                 Add Items
            </a>
            <div class="text-end">
                <h6> Subtotal : <b id="subtotal">123.00</b></h6>
                <input type="hidden" name="total_cost" id="total_cost" value="{{ $info->product_total ?? '' }}">
            </div>
        </div>
    </div>
    <div class="form-group mt-3 text-end">
        <button type="button" class="btn btn-light me-2" > Cancel </button>
        <button type="submit" class="btn btn-success"> Save </button>
    </div>
</form>
<script>
    
    $("#invoice-form").validate({
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
                        form.reset();
                        if( response.type  && response.deal_id ) {
                            refresh_deal_timeline(response.type, response.deal_id);
                        }
                    }
                }            
            });
        }
    });
</script>
