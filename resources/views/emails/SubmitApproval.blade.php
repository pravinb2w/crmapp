@component('mail::message')
<h2>Hello {{$body['name']}},</h2>

<div style="width: 100%;display:inline-flex">
    <div style="width: 50%">
        @if( isset($body['company']->site_logo) && !empty($body['company']->site_logo))
        <img id="logo" style="width: 250px" src="{{ asset('storage/'.$body['company']->site_logo) }}" title="Phoneix" alt="Phoneix" />
        @else
        <img id="logo" style="width: 250px" src="{{ asset('assets/images/logo/logo-color.png') }}" title="Phoneix" alt="Phoneix" /> 
        @endif</div>
    <div style="width:50%;text-align:right;font-size:11px;">
        <h4 class="text-7 mb-0">Invoice</h4>
        <strong>Invoice No:</strong> {{ $body['info']->invoice_no ?? '' }}
    </div>
</div>
<hr>
<div style="width: 100%;display:inline-flex">
    <div style="width: 50%;font-size:11px;">
        <div><strong>Date:</strong> {{ date('d/m/Y', strtotime($body['info']->created_at)) }}</div>
        <div><strong>Issued:</strong> {{ date('d/m/Y', strtotime($body['info']->issue_date)) }}</div>
    </div>
    <div style="width:50%;text-align:right;font-size:11px;">
        <div><strong>Due Date:</strong> {{ date('d/m/Y', strtotime($body['info']->due_date)) }} </div>
    </div>
</div>
<hr>
<div style="width: 100%;display:inline-flex">
    <div style="width: 50%;font-size:11px;">
        <div  > <strong>Pay To:</strong>
            <address class="ps-2">
                {{ $body['company']->site_name ?? '' }}<br />
                {{ $body['company']->address ?? '' }} <br>
                {{ $body['company']->site_email ?? '' }}
            </address>
        </div>
    </div>
    <div style="width:50%;text-align:left;font-size:11px;">
        <div> <strong>Invoiced To:</strong>
            <address class="ps-2">
                {{ $body['info']->customer->first_name ?? '' }} {{ $body['info']->customer->last_name ?? '' }}<br />
                {{ $body['info']->address ?? '' }}
                <br>
                {{ $body['info']->customer->mobile_no ?? '' }}
            </address>
        </div>
    </div>
</div>
<br>
<table class="item-table" style="width: 100%;margin-top:15px;">
    <tr style="">
        <th style="text-align: center;font-size:11px;width:30%">
            <strong>Description</strong>
        </th>
        <th style="text-align: center;font-size:11px;width:10%">
            <strong>Qty</strong>
        </th>
        <th style="text-align: center;font-size:11px;width:20%">
            <strong>Unit Price</strong>
        </th>
        <th style="text-align: center;font-size:11px;width:10%">
            <strong>Discount</strong>
        </th>
        <th style="text-align: center;font-size:11px;width:10%">
            <strong>Tax</strong>
        </th>
        <th style="text-align: center;font-size:11px;width:20%">
            <strong>Amount USD</strong>
        </th>
    </tr>
</table>
@if( isset( $body['info']->items ) && count($body['info']->items) > 0 ) 
@foreach ($body['info']->items as $item)
<table style="width: 100%;">
    <tr>
        <td style="text-align: center;font-size:11px;width:30%"> 
            {{ $item->product->product_name ?? '' }}
        </td>
        <td style="text-align: right;font-size:11px;width:10%">
            {{ $item->qty ?? '' }}
        </td>
        <td style="text-align: right;font-size:11px;width:20%">
            {{ $item->unit_price ?? '' }}
        </td>
        <td style="text-align: right;font-size:11px;width:10%">
            {{ $item->discount ?? '0' }}%
        </td>
        <td style="text-align: right;font-size:11px;width:10%">
            {{ $item->tax ?? '' }}
        </td>
        <td style="text-align: right;font-size:11px;width:20%">
            {{ $item->amount ?? '' }}
        </td>
    </tr> 
</table>
            
@endforeach
@endif
<table style="width: 100%;background:rgb(248, 248, 248);font-size:12px;">
    <tr>
        <td style="width: 75%;text-align:right;padding:5px 0px;">
            <strong>
                Sub Total:
            </strong>
        </td>
        <td style="width: 25%;text-align:right;padding:5px 0px;">
            ${{ $body['info']->subtotal ?? $body['info']->total ?? '0.00' }}
        </td>
    </tr>
    <tr>
        <td style="width: 75%;text-align:right; padding:5px 0px;">
            <strong>
                Tax:
            </strong>
        </td>
        <td style="width: 25%;text-align:right; padding:5px 0px">
            ${{ $body['info']->tax ?? '0.00' }}
        </td>
    </tr>
    <tr>
        <td style="width: 75%;text-align:right; padding:5px 0px;">
            <strong>
                Total:
            </strong>
        </td>
        <td style="width: 25%;text-align:right; padding:5px 0px;">
            ${{ $body['info']->total }}
        </td>
    </tr>
</table>
<div style="width:100%;display:inline-flex;text-align:center">
   <div style="margin-right:20px;">
        @component('mail::button', ['url' => $body['url_a'], 'color' => 'success'])
        Approve
        @endcomponent
   </div>
   <div>
        @component('mail::button', ['url' => $body['url_b']])
        Reject
        @endcomponent
   </div>
</div>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
