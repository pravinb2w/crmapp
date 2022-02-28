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
                        <li class="breadcrumb-item active">Deals</li>
                    </ol>
                </div>
                <h4 class="page-title">Overview deal </h4>
            </div>
        </div>
    </div>  

    <div class="row card p-4 mb-3">
        <div class="col-12">
            @include('crm.deals._pipeline_view')
        </div>
    </div>
    <div class="card shadow-sm">
        <ul class="nav nav-pills bg-nav-pills nav-justified custom">
            <li class="nav-item">
                <a href="#Notes" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active">
                    <i class="uil uil-pen"></i>
                    <span>Notes</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#Activity" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 ">
                    <i class="uil uil-user"></i>
                    <span >Activity</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#Propose" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                    <i class="uil  uil-schedule"></i>
                    <span>Propose times</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#Call" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                    <i class="uil uil-forwaded-call"></i>
                    <span>Call</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#Email" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0">
                    <i class="uil uil-envelope-alt"></i>
                    <span>Email</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#Files" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                    <i class="uil-files-landscapes-alt uil"></i>
                    <span>Files</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#Documents" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                    <i class="uil uil-file-alt"></i>
                    <span>Documents</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#Invoices" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                    <i class="uil uil-invoice"></i>
                    <span>Invoices</span>
                </a>
            </li>
        </ul>
        
        <div class="tab-content p-3">
            <div class="tab-pane active" id="Notes">
                <textarea name="" id="" cols="30" placeholder="Take a note's..." class="form-control" rows="10"></textarea>
            </div>
            <div class="tab-pane show" id="Activity">
                <p>Activity</p>
            </div>
            <div class="tab-pane" id="Propose">
                <p>Propose times</p>
            </div>
            <div class="tab-pane show" id="Call">
                <p>Call</p>
            </div>
            <div class="tab-pane" id="Email">
                <p>Email times</p>
            </div>
            <div class="tab-pane" id="Files">
                <p>Files</p>
            </div>
            <div class="tab-pane" id="Documents">
                <p>Documents times</p>
            </div>
            <div class="tab-pane" id="Invoices">
                <p>Invoices</p>
            </div>
        </div>
    </div>
</div>


@endsection 