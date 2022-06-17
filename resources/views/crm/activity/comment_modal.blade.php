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
                            
                            <div class="row">
                                <div class="card col-12">
                                    <div class="card-body">
                                        <h4 style="text-transform: uppercase">{{ $info->subject }} : {{ $info->activity_type }}</h4>
                                        <form action="{{ route('activities.comment.save') }}" id="comment_form" method="POST">
                                            <input type="hidden" name="activity_id" id="activity_id" value="{{ $id }}">
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
    comment_list('{{ $id }}');
    $("#comment_form").validate({
            submitHandler:function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if( response.activity_id ) {
                            toastr.success('Success', 'Added successfully' );
                            form.reset();
                            comment_list(response.activity_id);
                        }
                        
                    }            
                });
            }
        });

        
</script>
