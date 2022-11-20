<div class="modal-dialog modal-right" style="width: 500px">
    <form  id="organizations-form" method="POST" action="{{ route('organizations.save', $companyCode) }}" autocomplete="off" class="modal-content h-100">
        <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div>
                <div class=" d-flex justify-content-center align-items-center h-100 p-3">
                    <div class="w-100" >
                        <div class=" m-0">
                            <div class="col-12" id="error">
                            </div>
                        </div>
                        {{-- if user login only then hide user dropdown, show only admin login --}}
                        @csrf
                        <input type="hidden" name="id" value="{{ $id ?? '' }}">
                        <input type="hidden" name="from" id="from" value="{{ $from ?? '' }}">
                        
                        <div class=" mb-3">
                            <label for="name" class=" col-form-label">Organization Name <span class="text-danger">*</span></label>
                            <div class="">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ $info->name ?? '' }}" required>
                            </div>
                        </div>
                    
                        <div class=" mb-3">
                            <label for="email" class="col-form-label"> Email</label>
                            <div class="">
                                <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="{{ $info->email ?? '' }}" >
                            </div>
                        </div>
                        <div class=" mb-3">
                            <label for="mobile_no" class="col-form-label">Mobile Number </label>
                            <div class="d-flex">
                                <select name="dial_code" id="dial_code" class="form-control w-25"> 
                                    @if( isset($country) && !empty( $country))
                                        @foreach ($country as $code)
                                            <option value="{{ $code->dial_code }}" @if( $code->dial_code == '+91' || $code->dial_code == $info->dial_code ) selected @endif>{{ $code->dial_code }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <input type="text" name="mobile_no" maxlength="10" class="form-control mobile" id="mobile_no" placeholder="Mobile Number" value="{{ $info->mobile_no ?? '' }}" >
                            </div>
                        </div>
                        <div class=" mb-3">
                            <label for="mobile_no" class="col-form-label"> Address </label>
                            <div class="">
                                <textarea name="address" id="address"  class="form-control" cols="30" s="3">{{ $info->address ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class=" mb-3">
                            <label for="description" class="col-form-label">Status</label>
                            <!-- Success Switch-->
                            <div class="">
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
        $("#organizations-form").validate({
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
                                window.location.href="{{ route('organizations', $companyCode) }}";
                            } else {
                                ReloadDataTableModal('organizations-datatable');
                            }
                            
                        }
                    }            
                });
            }
        });

        
</script>