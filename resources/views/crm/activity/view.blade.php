<div class="modal-dialog modal-lg">
    
    <div class="modal-content h-100">
        <div class="modal-header px-3" id="myLargeModalLabel">
            <h4>{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="max-height: 95vh;overflow:auto">
            <style>
                #comment_list {
                    background: azure;
                    padding: 14px;
                }
                div#comment_list {
                    max-height: 300px;
                    overflow: auto;
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
                            <div class="col-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Type</th>
                                            <th>Started At</th>
                                            <th>Due At</th>
                                            <th>Customer</th>
                                            <th>Notes</th>
                                            <th> Lead / Deal </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $info->subject ?? '' }}</td>
                                            <td>{{ $info->activity_type ?? '' }}</td>
                                            <td>  {{ date('d M, Y H:i A', strtotime($info->started_at)) }} </td>
                                            <td> {{ date('d M, Y H:i A', strtotime($info->due_at)) }} </td>
                                            <td>{{ $info->customer->first_name ?? 'N/A' }}</td>
                                            <td> {{ $info->notes ?? 'N/A' }} </td>
                                            <td> {{ $info->deal->deal_title ?? $info->lead->lead_subject  ?? 'N/A' }} </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="card col-12">
                                    <div class="card-body">
                                        <form action="{{ route('activities.comment.save') }}" id="comment_form" method="POST">
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
                                </div>
                                <div class="col-12" id="comment_list">
                                    <table class="table">
                                        <tr>
                                            <td colspan="2">
                                               No comments
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="col-md-12 mt-3 mb-3 text-end">
                                <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Close</button>
                            </div>
                        </div>  
                    </div>
                </div>
            </form>
        </div>
    </div><!-- /.modal-content -->
</div>
<script>
    $("#comment_form").validate({
            submitHandler:function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    beforeSend: function() {
                        $('#error').removeClass('alert alert-danger');
                        $('#error').html('');
                        $('#error').removeClass('alert alert-success');
                        $('#save').html('Loading...');
                    },
                    success: function(response) {
                        var from = $('#from').val();
                        $('#save').html('Save');
                        if(response.error.length > 0 && response.status == "1" ) {
                            toastr.error('Error', response.error );
                        } else {
                            toastr.success('Success', response.error );
                        }
                    }            
                });
            }
        });
</script>
