@extends('crm.layouts.template')

@section('content')

<div class="container-fluid mt-3">
    <div class="row">
        <div class="card col-6 offset-3">
            <div class="col-12 text-center">
                <img src="{{asset('assets/images/payments/razor.png')}}" alt="" for="razor">
            </div>
            <form class="form-horizontal modal-body" id="payments-form" method="POST" action="{{ route('payments.initiate.request', $companyCode) }}" autocomplete="off">
                @csrf
                
                <div class="col-12">
                    <div class="row mt-2 text-center">
                        <label for="email" class="col-5 text-end">TXNno</label>
                        <div class="col-6 text-start">
                            {{ $txn_no }}
                            <input type="hidden" class="form-control" id="txn_no" name="txn_no" value="{{ $txn_no }}">
                        </div>
                    </div>
                    <div class="row mt-2 text-center">
                        <label for="name" class="col-5 text-end">Name</label>
                        <div class="col-6 text-start">
                            {{ $info->customer->first_name }}
                            <input type="hidden" class="form-control" id="name" name="name" value="{{ $info->customer->first_name }}">

                        </div>
                        <input type="hidden" name="customer_id" id="customer_id" value={{ $customer_id ?? '' }}>
                        <input type="hidden" name="invoice_id" id="invoice_id" value={{ $invoice_id ?? '' }}>
                    </div>
                    <div class="row mt-2 text-center">
                        <label for="email" class="col-5 text-end">Email</label>
                        <div class="col-6 text-start">
                            {{ $info->customer->email }}
                            <input type="hidden" name="email" id="email" value="{{ $info->customer->email }}">
                        </div>
                    </div>
                    <div class="row mt-2 text-center">
                        <label for="contact_no" class="col-5 text-end">Contact Number</label>
                        <div class="col-6 text-start">
                            {{ $info->customer->mobile_no }}
                            <input type="hidden" name="contact_no" id="contact_no" value="{{ $info->customer->mobile_no }}">
                        </div>
                    </div>
                    <div class="row mt-2 text-center">
                        <label for="address" class="col-5 text-end">Address</label>
                        <div class="col-6 text-start">
                            <input type="hidden" class="form-control" id="address" name="address" value="{{ $info->address }}">
                        </div>
                    </div>
                    <div class="row mt-2 mb-2 text-center">
                        <label for="amount" class="col-5 text-end">Amount</label>
                        <div class="col-6 text-start">
                            {{ $info->total }}
                            <input type="hidden" class="form-control price" id="amount" name="amount" value="{{ $info->total }}" onkeypress="return isNumberKey(this, event);" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 text-center mt-3">
                            <button type="submit" class="btn btn-primary">Proceed</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function isNumberKey(txt, evt) {
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode == 46) {
        //Check if the text already contains the . character
        if (txt.value.indexOf('.') === -1) {
          return true;
        } else {
          return false;
        }
      } else {
        if (charCode > 31 &&
          (charCode < 48 || charCode > 57))
          return false;
      }
      return true;
    }
</script>
@endsection