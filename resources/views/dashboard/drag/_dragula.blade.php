<div class="row" data-drop="change_drop" data-plugin="dragula" data-containers='["handle-dragula-left", "handle-dragula-right", "handle-dragula-bottom-left","handle-dragula-bottom-right"]' data-handleClass="dragula-handle" 
    >
        
        <div class="col-lg-6 drop"  draggable="true" id="handle-dragula-{{ $mytask ?? 'left' }}" data-id="mytask"  >
            <div class="card">
                @include('dashboard._task_tab')
                <!-- end card-body -->
            </div>
            <!-- end card-->
        </div>
        
        <div class="col-md-6 px-1 drop" id="handle-dragula-{{ $closingweek ?? 'right' }}" data-id="closingweek">
            <div class="card">
                <div class="card-body">
                    @include('dashboard._close_week')
                </div>
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-lg-6" id="handle-dragula-{{ $alltask ?? 'bottom-left' }}" data-id="alltask">
            <div class="card">
                @include('dashboard._all_task_tab')
                <!-- end card-body -->
            </div>
            <!-- end card-->
        </div>

        <div class="col-md-6 px-1" id="handle-dragula-{{ $mytask ?? 'bottom-right' }}" data-id="planned">
            <div class="card">
                <div class="card-body">
                    @include('dashboard._planned_done')
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