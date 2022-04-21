<label for="deal" class="col-form-label w-100"> Deal  <span id="deal_amount" class="float-right"></span></label>
<select name="deal_id" id="deal_id" class="form-control" onchange="return get_deal_amount(this.value)">
    <option value="">--select--</option>
    @if( isset($info) && !empty($info))
        @foreach($info as $item)
            <option value="{{ $item->id }}"> {{ $item->deal_title }}</option>
        @endforeach
    @endif
</select>