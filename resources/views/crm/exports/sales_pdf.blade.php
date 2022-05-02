<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <style>
        <style>
    .item-table {
    width: 100%;
    margin-bottom: 1.5rem;
    color: #6c757d;
    vertical-align: top;
    border-color: #eef2f7;
    border-collapse: collapse;
}

.item-table tr td {
    border-bottom-width: 1px; 
    border: 1px solid #6c757d;
    font-size:14px;

}
.item-table tr th {
    background:lightgray;color:black;
    font-size:14px;
    border: 1px solid #6c757d;
}
.item-table > :not(:first-child) {
    border-top: 2px solid #edeff1;
}
    </style>
    <table class="item-table" border-spacing="0">
        <tr>
            <th>Payment Date</th>
            <th>Payment Mode</th>
            <th>Customer</th>
            <th>Deal</th>
            <th>Order Id</th>
            <th>Currency</th>
            <th>Amount</th>
            <th>Payment Method</th>
            <th>Cheque No</th>
            <th>Cheque Date</th>
            <th>Reference No</th>
            <th>Payment Status</th>
            <th>Description</th>
        </tr>
        @if( isset($deals) && !empty($deals))
        @foreach ($deals as $pay)
        <tr>
            <td> {{ date('d-m-Y', strtotime($pay->created_at)) }}  </td>
            <td> {{ ucwords($pay->payment_mode) }}</td>
            <td>{{ $pay->customer->first_name ?? ''; }}</td>
            <td> {{ '' }}</td>
            <td> {{ $pay->order_id ?? '' }}</td>
            <td>{{ $pay->currency ?? '' }}</td>
            <td>{{ $pay->amount ?? '' }}</td>
            <td>{{ ucfirst($pay->payment_method) }}</td>
            <td>{{ $pay->cheque_no ?? '' }}</td>
            <td>{{ $pay->cheque_date ?? '' }}</td>
            <td>{{ $pay->reference_no ?? '' }}</td>
            <td>{{ ucfirst($pay->payment_status) }}</td>
            <td>{{ $pay->description ?? '' }}</td>
        </tr>
        @endforeach
    @endif
    </table>
</body>
</html>