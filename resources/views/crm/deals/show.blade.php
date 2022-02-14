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
            <div class="row  ">
                <div class="col-md-6 mb-3">
                   <h3 class="h4 link"><a href="#" class="me-1">Praveen Phoenix Deal</a> <i class="mdi mdi-tag"></i></h3>
                    <div class="d-flex">
                        <div class="btn ps-0"><b class="h4">RS. 300</b></div>
                        <div class="btn link">5 Products</div>
                        <div class="btn"><i class="me-1 dripicons-user"></i> Praveen </div>
                        <div class="btn"><i class="me-1 mdi-office-building mdi"></i> Phoenix</div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="d-flex align-items-center justify-content-end">
                        <div class="dropdown me-2">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i style="font-size:20px" class="uill uil-user-circle me-1"></i> Praveen Paul Raj
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                        <div class="btn me-2 btn-success">Won</div>
                        <div class="btn  me-2 btn-danger">Loss</div>
                        <div class="dropdown  me-2">
                            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-table-large"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-2"> 
                    <div class="btn-group align-item-center p-1 w-100">
                        <span class="pipeline-btn py-0 btn text-white btn-light active"><small>0 days</small></span>
                        <span class="pipeline-btn py-0 btn text-white btn-light"></span>
                        <span class="pipeline-btn py-0 btn text-white btn-light"></span>
                        <span class="pipeline-btn py-0 btn text-white btn-light"></span>
                        <span class="pipeline-btn py-0 btn text-white btn-light"></span>
                    </div>
                </div>
            </div>
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