<label for="deal" class="col-form-label"> Deal </label>
<select name="deal_id" id="deal_id" class="form-control">
    <option value="">--select--</option>
    @if( isset($info) && !empty($info))
        @foreach($info as $item)
            <option value="{{ $item->id }}"> {{ $item->deal_title }}</option>
        @endforeach
    @endif
</select>