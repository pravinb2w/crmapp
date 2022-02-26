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
    {{-- <button class="btn btn-primary" type="submit">.ripple</button> --}}

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
 
    <!-- end row-->
    <div class="row" data-plugin="dragula" data-containers='["handle-dragula-left", "handle-dragula-right", "handle-dragula-bottom-left","handle-dragula-bottom-right"]' data-handleClass="dragula-handle">
        <div class="col-md-6" id="handle-dragula-left">
            <div class="bg-dragula card bg-white p-2 p-lg-4">
                <h5 class="mt-0">OPEN TASKS <span class="dragula-handle float-end"></span></h5>
                <div  class="py-2">
                    @for ($key = 0; $key<4; $key++)
                        <div class="card bg-light shadow-sm border mb-0 mt-2">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <img src="assets/images/users/avatar-{{ $key+1 }}.jpg" alt="image" class="me-3 d-none d-sm-block avatar-sm rounded-circle">
                                    <div class="w-100 overflow-hidden">
                                        <h5 class="mb-1 mt-1">Louis K. Bond</h5>
                                        <p class="mb-0"> Founder & CEO </p>
                                    </div> <!-- end w-100 --> 
                                </div> <!-- end d-flex -->
                            </div> <!-- end card-body -->
                        </div> <!-- end col -->  
                    @endfor
                </div> <!-- end company-list-1-->
            </div> <!-- end div.bg-light-->
        </div> <!-- end col -->
        <div class="col-md-6" id="handle-dragula-right">
            <div class="bg-dragula card bg-white p-2 p-lg-4">
                <h5 class="mt-0">TODAY TASKS <span class="dragula-handle float-end"></span></h5>
                <div  class="py-2">
                    @for ($key = 0; $key<4; $key++)
                        <div class="card bg-light shadow-sm border mb-0 mt-2">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <img src="assets/images/users/avatar-{{ $key+1 }}.jpg" alt="image" class="me-3 d-none d-sm-block avatar-sm rounded-circle">
                                    <div class="w-100 overflow-hidden">
                                        <h5 class="mb-1 mt-1">Louis K. Bond</h5>
                                        <p class="mb-0"> Founder & CEO </p>
                                    </div> <!-- end w-100 -->
                                    {{-- <span class="dragula-handle"></span> --}}
                                </div> <!-- end d-flex -->
                            </div> <!-- end card-body -->
                        </div> <!-- end col -->  
                    @endfor
                </div> <!-- end company-list-1-->
            </div> <!-- end div.bg-light-->
        </div> <!-- end col -->
        <div class="col-md-6" id="handle-dragula-bottom-left">
            <div class="bg-dragula card bg-white p-2 p-lg-4">
                <h5 class="mt-0">CLOSED TASKS <span class="dragula-handle float-end"></span></h5>
                <div  class="py-2">
                    @for ($key = 0; $key<4; $key++)
                        <div class="card bg-light shadow-sm border mb-0 mt-2">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <img src="assets/images/users/avatar-{{ $key+1 }}.jpg" alt="image" class="me-3 d-none d-sm-block avatar-sm rounded-circle">
                                    <div class="w-100 overflow-hidden">
                                        <h5 class="mb-1 mt-1">Louis K. Bond</h5>
                                        <p class="mb-0"> Founder & CEO </p>
                                    </div> <!-- end w-100 -->
                                    {{-- <span class="dragula-handle"></span> --}}
                                </div> <!-- end d-flex -->
                            </div> <!-- end card-body -->
                        </div> <!-- end col -->  
                    @endfor
                </div> <!-- end company-list-1-->
            </div> <!-- end div.bg-light-->
        </div> <!-- end col -->
        <div class="col-md-6" id="handle-dragula-bottom-right">
            <div class="bg-dragula card bg-white p-2 p-lg-4">
                <h5 class="mt-0">PLANED VS DONE <span class="dragula-handle float-end"></span></h5>
                <div  class="py-2">
                    @for ($key = 0; $key<4; $key++)
                        <div class="card bg-light shadow-sm border mb-0 mt-2">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <img src="assets/images/users/avatar-{{ $key+1 }}.jpg" alt="image" class="me-3 d-none d-sm-block avatar-sm rounded-circle">
                                    <div class="w-100 overflow-hidden">
                                        <h5 class="mb-1 mt-1">Louis K. Bond</h5>
                                        <p class="mb-0"> Founder & CEO </p>
                                    </div> <!-- end w-100 -->
                                    {{-- <span class="dragula-handle"></span> --}}
                                </div> <!-- end d-flex -->
                            </div> <!-- end card-body -->
                        </div> <!-- end col -->  
                    @endfor
                </div> <!-- end company-list-1-->
            </div> <!-- end div.bg-light-->
        </div> <!-- end col -->
    </div> <!-- end row -->
</div> 
@endsection

@section('add_on_script')
    <script src="{{ asset('assets/js/vendor/dragula.min.js') }}"></script>
    <script src="{{ asset('assets/js/ui/component.dragula.js') }}"></script>
@endsection