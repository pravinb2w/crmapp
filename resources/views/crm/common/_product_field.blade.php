<div id="add-product-tab" class="d-flex w-100 mb-1 calc">
    <select name="item_{{ $limit }}" id="item_{{ $limit }}" class="form-control">
        @if( isset( $list ) && !empty($list))
            @foreach($list as $list)
                <option value="{{ $list->id }}">{{ $list->product_name }}</option>
            @endforeach
        @endif
    </select>
    <input type="numer" class=" form-control w-20" name="price_{{ $limit }}" id="price" onchange="return get_total({{ $limit }})" placeholder="Price" required>
    <input type="numer" class=" form-control w-10" name="quantity_{{ $limit }}" id="qty" onchange="return get_total({{ $limit }})" placeholder="Qty" value="1">
    <input type="numer" class="form-control w-20" name="amount_{{ $limit }}" id="amount" placeholder="Amount" readonly>
</div>