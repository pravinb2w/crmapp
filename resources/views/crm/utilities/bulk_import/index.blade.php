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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard', $companyCode) }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Bulk Import</li>
                    </ol>
                </div>
                <h4 class="page-title">Bulk Import </h4>
            </div>
        </div>
    </div>     
    <div class="card">
        <div class="card-header bg-light">
            <h3 class="lead">Bulk Import</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success mt-2">{{ Session::get('success') }} 
                        </div>
                    @endif
                </div>
                <div class="col-6">
                    <form action="{{ route('store.bulk_import', $companyCode) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <strong class="mb-1"> Customer Data File </strong>
                            <input type="file" name="excel_file" id="excel_file" >
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Import" name="" id="" class="btn btn-primary">
                        </div>
                    </form>
                </div>
                <div class="col-6">
                    <label for="">Sample Customer Data Excel file </label>
                    <span class="ml-3"> <a href="{{ asset('assets/bimport.xls') }}"> Click to Download Sample </a></span>
                    <div class="text-danger">
                        <small>( File should be excel. Excel format should be present same as sample document, other wise file will not be import, * If data contains duplicates it will insert, please check data before import )</small>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="card-footer bg-light">
            
        </div>
    </div>
</div>
@endsection