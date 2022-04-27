@extends('crm.layouts.template')

@section('content')

<div class="container-fluid mt-3">
    <div class="row">
        <div class="card col-6 offset-3">

            <form class="form-horizontal modal-body" id="payments-form" method="POST" action="{{ route('payments.initiate.request') }}" autocomplete="off">
                @csrf
                <div class="col-12">
                    <div class="row mt-2">
                        <label for="name" class="col-3">Name</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="name"  name="name" required>
                        </div>
                        <input type="hidden" name="customer_id" id="customer_id" value={{ $customer_id ?? '' }}>
                        <input type="hidden" name="deal_id" id="deal_id" value={{ $deal_id ?? '' }}>
                    </div>
                    <div class="row mt-2">
                        <label for="email" class="col-3">Email</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="contact_no" class="col-3">Contact Number</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="contact_no" name="contact_no">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="address" class="col-3">Address</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <label for="amount" class="col-3">Amount</label>
                        <div class="col-9">
                            <input type="text" class="form-control price" id="amount" name="amount" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection