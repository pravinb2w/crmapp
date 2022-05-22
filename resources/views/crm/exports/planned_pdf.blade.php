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
            <th>Title </th>
        <th>Type</th>
        <th>Customer</th>
        <th>User</th>
        <th>Lead / Deal </th>
        <th>Assigned Date</th>
        <th>Status</th>
        </tr>
        @if( isset($list) && !empty($list))
            @foreach ($list as $inv)
            <tr>
                <td> {{ $inv['title'] }}  </td>
                <td> {{ $inv['type'] }}</td>
                <td>{{ $inv['customer'] }}</td>
                <td> {{ $inv['user']; }}</td>
                <td> {{ $inv['lead_deal'] }}</td>
                <td> {{  $inv['assigned_date'] }}</td>
                <td> {{  $inv['status'] }}</td>
            </tr>
            @endforeach
        @endif
</table>
</body>
</html>