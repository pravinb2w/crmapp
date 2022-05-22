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
    <table class="item-table" border-spacing="0" style="width: 100%">
        <tr>
            <th>Deal </th>
            <th>Invoice</th>
            <th>Customer</th>
            <th>Due Date</th>
            <th>Amount</th>
        </tr>
        @if( isset($fore) && !empty($fore))
            @foreach ($fore as $inv)
            <tr>
                <td> {{ $inv->deal->deal_title ?? '' }}  </td>
                <td> {{ $inv->invoice_no ?? '' }}</td>
                <td>{{ $inv->customer->first_name ?? '' }}</td>
                <td> {{ $inv->due_date ?? '' }}</td>
                <td> {{ $inv->total ?? '' }}</td>
            </tr>
            @endforeach
        @endif
</table>
</body>
</html>