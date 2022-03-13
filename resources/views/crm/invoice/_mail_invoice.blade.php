<style>
    .item-table {
    width: 100%;
    margin-bottom: 1.5rem;
    color: #6c757d;
    vertical-align: top;
    border-color: #eef2f7;
}

.item-table tr td {
    border-bottom-width: 1px; 
    padding: 3px;
    border-color: #6c757d;

}
.item-table tr th {
    background:lightgray;color:black
}
.item-table > :not(:first-child) {
    border-top: 2px solid #edeff1;
}
</style>
<table style="width: 100%;">
    <tr>
        <td style="width: 70%;">
            <div class="col-sm-7 text-center text-sm-start mb-3 mb-sm-0">
                @if( isset($company->site_logo) && !empty($company->site_logo))
                <img id="logo" style="width: 250px" src="{{ asset('storage/'.$company->site_logo) }}" title="Phoneix" alt="Phoneix" />
                @else
                <img id="logo" style="width: 250px" src="{{ asset('assets/images/logo/logo-color.png') }}" title="Phoneix" alt="Phoneix" /> 
                @endif
                {{-- <img id="logo" style="width: 250px" src="{{ asset('storage/'.$company->site_logo) }}" title="Phoneix" alt="Phoneix" /> --}}
            </div>
        </td>
        <td style="width: 30%;text-align:right;">
            <h4 class="text-7 mb-0">Invoice</h4>
            <strong>Invoice No:</strong> {{ $info->invoice_no ?? '' }}
        </td>
    </tr>
</table>
<main>
    <hr>
    <table class="m-0 table table-borderless" style="width: 100%;">
        <tr>
            <td style="padding: 0 !important;width:50%;text-align:left"  >
                <div><strong>Date:</strong> {{ date('d/m/Y', strtotime($info->created_at)) }}</div>
                <div><strong>Issued:</strong> {{ date('d/m/Y', strtotime($info->issue_date)) }}</div>
            </td>
            <td  style="padding: 0 !important;width:50%;text-align:right" class="text-end">
                <div><strong>Due Date:</strong> {{ date('d/m/Y', strtotime($info->due_date)) }} </div>
            </td>
        </tr>
    </table>
    <hr>
    <table class="table table-borderless" style="width: 100%;">
        <tr>
            <td style="width: 50%">
                <div  > <strong>Pay To:</strong>
                    <address class="ps-2">
                        {{ $company->site_name ?? '' }}<br />
                        {{ $company->address ?? '' }} <br>
                        {{ $company->site_email ?? '' }}
                    </address>
                </div>
            </td>
            <td style="width: 50%">
                <div> <strong>Invoiced To:</strong>
                    <address class="ps-2">
                        {{ $info->customer->first_name ?? '' }} {{ $info->customer->last_name ?? '' }}<br />
                        {{ $info->address ?? '' }}
                        <br>
                        {{ $info->customer->mobile_no ?? '' }}
                    </address>
                </div>
            </td>
        </tr>
    </table>
    
    <table class="item-table" style="width: 100%;margin-top:15px;">
        <tr style="">
            <th style="text-align: center"><strong>Description</strong></th>
            <th style="text-align: center"><strong>Qty</strong></th>
            <th style="text-align: center"><strong>Unit Price</strong></th>
            <th style="text-align: center"><strong>Discount</strong></th>
            <th style="text-align: center"><strong>Tax</strong></th>
            <th style="text-align: center"><strong>Amount USD</strong></th>
        </tr>
    
        @if( isset( $info->items ) && count($info->items) > 0 ) 
            @foreach ($info->items as $item)
            <tr>
                <td> {{ $item->product->product_name ?? '' }}</td>
                <td style="text-align: right">{{ $item->qty ?? '' }}</td>
                <td style="text-align: right">{{ $item->unit_price ?? '' }}</td>
                <td style="text-align: right">{{ $item->discount ?? '0' }}%</td>
                <td style="text-align: right">{{ $item->tax ?? '' }}</td>
                <td style="text-align: right">{{ $item->amount ?? '' }}</td>
            </tr> 
            @endforeach
        @endif
    </table>

    <table style="width: 100%;background:rgb(248, 248, 248);">
        <tr>
            <td style="width: 75%;text-align:right;padding:5px 0px;"><strong>Sub Total:</strong></td>
            <td style="width: 25%;text-align:right;padding:5px 0px;">${{ $info->subtotal ?? $info->total ?? '0.00' }}</td>
        </tr>
        <tr>
            <td style="width: 75%;text-align:right; padding:5px 0px;"><strong>Tax:</strong></td>
            <td style="width: 25%;text-align:right; padding:5px 0px">${{ $info->tax ?? '0.00' }}</td>
        </tr>
        <tr>
            <td style="width: 75%;text-align:right; padding:5px 0px;"><strong>Total:</strong></td>
            <td style="width: 25%;text-align:right; padding:5px 0px;">${{ $info->total }}</td>
        </tr>
    </table>
        
</main>