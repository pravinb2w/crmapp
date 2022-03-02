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
        <div class="col-md-6 px-1 col-xl-3">
            <div class="card shadow-sm" style="background:linear-gradient(-30deg, #6AD5E6,#B1ECEC)">
                <div class="card-body p-2 d-flex flex-x"> 
                    <div>
                        <h3 class="mt-0">254</h3> 
                        <h5 class="m-0 text-dark" title="Total Tasks">Open Tasks</h5>
                    </div>
                    <div>
                        <i class="mdi-clipboard-check-multiple mdi text-white fa-2x float-end"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 px-1 col-xl-3">
            <div class="card shadow-sm" style="background:linear-gradient(-30deg, #6AD5E6,#B1ECEC)">
                <div class="card-body p-2 d-flex flex-x"> 
                    <div>
                        <h3 class="mt-0">254</h3> 
                        <h5 class="m-0 text-dark" title="Total Tasks">Today Tasks</h5>
                    </div>
                    <div>
                        <i class="mdi-clipboard-check-multiple mdi text-white fa-2x float-end"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 px-1 col-xl-3">
            <div class="card shadow-sm" style="background:linear-gradient(-30deg, #6AD5E6,#B1ECEC)">
                <div class="card-body p-2 d-flex flex-x"> 
                    <div>
                        <h3 class="mt-0">254</h3> 
                        <h5 class="m-0 text-dark" title="Total Tasks">Closed Tasks</h5>
                    </div>
                    <div>
                        <i class="mdi-clipboard-check-multiple mdi text-white fa-2x float-end"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 px-1 col-xl-3">
            <div class="card shadow-sm" style="background:linear-gradient(-30deg, #6AD5E6,#B1ECEC)">
                <div class="card-body p-2 d-flex flex-x"> 
                    <div>
                        <h3 class="mt-0">254</h3> 
                        <h5 class="m-0 text-dark" title="Total Tasks">Planed Tasks</h5>
                    </div>
                    <div>
                        <i class="mdi-clipboard-check-multiple mdi text-white fa-2x float-end"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row --> 
 
    <!-- end row-->
    <div class="row" data-plugin="dragula" data-containers='["handle-dragula-left", "handle-dragula-right", "handle-dragula-bottom-left","handle-dragula-bottom-right"]' data-handleClass="dragula-handle">
        <div class="col-md-6 px-1" id="handle-dragula-left">
            <div class="list-group border shadow mb-3">
                <h5  href="#" class="list-group-item list-group-item-action border-bottom bg-light d-flex align-items-center justify-content-between m-0" aria-current="true">
                    OPEN TASKS <span class="dragula-handle float-end"></span>
                </h5>
                <div class="task-scroll">
                    @for ($key = 0; $key<10; $key++)
                        <a class="d-flex align-items-center border-bottom list-group-item list-group-item-action">
                            <div class="w-100 overflow-hidden">
                                <h5 class="text-secondary mb-1">March moth Logs</h5>
                                <p class="mb-0"> SIM softwares Supports Dec to Jan</p>
                            </div> <!-- end w-100 --> 
                            <div>
                                <small class="text-success">31/03/2022</small>
                            </div>
                        </a>  
                    @endfor    
                </div> 
            </div>
        </div> <!-- end col -->
        <div class="col-md-6 px-1" id="handle-dragula-right">
            <div class="list-group border shadow mb-3">
                <h5  href="#" class="list-group-item list-group-item-action border-bottom bg-light d-flex align-items-center justify-content-between m-0" aria-current="true">
                    TODAY TASKS <span class="dragula-handle float-end"></span>
                </h5>
                <div class="task-scroll">
                    @for ($key = 0; $key<10; $key++)
                        <a class="d-flex align-items-center border-bottom list-group-item list-group-item-action">
                            <div class="w-100 overflow-hidden">
                                <h5 class="text-secondary mb-1">March moth Logs</h5>
                                <p class="mb-0"> SIM softwares Supports Dec to Jan</p>
                            </div> <!-- end w-100 --> 
                            <div>
                                <small class="text-success">31/03/2022</small>
                            </div>
                        </a>  
                    @endfor    
                </div> 
            </div>
        </div> <!-- end col -->
        <div class="col-md-6 px-1" id="handle-dragula-bottom-left">
            <div class="list-group border shadow mb-3">
                <h5  href="#" class="list-group-item list-group-item-action border-bottom bg-light d-flex align-items-center justify-content-between m-0" aria-current="true">
                    CLOSED TASKS <span class="dragula-handle float-end"></span>
                </h5>
                <div class="task-scroll">
                    @for ($key = 0; $key<10; $key++)
                        <a class="d-flex align-items-center border-bottom list-group-item list-group-item-action">
                            <div class="w-100 overflow-hidden">
                                <h5 class="text-secondary mb-1">March moth Logs</h5>
                                <p class="mb-0"> SIM softwares Supports Dec to Jan</p>
                            </div> <!-- end w-100 --> 
                            <div>
                                <small class="text-success">31/03/2022</small>
                            </div>
                        </a>  
                    @endfor    
                </div> 
            </div>
        </div> <!-- end col -->
        <div class="col-md-6 px-1" id="handle-dragula-bottom-right">
            <div class="list-group border shadow mb-3">
                <h5  href="#" class="list-group-item list-group-item-action border-bottom bg-light d-flex align-items-center justify-content-between m-0" aria-current="true">
                    PLANED VS DONE <span class="dragula-handle float-end"></span>
                </h5>
                <div class="task-scroll">
                    @for ($key = 0; $key<10; $key++)
                        <a class="d-flex align-items-center border-bottom list-group-item list-group-item-action">
                            <div class="w-100 overflow-hidden">
                                <h5 class="text-secondary mb-1">March moth Logs</h5>
                                <p class="mb-0"> SIM softwares Supports Dec to Jan</p>
                            </div> <!-- end w-100 --> 
                            <div>
                                <small class="text-success">31/03/2022</small>
                            </div>
                        </a>  
                    @endfor    
                </div> 
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div> 
@endsection

@section('add_on_script')
    <script src="{{ asset('assets/js/vendor/dragula.min.js') }}"></script>
    <script src="{{ asset('assets/js/ui/component.dragula.js') }}"></script>
@endsection