<div class="modal-dialog modal-lg">
    
    <div class="modal-content h-100">
        <div class="modal-header px-3" id="myLargeModalLabel">
            <h4>{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="max-height: 95vh;overflow:auto">
            <style>
                #comment_list {
                    background: #e0f2f13b
                    padding: 14px;
                }
                div#comment_list {
                    max-height: 300px;
                    overflow: auto;
                    box-shadow: 1px 2px 3px 1px #ddd;
                }

                div#comment_list::-webkit-scrollbar {
                    width: 4px;
                }

                div#comment_list::-webkit-scrollbar-track {background: aquamarine;}

                div#comment_list::-webkit-scrollbar-thumb {
                    background: cadetblue;
                }
            </style> 
                <div class="modal-body d-flex justify-content-center align-items-center h-100 p-3">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-12" id="error"></div>
                        </div>
                        <div class="row">
                            <div class="col-5">
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
                       
                            <div class="card col-7">
                                <div class="card-body">
                                    <form action="{{ route('tasks.comment.save', $companyCode) }}" id="comment_form" method="POST">
                                        <input type="hidden" name="task_id" id="task_id" value="{{ $info->id }}">
                                        <div class="row">
                                            <div class="col-8">
                                                <input type="text" required class="form-control" placeholder="Add comment" id="comment" name="comment">
                                            </div>
                                            <div class="col-4">
                                                <button type="submit" class="btn btn-primary">Add Comment</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-12" id="comment_list">
                                </div>
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
<script>
    taskComment_list('{{ $info->id }}');
    $("#comment_form").validate({
            submitHandler:function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if( response.task_id ) {
                            toastr.success('Success', 'Added successfully' );
                            form.reset();
                            taskComment_list(response.task_id);
                        }
                        
                    }            
                });
            }
        });

        
</script>