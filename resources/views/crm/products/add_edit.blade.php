<div class="modal-dialog modal-lg modal-right">
    <form id="product-form" method="POST" action="{{ route('products.save') }}" autocomplete="off" class="modal-content h-100">
        <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-3" style="width: 400px">
            <div class="row">
                <div class="col-12" id="error">
                </div>
            </div>
            <div class="w-100" >
                @csrf
                <input type="hidden" name="id" value="{{ $id ?? '' }}">
                <input type="hidden" name="from" id="from" value="{{ $from ?? '' }}">
                <div class="mb-3">
                    <label for="product_name" class="col-form-label">Product Name <span class="text-danger">*</span></label>
                    <div>
                        <input type="text" name="product_name" id="product_name" class="form-control" value="{{ $info->product_name ?? '' }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="product_code" class="col-form-label">Product Code <span class="text-danger">*</span></label>
                    <div>
                        <input type="text" name="product_code" id="product_code" class="form-control" value="{{ $info->product_code ?? ($product_code ?? '') }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="hsn_no" class="col-form-label">HSN No <span class="text-danger">*</span></label>
                    <div>
                        <input type="text" name="hsn_no" id="hsn_no" class="form-control" value="{{ $info->hsn_no ?? '' }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-3">
                            <label for="">
                                CGST
                            </label>
                            <div>
                                <input type="text" name="cgst" value="{{ $info->cgst ?? '' }}" placeholder="CGST %" class="form-control">
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="">
                                SGST
                            </label>
                            <div>
                                <input type="text" name="sgst" value="{{ $info->sgst ?? '' }}"  placeholder="SGST %" class="form-control">
                            </div>
                        </div>
                        <div class="col-3">
                            <label for="">
                                IGST
                            </label>
                            <div>
                                <input type="text" name="igst" value="{{ $info->igst ?? '' }}"  placeholder="IGST %" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="col-form-label"> Description </label>
                    <div>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="3">{{ $info->description ?? '' }}</textarea>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="d-flex align-items-center">
                        <label for="description" class="col-form-label me-2">Status</label>
                        <!-- Success Switch-->
                        <div>
                            <input type="checkbox" name="status" id="switch3" {{ (isset($info->status) && $info->status == '1' )  ? 'checked' : ((isset($info->status) && $info->status == '0' ) ? '':'checked')}} data-switch="success"/>
                            <label for="switch3" data-on-label="" data-off-label=""></label>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
            <button type="submit" class="btn btn-info" id="save">Save</button>
        </div>
    </form>  
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
                            toastr.error('Error', response.error );
                        } else {
                            toastr.success('Success', response.error );
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