<div class="modal-dialog modal-lg modal-right">
    <form id="users-form" method="POST" action="{{ route('users.save') }}" autocomplete="off" class="modal-content custom-content h-100" >
        <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body"  >
            <div class="row">
                <div class="col-12" id="error">
                </div>
            </div>
            <div>
                @csrf
                <div class="d-flex justify-content-center align-items-center h-100 p-3 ">
                    <div class="w-100">
                        <input type="hidden" name="id" value="{{ $id ?? '' }}">
                        <div class="mb-2">
                            <label for="name" class="col-form-label">First Name <span class="text-danger">*</span></label>
                            <div>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ $info->name ?? '' }}" required>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="last_name" class="col-form-label">Last Name </label>
                            <div>
                                <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" value="{{ $info->last_name ?? '' }}" >
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="email" class="col-form-label"> Email<span class="text-danger">*</span></label>
                            <div>
                                <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="{{ $info->email ?? '' }}" required>
                            </div>
                        </div>
                        
                        @if( empty($id))
                        <div class="mb-2">
                            <label for="password" class="col-form-label"> Password<span class="text-danger">*</span></label>
                            <div>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password" value="{{ $info->password ?? '' }}" required>
                            </div>
                        </div>
                        @endif
                        <div class="mb-2">
                            <label for="mobile_no" class="col-form-label">Mobile Number <span class="text-danger">*</span></label>
                            <div class="d-flex">
                                <select name="dial_code" id="dial_code" class="form-control text-center w-25">
                                    @if ( isset( $country ) && !empty( $country ) )
                                        @foreach ($country as $code )
                                            <option value="{{ $code->dial_code }}">{{ $code->dial_code }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <input type="text" maxlength="10" name="mobile_no" class="form-control mobile" id="mobile_no" placeholder="Mobile Number" value="{{ $info->mobile_no ?? '' }}" required>
                            </div>
                        </div>
                        
                        <div class="mb-2">
                            <label for="mobile_no" class="col-form-label">Role <span class="text-danger">*</span></label>
                            <div>
                                <select name="role_id" id="role_id" class="form-control" required>
                                    <option value="">--select--</option>
                                    @if( isset($roles) && !empty($roles))
                                        @foreach ($roles as $item)
                                            <option value="{{ $item->id }}" @if( isset($info->role_id) && $info->role_id == $item->id) selected @endif>{{ $item->role }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="lead_limit" class="col-form-label">Lead Limit </label>
                            <div>
                                <input type="number" name="lead_limit" class="form-control" id="lead_limit" placeholder="Lead limit" value="{{ $info->lead_limit ?? '' }}" required>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="deal_limit" class="col-form-label">Deal Limit </label>
                            <div>
                                <input type="number" name="deal_limit" class="form-control" id="deal_limit" placeholder="Deal limit" value="{{ $info->deal_limit ?? '' }}" required>
                            </div>
                        </div>

                        
                        <div class="mb-2 d-flex align-items-center">
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
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
            <button type="submit" class="btn btn-info" id="save">Save</button>
        </div>
    </form><!-- /.modal-content -->
</div>

<script>
        $("#users-form").validate({
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
                            ReloadDataTableModal('users-datatable');
                        }
                    }            
                });
            }
        });

        $('input.mobile' ).keypress(function(evt){
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
            // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9]|\./;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
            }
        })
</script>