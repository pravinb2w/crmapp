<div class="modal-dialog modal-md">
    
    <div class="modal-content h-100">
        <div class="modal-header px-3" id="myLargeModalLabel">
            <h4>{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="max-height: 95vh;overflow:auto">

                <div class="modal-body d-flex justify-content-center align-items-center h-100 p-3">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-12" id="error"></div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th  class="table-light">Task</th>
                                            <td>{{ $info->task_name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th  class="table-light">Assigned</th>
                                            <td>{{ $info->assigned->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th  class="table-light">Description</th>
                                            <td>{{ $info->description ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th  class="table-light">Assigned Date</th>
                                            <td>{{ date('d-m-Y H:i A', strtotime($info->created_at ) ) ?? ''; }}</td>
                                        </tr>
                                        <tr>
                                            <th  class="table-light"> Task Status </th>
                                            <td>
                                                @php
                                                    if( isset($info->status) && $info->status == 1) {
                                                        $class = 'success';
                                                        $status = 'Active';
                                                        
                                                    } else if( isset($info->status) && $info->status == 2) {
                                                        $class = 'primary';
                                                        $status = 'Completed';
                                                    } else {
                                                        $class = 'danger';
                                                        $status = 'Inactive';
                                                    }
                                                @endphp
                                                <span class="badge bg-{{ $class }}"> {{ $status }}</span>
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        
                        <div class="col-md-12 mb-3 text-end">
                            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Close</button>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div><!-- /.modal-content -->
</div>
