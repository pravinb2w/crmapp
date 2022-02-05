@extends('crm.layouts.template')

@section('content')
<div class="container-fluid">
                        
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Phoenix</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">CRM</li>
                    </ol>
                </div>
                <h4 class="page-title">CRM</h4>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card cta-box bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-center">
                        <div class="w-100 overflow-hidden">
                            <h2 class="mt-0"><i class="mdi mdi-bullhorn-outline"></i>&nbsp;</h2>
                            <h3 class="m-0 fw-normal cta-box-title">Welcome {{ Auth::user()->name }}</h3>
                        </div>
                        {{-- <img class="ms-3" src="assets/images/email-campaign.svg" width="120" alt="Generic placeholder image"> --}}
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card--> 
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="text-muted fw-normal mt-0 text-truncate" title="Total Tasks">Total Tasks</h5>
                            <h3 class="my-2 py-1">254</h3>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <div id="campaign-sent-chart" data-colors="#727cf5"></div>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="text-muted fw-normal mt-0 text-truncate" title="Total Open Tasks ">Total Open Tasks </h5>
                            <h3 class="my-2 py-1">34</h3>
                           
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <div id="new-leads-chart" data-colors="#0acf97"></div>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="text-muted fw-normal mt-0 text-truncate" title="Total Overdue Tasks">Overdue Tasks</h5>
                            <h3 class="my-2 py-1">861</h3> 
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <div id="Total Overdue Tasks-chart" data-colors="#727cf5"></div>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col --> 
    </div>
    <!-- end row -->
 

    <div class="row">
        <div class=" col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>
                    <h4 class="header-title mb-3">Open Tasks</h4>

                    <div class="table-responsive">
                        <table class="table table-striped table-sm table-nowrap table-centered mb-0">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Leads</th>
                                    <th>Total Overdue Tasks</th>
                                    <th>Tasks</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <h5 class="font-15 mb-1 fw-normal">Jeremy Young</h5>
                                        <span class="text-muted font-13">Senior Sales Executive</span>
                                    </td>
                                    <td>187</td>
                                    <td>154</td>
                                    <td>49</td>
                                    <td class="table-action">
                                        <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="font-15 mb-1 fw-normal">Thomas Krueger</h5>
                                        <span class="text-muted font-13">Senior Sales Executive</span>
                                    </td>
                                    <td>235</td>
                                    <td>127</td>
                                    <td>83</td>
                                    <td class="table-action">
                                        <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="font-15 mb-1 fw-normal">Pete Burdine</h5>
                                        <span class="text-muted font-13">Senior Sales Executive</span>
                                    </td>
                                    <td>365</td>
                                    <td>148</td>
                                    <td>62</td>
                                    <td class="table-action">
                                        <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="font-15 mb-1 fw-normal">Mary Nelson</h5>
                                        <span class="text-muted font-13">Senior Sales Executive</span>
                                    </td>
                                    <td>753</td>
                                    <td>159</td>
                                    <td>258</td>
                                    <td class="table-action">
                                        <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="font-15 mb-1 fw-normal">Kevin Grove</h5>
                                        <span class="text-muted font-13">Senior Sales Executive</span>
                                    </td>
                                    <td>458</td>
                                    <td>126</td>
                                    <td>73</td>
                                    <td class="table-action">
                                        <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
        <div class=" col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                        </div>
                    </div>
                    <h4 class="header-title mb-3">Today Tasks</h4>

                    <div class="table-responsive">
                        <table class="table table-striped table-sm table-nowrap table-centered mb-0">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Leads</th>
                                    <th>Total Overdue Tasks</th>
                                    <th>Tasks</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <h5 class="font-15 mb-1 fw-normal">Jeremy Young</h5>
                                        <span class="text-muted font-13">Senior Sales Executive</span>
                                    </td>
                                    <td>187</td>
                                    <td>154</td>
                                    <td>49</td>
                                    <td class="table-action">
                                        <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="font-15 mb-1 fw-normal">Thomas Krueger</h5>
                                        <span class="text-muted font-13">Senior Sales Executive</span>
                                    </td>
                                    <td>235</td>
                                    <td>127</td>
                                    <td>83</td>
                                    <td class="table-action">
                                        <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="font-15 mb-1 fw-normal">Pete Burdine</h5>
                                        <span class="text-muted font-13">Senior Sales Executive</span>
                                    </td>
                                    <td>365</td>
                                    <td>148</td>
                                    <td>62</td>
                                    <td class="table-action">
                                        <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="font-15 mb-1 fw-normal">Mary Nelson</h5>
                                        <span class="text-muted font-13">Senior Sales Executive</span>
                                    </td>
                                    <td>753</td>
                                    <td>159</td>
                                    <td>258</td>
                                    <td class="table-action">
                                        <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="font-15 mb-1 fw-normal">Kevin Grove</h5>
                                        <span class="text-muted font-13">Senior Sales Executive</span>
                                    </td>
                                    <td>458</td>
                                    <td>126</td>
                                    <td>73</td>
                                    <td class="table-action">
                                        <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
    </div>
    <!-- end row-->
    
</div> 
@endsection
