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
                        <li class="breadcrumb-item active">Customers details</li>
                    </ol>
                </div>
                <h4 class="page-title">Customers</h4>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                
                <div class="card-body"> 
                    @include('crm.common.common_add_btn')

                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap" id="customer-datatable">
                            <thead class="table-light">
                                <tr>
                                    <th class="all" style="width: 20px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customCheck1">
                                            <label class="form-check-label" for="customCheck1">&nbsp;<label>
                                        </div>
                                    </th>
                                    <th class="all">First name</th>
                                    <th>Last name</th>
                                    <th>organization</th>
                                    <th>Status</th>
                                    <th style="width: 120px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="all" style="width: 20px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customCheck1">
                                            <label class="form-check-label" for="customCheck1">&nbsp;<label>
                                        </div>
                                    </th>
                                    <td>Mani</td>
                                    <td>Kannan</td>
                                    <td>Pixel studio</td>
                                    <td><div class="badge bg-success"> Active </div></td>
                                    <td>
                                        <a href="#" class="action-icon"><i class="mdi mdi-eye"></i></a>
                                        <a href="#" class="action-icon"><i class="mdi mdi-square-edit-outline"></i></a>
                                        <a href="#" class="action-icon"><i class="mdi mdi-delete"></i> </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="all" style="width: 20px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customCheck1">
                                            <label class="form-check-label" for="customCheck1">&nbsp;<label>
                                        </div>
                                    </th>
                                    <td>Prabhu</td>
                                    <td>Kannan</td>
                                    <td>Mj studio</td>
                                    <td><div class="badge bg-success"> Active </div></td>
                                    <td>
                                        <a href="#" class="action-icon"><i class="mdi mdi-eye"></i></a>
                                        <a href="#" class="action-icon"><i class="mdi mdi-square-edit-outline"></i></a>
                                        <a href="#" class="action-icon"><i class="mdi mdi-delete"></i> </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="all" style="width: 20px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customCheck1">
                                            <label class="form-check-label" for="customCheck1">&nbsp;<label>
                                        </div>
                                    </th>
                                    <td>Prabhu</td>
                                    <td>Kannan</td>
                                    <td>Mj studio</td>
                                    <td><div class="badge bg-danger"> Deactive </div></td>
                                    <td>
                                        <a href="#" class="action-icon"><i class="mdi mdi-eye"></i></a>
                                        <a href="#" class="action-icon"><i class="mdi mdi-square-edit-outline"></i></a>
                                        <a href="#" class="action-icon"><i class="mdi mdi-delete"></i> </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
               
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>
    </div> 
</div>
 

@endsection
 