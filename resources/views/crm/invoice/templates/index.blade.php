@extends('crm.layouts.template')

@section('content')

<div class="container-fluid">
                        
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Invoice Template</li>
                    </ol>
                </div>
                <h4 class="page-title">Invoice Template</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <section>
        <form action="{{ route('invoices-templates') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="card border shadow-sm">
                        <div class="card-header bg-light">
                            <input required type="radio" style="transform: scale(1.5)" value="type_1" name="type" class="me-2 form-check-input" id="type_1">
                            <label  for="type_1"><b>Basic Info Invoice</b></label>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ asset('assets/images/invoice.png') }}" class="mx-auto border" style="height: 300px;object-fit:cover">
                        </div> 
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border shadow-sm">
                        <div class="card-header bg-light">
                            <input required type="radio" style="transform: scale(1.5)" value="type_2" name="type" class="me-2 form-check-input" id="type_2">
                            <label for="type_2"><b>Standard Invoice</b></label>
                        </div>
                        <div class="card-body text-center">
                            <img src="https://www.deskera.com/blog/content/images/2020/12/Commercial_Invoice--1-.png" class="mx-auto border" style="height: 300px;object-fit:cover">
                        </div> 
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border shadow-sm">
                        <div class="card-header bg-light">
                            <input required type="radio" style="transform: scale(1.5)" value="type_3" name="type" class="me-2 form-check-input" id="type_3">
                            <label for="type_3"><b>Info Invoice</b></label>
                        </div>
                        <div class="card-body text-center">
                            <img src="https://www.zoho.com/invoice/what-is-invoice/commercial-invoice.png" class="mx-auto border" style="height: 300px;object-fit:cover">
                        </div> 
                    </div>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Download PDF</button>
                </div>
            </div>
        </form>
    </section>  
</div>


@endsection 