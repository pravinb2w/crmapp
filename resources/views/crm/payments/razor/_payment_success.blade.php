@extends('crm.layouts.template')

@section('content')

<div class="container-fluid">
    <div>Success Payment</div>
    <div>
        <a href="{{ route('payments') }}" class="btn btn-success">Go To Payment List</a>
    </div>
</div>

@endsection