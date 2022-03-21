<style>
    .custom-check {
        padding: 5px 10px;
        position: absolute;
    }
</style>
<div class="modal-dialog modal-lg modal-right">
    <form  id="subscriptions-form" method="POST" action="{{ route('subscriptions.save') }}" autocomplete="off" class="modal-content h-100">
        <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row m-0">
                <div class="col-12" id="error">
                </div>
            </div>
            
                @csrf
                <input type="hidden" name="id" value="{{ $id ?? '' }}">
                <div class="row m-0  ">
                    <div class="col-sm-4">
                        <label for="subscription_name" class="col-form-label">Subscription <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="text" name="subscription_name" class="form-control" id="subscription_name" placeholder="Subscription Name" value="{{ $info->subscription_name ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="subscription_period" class="col-form-label">Subscription Period <span class="text-danger">*</span></label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected border rounded">
                            @php
                                $duration = '';
                            @endphp
                            @if( isset( $info->subscription_period ) && !empty($info->subscription_period)) 
                                @php
                                    $period = explode("-",$info->subscription_period);
                                    $subscription_period = $period[0];
                                    $duration = end($period);
                                @endphp
                            @endif
                            <input type="number" name="subscription_period" class="form-control border-0" id="subscription_period" placeholder="Subscription Period" value="{{ $subscription_period ?? '' }}" required>
                            <span class="input-group-append border-start">
                                <select name="duration" id="duration" class="form-select border-0">
                                    <option value="Y" @if($duration == 'Y') selected @endif>Year</option>
                                    <option value="M" @if($duration == 'M') selected @endif>Month</option>
                                    <option value="D" @if($duration == 'D') selected @endif>Day</option>
                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="amount" class="col-form-label">Amont <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="number" name="amount" class="form-control" id="amount" placeholder="Amount" value="{{ $info->amount ?? '' }}" required>
                        </div>
                    </div>
                </div>
                <hr class="my-3">
                <div class="row m-0 ">
                    <div class="col-sm-4 my-1">
                        <label for="no_of_clients" class="col-form-label">Client <small class="text-muted"> (nos)  </small></label>
                        <div class="">
                            <input type="number" name="no_of_clients" class="form-control" id="no_of_clients" placeholder="0" value="{{ $info->no_of_clients ?? '' }}" >
                        </div>
                    </div>
                    <div class="col-sm-4 my-1">
                        <label for="no_of_employees" class="col-form-label">Employees <small class="text-muted"> (nos)  </small></label>
                        <div class="">
                            <input type="number" name="no_of_employees" class="form-control" id="no_of_employees" placeholder="0" value="{{ $info->no_of_employees ?? '' }}" >
                        </div>
                    </div>
                    <div class="col-sm-4 my-1">
                        <label for="no_of_leads" class="col-form-label">Leads <small class="text-muted"> (nos)  </small></label>
                        <div class="">
                            <input type="number" name="no_of_leads" class="form-control" id="no_of_leads" placeholder="0" value="{{ $info->no_of_leads ?? '' }}" >
                        </div>
                    </div>
                    <div class="col-sm-4 my-1">
                        <label for="no_of_deals" class="col-form-label">Deals <small class="text-muted"> (nos)  </small></label>
                        <div class="">
                            <input type="number" name="no_of_deals" class="form-control" id="no_of_deals" placeholder="0" value="{{ $info->no_of_deals ?? '' }}" >
                        </div>
                    </div>
                    <div class="col-sm-4 my-1">
                        <label for="no_of_pages" class="col-form-label">Pages <small class="text-muted"> (nos)  </small></label>
                        <div class="">
                            <input type="number" name="no_of_pages" class="form-control" id="no_of_pages" placeholder="0" value="{{ $info->no_of_pages ?? '' }}" >
                        </div>
                    </div>
                    <div class="col-sm-4 my-1">
                        <label for="no_of_email_templates" class="col-form-label">Email Template <small class="text-muted"> (nos)  </small></label>
                        <div class="">
                            <input type="number" name="no_of_email_templates" class="form-control" id="no_of_email_templates" placeholder="0" value="{{ $info->no_of_email_templates ?? '' }}" >
                        </div>
                    </div>
                </div>
                <hr class="my-3">
                <div class="row m-0 ">
                    <div class="col-4 p-2">
                        <div class="d-flex justify-content-between align-items-center p-1 px-2 rounded border">
                            <label for="role" class="col-form-label">Bulk Import </label>
                            <input type="checkbox" name="bulk_import" id="bulk_import" @if( isset($info->bulk_import) && !empty($info->bulk_import) ) checked @endif data-switch="warning"/>
                            <label for="bulk_import" data-on-label="Yes" data-off-label="No"></label>
                        </div>
                    </div>
                    <div class="col-4 p-2">
                        <div class="d-flex justify-content-between align-items-center p-1 px-2 rounded border">
                            <label for="role" class="col-form-label">Database Backup </label>
                            <input type="checkbox" name="database_backup" id="database_backup"  @if( isset($info->database_backup) && !empty($info->database_backup)) checked @endif  data-switch="warning"/>
                            <label for="database_backup" data-on-label="Yes" data-off-label="No"></label>
                        </div>
                    </div>
                    <div class="col-4 p-2">
                        <div class="d-flex justify-content-between align-items-center p-1 px-2 rounded border">
                            <label for="role" class="col-form-label"> Work Automation </label>
                            <input type="checkbox" name="work_automation" id="work_automation"  @if( isset($info->work_automation) && !empty($info->work_automation) ) checked @endif  data-switch="warning"/>
                            <label for="work_automation" data-on-label="Yes" data-off-label="No"></label>
                        </div>
                    </div>
                    <div class="col-4 p-2">
                        <div class="d-flex justify-content-between align-items-center p-1 px-2 rounded border">
                            <label for="role" class="col-form-label"> Telegram Bot </label>
                            <input type="checkbox" name="telegram_bot" id="telegram_bot" @if( isset($info->telegram_bot) && !empty($info->telegram_bot) ) checked @endif  data-switch="warning"/>
                            <label for="telegram_bot" data-on-label="Yes" data-off-label="No"></label>
                        </div>
                    </div>
                    <div class="col-4 p-2">
                        <div class="d-flex justify-content-between align-items-center p-1 px-2 rounded border">
                            <label for="role" class="col-form-label">Sms Integration </label>
                            <input type="checkbox" name="sms_integration" id="sms_integration" @if( isset($info->sms_integration) && ($info->sms_integration) ) checked @endif  data-switch="warning"/>
                            <label for="sms_integration" data-on-label="Yes" data-off-label="No"></label>
                        </div>
                    </div>
                    <div class="col-4 p-2">
                        <div class="d-flex justify-content-between align-items-center p-1 px-2 rounded border">
                            <label for="role" class="col-form-label"> Payment Gateway </label>
                            <input type="checkbox" name="payment_gateway" id="payment_gateway" @if( isset($info->payment_gateway) && ($info->payment_gateway))checked @endif  data-switch="warning"/>
                            <label for="payment_gateway" data-on-label="Yes" data-off-label="No"></label>
                        </div>
                    </div>
                    <div class="col-4 p-2">
                        <div class="d-flex justify-content-between align-items-center p-1 px-2 rounded border">
                            <label for="role" class="col-form-label"> Business Whatsapp </label>
                            <input type="checkbox" name="business_whatsapp" id="business_whatsapp" @if( isset($info->business_whatsapp) && !empty($info->business_whatsapp) ) checked @endif  data-switch="warning"/>
                            <label for="business_whatsapp" data-on-label="Yes" data-off-label="No"></label>
                        </div>
                    </div>
                </div>
                
               <div class="d-flex align-items-center m-0 mb-3 p-2">
                    <label for="description" class="  col-form-label me-2">Status</label>
                    <!-- Success Switch-->
                    <input type="checkbox" name="status" id="switch3" {{ (isset($info->status) && $info->status == '1' )  ? 'checked' : ((isset($info->status) && $info->status == '0' ) ? '':'checked')}} data-switch="success"/>
                    <label for="switch3" data-on-label="" data-off-label=""></label>
               </div> 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
            <button type="submit" class="btn btn-info" id="save">Save</button>
        </div>
    </form><!-- /.modal-content -->
</div>

<script>
        $("#subscriptions-form").validate({
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
                            ReloadDataTableModal('subscriptions-datatable');
                        }
                    }            
                });
            }
        });

        
</script>