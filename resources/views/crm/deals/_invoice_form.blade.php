
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
                <textarea name="address" id="address" cols="30" rows="3" class="form-control">{{ $info->customer->company->address ?? '' }}</textarea>
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
                <label for="" class="col-3"> Due Days : </label>
                <input type="number" name="due_days" id="due_days" class="form-control w-100" value="" min="1">
            </div>
            <div class="form-group d-flex mt-1">
                <label for="" class="col-3">Currency</label>
                <select name="currency" id="currency" class="form-control" required>
                    <option value="">--select--</option>
                    @if( isset($country) && !empty($country))
                        @foreach ($country as $item)
                            <option value="{{ $item->currency }}">{{ $item->currency }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
    <div class="row mt-2 mb-1">
        <hr>
    </div>
    <div class="row">
        <h5> Invoice Items</h5>
        <span class="text-end">
            <input type="checkbox" name="with_tax" id="with_tax" >
            <label for="with_tax"> With Tax</label>
        </span>
        @php
            $limit = 0;
            
        @endphp
        <input type="hidden" name="limit" id="limit" value="{{ $limit }}">
        @php
            $limit = 0;
        @endphp
        <div class="col-12" id="invoice-items">
            {{-- @include('crm.invoice._items') --}}
        </div>
        <div class="mt-2">
            <a href="javascript:;"  onclick="return get_add_items()">
                <i class="fa fa-plus"></i>
                 Add Items
            </a>
            <div class="text-end">
                <h6> Subtotal : <b id="subtotal">0.00</b></h6>
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
                    $('#save').html('Loading...');
                },
                success: function(response) {
                    $('#save').html('Save');
                    if(response.error.length > 0 && response.status == "1" ) {
                        toastr.error('Errors', response.error );
                    } else {
                        toastr.success('Success', response.error );
                        form.reset();
                    }
                }            
            });
        }
    });

    $('#with_tax').change(function(){
        $('#invoice-items').html('');
    });
</script>
