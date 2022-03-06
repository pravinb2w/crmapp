<div class="modal-dialog modal-lg modal-right">
    <div class="modal-content h-100">
        <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="max-height: 95vh;overflow:auto">
            <div class="row">
                <div class="col-12" id="error">
                </div>
            </div>
            <form class="form-horizontal" id="product-form" method="POST" action="{{ route('products.save') }}" autocomplete="off">
                <div class="modal-body d-flex justify-content-center align-items-center h-100 p-3">
                    <div class="w-100" >
                        @csrf
                        <input type="hidden" name="id" value="{{ $id ?? '' }}">
                        <input type="hidden" name="from" id="from" value="{{ $from ?? '' }}">
                        <div class="row mb-3">
                            <label for="product_name" class="col-4 col-form-label">Product Name <span class="text-danger">*</span></label>
                            <div class="col-8">
                                <input type="text" name="product_name" id="product_name" class="form-control" value="{{ $info->product_name ?? '' }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="product_code" class="col-4 col-form-label">Product Code <span class="text-danger">*</span></label>
                            <div class="col-8">
                                <input type="text" name="product_code" id="product_code" class="form-control" value="{{ $info->product_code ?? ($product_code ?? '') }}" required>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="description" class="col-4 col-form-label"> Description </label>
                            <div class="col-8">
                                <textarea name="description" class="form-control" id="description" cols="30" rows="3">{{ $info->description ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-4 col-form-label">Status</label>
                            <!-- Success Switch-->
                            <div class="col-8">
                                <input type="checkbox" name="status" id="switch3" {{ (isset($info->status) && $info->status == '1' )  ? 'checked' : '' }} data-switch="success"/>
                                <label for="switch3" data-on-label="" data-off-label=""></label>
                            </div>
                        </div>
                        <div class=" row">
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
                                <button type="submit" class="btn btn-info" id="save">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form> 
        </div>
    </div><!-- /.modal-content -->
</div>

<script>
        $("#product-form").validate({
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
                            $('#error').addClass('alert alert-danger');
                            response.error.forEach(display_errors);
                        } else {
                            $('#error').addClass('alert alert-success');
                            response.error.forEach(display_errors);
                            setTimeout(function(){
                                $('#Mymodal').modal('hide');
                            },100);
                            if( from == 'dashboard' ) {
                                window.location.href="{{ route('products') }}";
                            } else {
                                ReloadDataTableModal('products-datatable');
                            }
                        }
                    }            
                });
            }
        });

        
</script>