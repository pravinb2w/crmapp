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
                        <li class="breadcrumb-item active">Bulk Export</li>
                    </ol>
                </div>
                <h4 class="page-title">Bulk Export </h4>
            </div>
        </div>
    </div>     
    <div class="card">
        <div class="card-header bg-light">
            <h3 class="lead">Bulk PDF Export</h3>
        </div>
        <div class="card-body">
            <form action="">
                <div class="mb-3">
                    <strong class="mb-1">* Select Type </strong>
                    <select class="form-select">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="mb-3">
                    <strong class="mb-1">* From Date </strong>
                    <input type="date" name="" id="" class="form-control">
                </div>
                <div class="mb-3">
                    <strong class="mb-1">* To Date </strong>
                    <input type="date" name="" id="" class="form-control">
                </div>
                <div class="mb-3">
                    <input type="submit" value="Export" name="" id="" class="btn btn-primary">
                </div>
            </form>
        </div>
        <div class="card-footer bg-light">
            
        </div>
    </div>
</div>
@endsection