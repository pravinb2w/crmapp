@extends('crm.layouts.template')

@section('content')

<div class="container-fluid mt-3">
    <div class="row">
        <div class="card col-6 offset-3">
            <div class="col-12 text-center">
                <img src="{{asset('assets/images/payments/razor.png')}}" alt="" for="razor">
            </div>
            <div class="col-12 text-center">
                <div class="badge bg-success"> 
                    Payment Successfully Completed.
                </div>
                <div class="text-center mb-3 mt-3">
                    <a href="{{ route('payments', $companyCode) }}" class="btn btn-success"> Go to Payment List</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection