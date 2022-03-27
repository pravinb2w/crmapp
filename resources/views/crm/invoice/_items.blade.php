
@if( isset( $info->deal_product) && !empty($info->deal_products))
    @foreach ($info->deal_products as $item)
        <div id="add-product-tab_{{ $limit }}" class="d-flex w-100 mb-1 calc">

            <select name="item_{{ $limit }}" id="" class="form-control">
                @if( isset( $product_list ) && !empty($product_list))
                    @foreach($product_list as $list)
                        <option value="{{ $list->id }}" @if($item->product_id == $list->id) selected @endif>
                        {{ $list->product_name }}</option>
                    @endforeach
                @endif
            </select>
            <input type="text" name="description_{{ $limit }}" id="" placeholder="Description"class="form-control">
            <input type="number" id="qty" name="quantity_{{ $limit }}" value="{{ $item->quantity ?? '' }}" placeholder="Qty" onchange="return get_total({{ $limit }})" class="form-control w-30">
            <input type="number" id="unit_price" name="unit_price_{{ $limit }}" value="{{ $item->price ?? '' }}" placeholder="Unit Price" onchange="return get_total({{ $limit }})" class="form-control w-50">
            <input type="number" id="discount" name="discount_{{ $limit }}" value="{{ $item->discount ?? '' }}" placeholder="Disc%" onchange="return get_total({{ $limit }})" class="form-control w-40">
            <input type="number" id="cgst" name="cgst{{ $limit }}" value="{{ $item->cgst ?? '' }}"  class="form-control w-40" onchange="return get_total({{ $limit }})" placeholder="CGST%">
            <input type="number" id="sgst" name="sgst_{{ $limit }}"  value="{{ $item->sgst ?? '' }}" class="form-control w-40" onchange="return get_total({{ $limit }})" placeholder="SGST%">
            <input type="number" id="igst" name="igst_{{ $limit }}" value="{{ $item->igst ?? '' }}"  class="form-control w-40" onchange="return get_total({{ $limit }})" placeholder="IGST%">
            <input type="number" id="amount" name="amount_{{ $limit }}" value="{{ $item->amount ?? '' }}" onchange="return get_total({{ $limit }})" class="form-control w-50" placeholder="Amount" readonly>
            <span class="text-danger p-1" role="button" onclick="return remove_items({{ $limit }})"><i class="fa fa-trash"></i></span>
        </div>
        @php
            $limit++;
        @endphp
    @endforeach
@else
<div id="add-product-tab_{{ $limit }}" class="d-flex w-100 mb-1 calc">
    <select name="item_{{ $limit }}" id="" class="form-control" onchange="return get_product_tax(this.value, '{{ $limit }}')">
        <option value="">--select--</option>
        @if( isset( $product_list ) && !empty($product_list))
            @foreach($product_list as $list)
                <option value="{{ $list->id }}" >
                    {{ $list->product_name }}
                </option>
            @endforeach
        @endif
    </select>
    <input type="text" name="description_{{ $limit }}" id="" placeholder="Description"class="form-control">
    <input type="number" id="qty" name="quantity_{{ $limit }}"  placeholder="Qty" onchange="return get_total({{ $limit }})" class="form-control w-30">
    <input type="number" id="unit_price" name="unit_price_{{ $limit }}"  placeholder="Unit Price" onchange="return get_total({{ $limit }})" class="form-control w-50">
    <input type="number" id="discount" name="discount_{{ $limit }}"  placeholder="Disc%" onchange="return get_total({{ $limit }})" class="form-control w-40">
    @if( isset( $with_tax ) && !empty( $with_tax ) )
        <input type="number" id="cgst" name="cgst_{{ $limit }}"  class="form-control w-40" onchange="return get_total({{ $limit }})" placeholder="CGST%">
        <input type="number" id="sgst" name="sgst_{{ $limit }}"  class="form-control w-40" onchange="return get_total({{ $limit }})" placeholder="SGST%">
        <input type="number" id="igst" name="igst_{{ $limit }}"  class="form-control w-40" onchange="return get_total({{ $limit }})" placeholder="IGST%">
    @endif
    <input type="number" id="amount" name="amount_{{ $limit }}" onchange="return get_total({{ $limit }})" class="form-control w-50" placeholder="Amount" readonly>
    <span class="text-danger p-1" role="button" onclick="return remove_items({{ $limit }})"><i class="fa fa-trash"></i></span>
</div>
@endif