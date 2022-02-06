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
                    <div class="row mb-2">
                        <div class="col-sm-5">
                            <a href="#" class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#signup-modalz">
                                <i class="mdi mdi-plus-circle me-2"></i> Add 
                            </a>
                        </div>
                        <div class="col-sm-7">
                            <div class="text-sm-end"> 
                                <button type="button" class="btn btn-light mb-2">Export</button>
                            </div>
                        </div><!-- end col-->
                    </div>
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
 
<div id="signup-modalz" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"> 
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add Customer</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">                
                <form class="form-horizontal modal-body"> 
                    <div class="row mb-3">
                        <label for="name" class="col-3 col-form-label">First Name <span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="" required="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="last_name" class="col-3 col-form-label">Last Name <span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" value="" required="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-3 col-form-label"> Phone Number<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <div class="btn-group w-100 align-items-center">
                                <input type="text" name="email" class="form-control" id="email" placeholder="Phone Number" value="" required="">
                                <a href="#" class="action-icon btn btn-sm"><i class="mdi mdi-delete"></i> </a>
                            </div>
                            <div class="btn-group w-100 align-items-center mt-2">
                                <input type="text" name="email" class="form-control" id="email" placeholder="Phone Number" value="" required="">
                                <a href="#" class="action-icon btn btn-sm"><i class="mdi mdi-delete"></i> </a>
                            </div>
                            <div class="text-start mt-2">
                                <a href="#" class="link ">+ Add phone number</a>
                            </div>
                        </div>
                    </div>
                     <div class="row mb-3">
                        <label for="email" class="col-3 col-form-label"> Email<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <div class="btn-group w-100 align-items-center">
                                <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="" required="">
                                <a href="#" class="action-icon btn btn-sm"><i class="mdi mdi-delete"></i> </a>
                            </div>
                            <div class="btn-group w-100 align-items-center mt-2">
                                <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="" required="">
                                <a href="#" class="action-icon btn btn-sm"><i class="mdi mdi-delete"></i> </a>
                            </div>
                            <div class="text-start mt-2">
                                <a href="#" class="link ">+ Add email</a>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="mobile_no" class="col-3 col-form-label">Organization<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input list="Organization" name="browser" id="browser" class="form-control">
                            <datalist id="Organization">
                                <option value="Pixel Studio">
                                <option value="MK Studio">
                                <option value="RG Studio">
                                <option value="Ej Studio">
                            </datalist>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="mobile_no" class="col-3 col-form-label">Role<span class="text-danger">*</span></label>
                        <div class="col-9">
                            <input list="mobile_no" name="browser" id="browser" class="form-control">
                            <datalist id="mobile_no">
                                <option value="Admin">
                                <option value="User">
                            </datalist>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="description" class="col-3 col-form-label">Status</label>
                        <!-- Success Switch-->
                        <div class="col-9">
                            <input type="checkbox" name="status" id="switch3" data-switch="success">
                            <label for="switch3" data-on-label="" data-off-label=""></label>
                        </div>
                    </div>
                    
                    <div class=" row">
                        <div class="col-12 text-end">
                            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
                            <button type="submit" class="btn btn-success" id="save">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
 