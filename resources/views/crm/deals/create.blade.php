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
                <h4 class="page-title">Create new deal </h4>
            </div>
        </div>
    </div>     
    <form action="">
        <div class="row">
            <div class="col-lg-6">
                <div class="row m-0">
                    <div class="col-md-12 mb-2">
                        <label for="" class="form-label">Contact person</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="dripicons-user"></i></div>
                            <input type="text" class="form-control" placeholder="Type here...">
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="" class="form-label">Organization</label>
                        <div class="input-group">
                            <div class="input-group-text"><i class="mdi-office-building mdi"></i></div>
                            <input type="text" class="form-control" placeholder="Type here...">
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="" class="form-label">Title</label>
                        <div class="input-group">
                            {{-- <div class="input-group-text"><i class="mdi-office-building mdi"></i></div> --}}
                            <input type="text" class="form-control" placeholder="Type here...">
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="" class="form-label">Value</label>
                        <input type="text" class="form-control" placeholder="Type here...">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="" class="form-label">Title</label>
                        <select name="" id="" class="form-select">
                            <option value="1">Rupees</option>
                            <option value="2">Dollers</option>
                        </select>
                        <div class="text-end pt-2">
                            <label for="no-need-products" class="link"><input type="checkbox" class="form-check-input me-1" name="" id="no-need-products"> Don't add products  </label>
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="" class="form-label">Pipeline</label>
                        <select name="" id="" class="form-select">
                            <option value="1">Pipeline</option>
                            <option value="2">Pipeline 2</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="" class="form-label">Pipeline stages</label>
                        <div class="btn-group p-1 w-100">
                            <i class="pipeline-btn btn btn-light active"></i>
                            <i class="pipeline-btn btn btn-light"></i>
                            <i class="pipeline-btn btn btn-light"></i>
                            <i class="pipeline-btn btn btn-light"></i>
                            <i class="pipeline-btn btn btn-light"></i>
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="" class="form-label">Expected Date</label>
                        <input type="date" name="" id="" class="form-control">
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="" class="form-label">Visible to</label>
                        <select name="" id="" class="form-select">
                            <option value="1">owner group</option>
                            <option value="2">employe group 2</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="col-md-12 mb-2 p-0">
                    <h5 class="h5">PERSON</h5>
                    <div id="phone-number-group"  class="group-scroll">
                        <div class="row m-0 mb-2">
                            <div class="col-md-6 p-0">
                                <label for="" class="form-label">Phone</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="dripicons-phone" style="transform: scaleX(-1)"></i></div>
                                    <input type="number" class="form-control" placeholder="Type here...">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="" style="opacity: 0" class="form-label">Phone</label>
                                <select name="" id="" class="form-select">
                                    <option value="1">Work</option>
                                    <option value="2">Home</option>
                                    <option value="3">Others</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="col-12 text-end pt-2">
                        <a id="add_phone" class="cursor link">+ Add Phone</a>
                    </div>
                </div>
                <div class="col-md-12 mb-2 p-0">
                    <div id="email-id-group" class="group-scroll">
                        <div class="row m-0 mb-2">
                            <div class="col-md-6 p-0">
                                <label for="" class="form-label">Email</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="dripicons-mail" ></i></div>
                                    <input type="number" class="form-control" placeholder="Type here...">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="" style="opacity: 0" class="form-label">Email</label>
                                <select name="" id="" class="form-select">
                                    <option value="1">Work</option>
                                    <option value="2">Home</option>
                                    <option value="3">Others</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="col-12 text-end pt-2">
                        <a id="add_email" class="cursor link">+ Add Email</a>
                    </div>
                </div>
                <div class="col-md-12">
                    <h5 class="h5">PRODUCTS</h5>
                    <div class="group-scroll-lg">
                        <table class="table border-less">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody id="products_items">
                                <tr>
                                    <td class="p-1" width="50%">
                                        <input type="text" class="form-control" name="" id="">
                                    </td>
                                    <td class="p-1">
                                        <input type="number" class="form-control" name="" id="">
                                    </td>
                                    <td class="p-1">
                                        <input type="number" class="form-control" name="" id="">
                                    </td>
                                    <td class="p-1" width="5%">
                                        <input type="number" disabled class="form-control" name="" id="">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1" width="50%">
                                        <input type="text" class="form-control" name="" id="">
                                    </td>
                                    <td class="p-1">
                                        <input type="number" class="form-control" name="" id="">
                                    </td>
                                    <td class="p-1">
                                        <input type="number" class="form-control" name="" id="">
                                    </td>
                                    <td class="p-1" width="5%">
                                        <input type="number" disabled class="form-control" name="" id="">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <a id="add_product_items" class="cursor link">+ Add onc more</a>
                </div>
            </div>
            <div class="col-12 text-end">
                <button class="btn btn-light me-2">cancel</button>
                <button class="btn btn-primary">Save</button>
            </div>
        </div> 
    </form> 
</div>


@endsection
@section('add_on_script')
    <script>
        $(document).ready(function(){
            $("#add_phone").click(function(){
                $("#phone-number-group").append(`
                    <div class="row m-0 mb-2">
                        <div class="col-md-6 p-0"> 
                            <div class="input-group">
                                <div class="input-group-text"><i class="dripicons-phone" style="transform: scaleX(-1)"></i></div>
                                <input type="number" class="form-control" placeholder="Type here...">
                            </div>
                        </div>
                        <div class="col-md-6"> 
                            <select name="" id="" class="form-select">
                                <option value="1">Work</option>
                                <option value="2">Home</option>
                                <option value="3">Others</option>
                            </select>
                        </div> 
                    </div>
                `);
            });
            $("#add_email").click(function(){
                $("#email-id-group").append(`
                    <div class="row m-0 mb-2">
                        <div class="col-md-6 p-0"> 
                            <div class="input-group">
                                <div class="input-group-text"><i class="dripicons-mail" ></i></div>
                                <input type="number" class="form-control" placeholder="Type here...">
                            </div>
                        </div>
                        <div class="col-md-6"> 
                            <select name="" id="" class="form-select">
                                <option value="1">Work</option>
                                <option value="2">Home</option>
                                <option value="3">Others</option>
                            </select>
                        </div> 
                    </div>
                `);
            });
            $("#add_product_items").click(function(){
                $("#products_items").append(`
                    <tr>
                        <td class="p-1" width="50%">
                            <input type="text" class="form-control" name="" id="">
                        </td>
                        <td class="p-1">
                            <input type="number" class="form-control" name="" id="">
                        </td>
                        <td class="p-1">
                            <input type="number" class="form-control" name="" id="">
                        </td>
                        <td class="p-1" width="5%">
                            <input type="number" disabled class="form-control" name="" id="">
                        </td>
                    </tr>
                `);
            });
        });
    </script>
@endsection