<div class="modal-dialog modal-md modal-right">
    <form class="modal-content h-100" id="csubscription-form" method="POST" action="{{ route('company-subscriptions.save') }}" autocomplete="off">
        <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div  class="modal-body" style="width: 400px">
            <div class="row">
                <div class="col-12" id="error">
                </div>
            </div>
         
                @csrf
                <input type="hidden" name="id" value="{{ $id ?? '' }}">
                <div class="mb-3">
                    <label for="subscription_id" class="col-form-label">Subscription <span class="text-danger">*</span></label>
                    <div>
                        <select name="subscription_id" id="subscription_id" class="form-control" required>
                            <option value="">--Select--</option>
                            @if(isset($subscriptions) && !empty($subscriptions))
                                @foreach ($subscriptions as $item)
                                    <option value="{{ $item->id }}" @if(isset($info->subscription_id) && $info->subscription_id == $item->id) selected @endif>{{ $item->subscription_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="company_id" class="col-form-label">Company <span class="text-danger">*</span></label>
                    <div>
                        <select name="company_id" id="company_id" class="form-control" required>
                            <option value="">--Select--</option>
                            @if(isset($company) && !empty($company))
                                @foreach ($company as $item)
                                    <option value="{{ $item->id }}"  @if(isset($info->company_id) && $info->company_id == $item->id) selected @endif>{{ $item->site_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
               
                <div class="mb-3 position-relative" id="datepicker4">
                    <label class="form-label col-4">Start Date <span class="text-danger">*</span></label>
                    <div>
                        <input type="text" required name="start_date" id="start_date" class="form-control datepicker w-100" value="<?= isset($info->startAt) ? date('d-m-Y', strtotime($info->startAt)): ''?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="total_amount" class="col-form-label">Total Amount <span class="text-danger">*</span></label>
                    <!-- Success Switch-->
                    <div>
                        <input type="text" name="total_amount" id="total_amount" value="{{ $info->total_amount ?? '' }}" class="form-control" required/>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description" class="col-form-label">Description</label>
                    <!-- Success Switch-->
                    <div>
                        <textarea name="description" class="form-control" id="description" cols="30" rows="3">{{ $info->description ?? '' }}</textarea>
                    </div>
                </div>
                <div class="mb-3 d-flex align-items-center">
                    <label for="status" class="col-form-label me-2">Status</label>
                    <!-- Success Switch-->
                    <div>
                        <input type="checkbox" name="status" id="switch3" {{ (isset($info->status) && $info->status == '1' )  ? 'checked' : ((isset($info->status) && $info->status == '0' ) ? '':'checked')}} data-switch="success"/>
                        <label for="switch3" data-on-label="" data-off-label=""></label>
                    </div>
                </div> 
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
            <button type="submit" class="btn btn-info" id="save">Save</button>
        </div>
    </form><!-- /.modal-content -->
</div>

<script>
        $("#csubscription-form").validate({
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
                        $('#save').html('Save');
                        if(response.error.length > 0 && response.status == "1" ) {
                            toastr.error('Error', response.error );
                        } else {
                            toastr.success('Success', response.error );
                            setTimeout(function(){
                                $('#Mymodal').modal('hide');
                            },100);
                            ReloadDataTableModal('company-subscriptions-datatable');
                        }
                    }            
                });
            }
        });

        $(function(){
            $('.datepicker').datepicker({
                format: 'dd-mm-yyyy',
                // endDate: '+0d',
                autoclose: true
            });
        }); 
</script>