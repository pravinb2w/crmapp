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
            <th>Deal Title</th>
            <th>Deal Value</th>
            <th>Current Stage</th>
            <th>Customer</th>
            <th>Assigned To</th>
            <th>Started At</th>
            <th>Status</th>
            <th>Expected Completed Date</th>
        </tr>
        @if( isset($deals) && !empty($deals))
            @foreach ($deals as $item)
            <tr>
                <td> {{ $item->deal_title }}  </td>
                <td> {{ $item->deal_value; }} </td>
                <td>{{ $item->current_stage->stages }}</td>
                <td> {{ $item->customer->first_name ?? '' }}</td>
                <td> {{ $item->assignedTo->name ?? '' }}</td>
                <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                <td>{{ ($item->status == 1 ) ? 'Active' : 'Inactive' }}</td>
                <td>{{ date('d-m-Y', strtotime($item->expected_completed_date)) }}</td>
            </tr>
            @endforeach
        @endif
    </table>
</body>
</html>