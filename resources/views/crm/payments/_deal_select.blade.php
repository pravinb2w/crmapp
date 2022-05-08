<label for="deal" class="col-form-label w-100"> Deal Invoices <span class="text-danger">*</span>  <span id="deal_amount" class="float-right"></span></label>
<select name="invoice_id" id="invoice_id" class="form-control" onchange="return get_deal_amount(this.value)" required>
    <option value="">--select--</option>
    @if( isset($info) && !empty($info))
        @foreach($info as $item)
            <option value="{{ $item->id }}"> {{ $item->invoice_no }}</option>
        @endforeach
    @endif
</select>