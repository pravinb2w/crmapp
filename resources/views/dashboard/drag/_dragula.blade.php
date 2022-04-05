<div class="row" data-drop="change_drop" data-plugin="dragula" data-containers='["handle-dragula-left", "handle-dragula-right", "handle-dragula-bottom-left","handle-dragula-bottom-right"]' data-handleClass="dragula-handle" 
    >
        
        <div class="col-lg-6 drop"  draggable="true" id="handle-dragula-{{ $mytask ?? 'left' }}" data-id="mytask"  >
            <div class="card">
                <div class="card-body task-pane">
                    <div class="dropdown float-end">
                        <a href="#" class=" arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                            <small>See All </small>
                        </a>
                        <span class="dragula-handle float-end"></span>
                    </div>
                    <h4 class="header-title mb-3">My Task</h4>
        
                    <div class="d-flex align-items-start">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-warning-lighten float-end">Cold lead</span>
                            <h5 class="mt-0 mb-0">Risa Pearson</h5>
                            <span class="font-13">richard.john@mail.com</span>
                        </div>
                    </div>
        
                    <div class="d-flex align-items-start mt-3">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-danger-lighten float-end">Lost lead</span>
                            <h5 class="mt-0 mb-0">Margaret D. Evans</h5>
                            <span class="font-13">margaret.evans@rhyta.com</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mt-3">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-danger-lighten float-end">Lost lead</span>
                            <h5 class="mt-0 mb-0">Margaret D. Evans</h5>
                            <span class="font-13">margaret.evans@rhyta.com</span>
                        </div>
                    </div><div class="d-flex align-items-start mt-3">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-danger-lighten float-end">Lost lead</span>
                            <h5 class="mt-0 mb-0">Margaret D. Evans</h5>
                            <span class="font-13">margaret.evans@rhyta.com</span>
                        </div>
                    </div><div class="d-flex align-items-start mt-3">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-danger-lighten float-end">Lost lead</span>
                            <h5 class="mt-0 mb-0">Margaret D. Evans</h5>
                            <span class="font-13">margaret.evans@rhyta.com</span>
                        </div>
                    </div><div class="d-flex align-items-start mt-3">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-danger-lighten float-end">Lost lead</span>
                            <h5 class="mt-0 mb-0">Margaret D. Evans</h5>
                            <span class="font-13">margaret.evans@rhyta.com</span>
                        </div>
                    </div><div class="d-flex align-items-start mt-3">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-danger-lighten float-end">Lost lead</span>
                            <h5 class="mt-0 mb-0">Margaret D. Evans</h5>
                            <span class="font-13">margaret.evans@rhyta.com</span>
                        </div>
                    </div><div class="d-flex align-items-start mt-3">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-danger-lighten float-end">Lost lead</span>
                            <h5 class="mt-0 mb-0">Margaret D. Evans</h5>
                            <span class="font-13">margaret.evans@rhyta.com</span>
                        </div>
                    </div>
        
                    <div class="d-flex align-items-start mt-3">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-success-lighten float-end">Won lead</span>
                            <h5 class="mt-0 mb-0">Bryan J. Luellen</h5>
                            <span class="font-13">bryuellen@dayrep.com</span>
                        </div>
                    </div>
        
                    <div class="d-flex align-items-start mt-3">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-warning-lighten float-end">Cold lead</span>
                            <h5 class="mt-0 mb-0">Kathryn S. Collier</h5>
                            <span class="font-13">collier@jourrapide.com</span>
                        </div>
                    </div>
        
                    <div class="d-flex align-items-start mt-3">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-warning-lighten float-end">Cold lead</span>
                            <h5 class="mt-0 mb-0">Timothy Kauper</h5>
                            <span class="font-13">thykauper@rhyta.com</span>
                        </div>
                    </div>
        
                    <div class="d-flex align-items-start mt-3">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-success-lighten float-end">Won lead</span>
                            <h5 class="mt-0 mb-0">Zara Raws</h5>
                            <span class="font-13">austin@dayrep.com</span>
                        </div>
                    </div>
                        
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card-->
        </div>
        
        <div class="col-md-6 px-1 drop" id="handle-dragula-{{ $closingweek ?? 'right' }}" data-id="closingweek">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title"> Closing of the Week <span class="dragula-handle float-end"></span></h4>
                    <select name="" id="" class="bar-select">
                        <option value="">-select -</option>
                        <option value="tasks"> Planned</option>
                        <option value="leads"> Done </option>
                    </select>
                    <div dir="ltr">
                        <div id="basic-column" class="apex-charts" data-colors="#727cf5,#0acf97,#fa5c7c"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-lg-6" id="handle-dragula-{{ $alltask ?? 'bottom-left' }}" data-id="alltask">
            <div class="card">
                <div class="card-body task-pane">
                    <div class="dropdown float-end">
                        <select name="" id="" class="bar-select mb-2" style="top: 0;">
                            <option value="">All</option>
                            <option value="">Overdue</option>
                            <option value="">Recent</option>
                            <option value="">Overdue</option>
                            <option value="">Cancelled</option>

                        </select>
                        <span class="dragula-handle float-end"></span>
                    </div>
                    <h4 class="header-title mb-3">All Task</h4>
        
                    <div class="d-flex align-items-start">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-warning-lighten float-end">Cold lead</span>
                            <h5 class="mt-0 mb-0">Risa Pearson</h5>
                            <span class="font-11">richard.john@mail.com</span>
                        </div>
                    </div>
        
                    <div class="d-flex align-items-start mt-2">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-danger-lighten float-end">Lost lead</span>
                            <h5 class="mt-0 mb-0">Margaret D. Evans</h5>
                            <span class="font-13">margaret.evans@rhyta.com</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-start mt-2">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-danger-lighten float-end">Lost lead</span>
                            <h5 class="mt-0 mb-0">Margaret D. Evans</h5>
                            <span class="font-13">margaret.evans@rhyta.com</span>
                        </div>
                    </div><div class="d-flex align-items-start mt-2">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-danger-lighten float-end">Lost lead</span>
                            <h5 class="mt-0 mb-0">Margaret D. Evans</h5>
                            <span class="font-13">margaret.evans@rhyta.com</span>
                        </div>
                    </div><div class="d-flex align-items-start mt-2">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-danger-lighten float-end">Lost lead</span>
                            <h5 class="mt-0 mb-0">Margaret D. Evans</h5>
                            <span class="font-13">margaret.evans@rhyta.com</span>
                        </div>
                    </div><div class="d-flex align-items-start mt-2">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-danger-lighten float-end">Lost lead</span>
                            <h5 class="mt-0 mb-0">Margaret D. Evans</h5>
                            <span class="font-13">margaret.evans@rhyta.com</span>
                        </div>
                    </div><div class="d-flex align-items-start mt-2">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-danger-lighten float-end">Lost lead</span>
                            <h5 class="mt-0 mb-0">Margaret D. Evans</h5>
                            <span class="font-13">margaret.evans@rhyta.com</span>
                        </div>
                    </div><div class="d-flex align-items-start mt-2">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-danger-lighten float-end">Lost lead</span>
                            <h5 class="mt-0 mb-0">Margaret D. Evans</h5>
                            <span class="font-13">margaret.evans@rhyta.com</span>
                        </div>
                    </div>
        
                    <div class="d-flex align-items-start mt-2">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-success-lighten float-end">Won lead</span>
                            <h5 class="mt-0 mb-0">Bryan J. Luellen</h5>
                            <span class="font-13">bryuellen@dayrep.com</span>
                        </div>
                    </div>
        
                    <div class="d-flex align-items-start mt-2">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-warning-lighten float-end">Cold lead</span>
                            <h5 class="mt-0 mb-0">Kathryn S. Collier</h5>
                            <span class="font-13">collier@jourrapide.com</span>
                        </div>
                    </div>
        
                    <div class="d-flex align-items-start mt-2">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-warning-lighten float-end">Cold lead</span>
                            <h5 class="mt-0 mb-0">Timothy Kauper</h5>
                            <span class="font-13">thykauper@rhyta.com</span>
                        </div>
                    </div>
        
                    <div class="d-flex align-items-start mt-2">
                        <div class="w-100 overflow-hidden">
                            <span class="badge badge-success-lighten float-end">Won lead</span>
                            <h5 class="mt-0 mb-0">Zara Raws</h5>
                            <span class="font-13">austin@dayrep.com</span>
                        </div>
                    </div>
                        
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card-->
        </div>
        

        <div class="col-md-6 px-1" id="handle-dragula-{{ $mytask ?? 'bottom-right' }}" data-id="planned">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Planned vs Done <span class="dragula-handle float-end"></span></h4>
                    <select name="" id="" class="bar-select">
                        <option value="Leads">Leads</option>
                        <option value="tasks"> Collection</option>
                        <option value="leads"> Tasks </option>
                    </select>
                    <div dir="ltr">
                       <div id="high-performing-product" class="apex-charts" data-colors="#727cf5,#e3eaef"></div>
                    </div>
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
        
    </div> <!-- end row -->
    <script>
        function change_drop() {
            alert('teste');
        }
    </script>