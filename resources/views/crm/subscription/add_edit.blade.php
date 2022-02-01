<style>
    .custom-check {
        padding: 5px 10px;
        position: absolute;
    }
</style>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12" id="error">
                </div>
            </div>
            <form class="form-horizontal modal-body" id="subscriptions-form" method="POST" action="{{ route('subscriptions.save') }}" autocomplete="off">
                @csrf
                <input type="hidden" name="id" value="{{ $id ?? '' }}">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="subscription_name" class="col-form-label">Subscription <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="text" name="subscription_name" class="form-control" id="subscription_name" placeholder="Subscription Name" value="{{ $info->subscription_name ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="subscription_period" class="col-form-label">Subscription Period <span class="text-danger">*</span></label>
                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                            <input type="number" name="subscription_period" class="form-control" id="subscription_period" placeholder="Subscription Period" value="{{ $info->subscription_name ?? '' }}" required>
                            <span class="input-group-append">
                                <select name="duration" id="duration" class="form-control">
                                    <option value="Y">Year</option>
                                    <option value="M">Month</option>
                                    <option value="D">Day</option>
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
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <label for="no_of_clients" class="col-form-label">Client <small class="text-muted"> (nos)  </small></label>
                        <div class="">
                            <input type="number" name="no_of_clients" class="form-control" id="no_of_clients" placeholder="0" value="{{ $info->no_of_clients ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="no_of_employees" class="col-form-label">Employees <small class="text-muted"> (nos)  </small></label>
                        <div class="">
                            <input type="number" name="no_of_employees" class="form-control" id="no_of_employees" placeholder="0" value="{{ $info->no_of_employees ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="no_of_leads" class="col-form-label">Leads <small class="text-muted"> (nos)  </small></label>
                        <div class="">
                            <input type="number" name="no_of_leads" class="form-control" id="no_of_leads" placeholder="0" value="{{ $info->no_of_leads ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="no_of_deals" class="col-form-label">Deals <small class="text-muted"> (nos)  </small></label>
                        <div class="">
                            <input type="number" name="no_of_deals" class="form-control" id="no_of_deals" placeholder="0" value="{{ $info->no_of_deals ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="no_of_pages" class="col-form-label">Pages <small class="text-muted"> (nos)  </small></label>
                        <div class="">
                            <input type="number" name="no_of_pages" class="form-control" id="no_of_pages" placeholder="0" value="{{ $info->no_of_pages ?? '' }}" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="no_of_email_templates" class="col-form-label">Email Template <small class="text-muted"> (nos)  </small></label>
                        <div class="">
                            <input type="number" name="no_of_email_templates" class="form-control" id="no_of_email_templates" placeholder="0" value="{{ $info->no_of_email_templates ?? '' }}" required>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-4">
                        <label for="role" class="col-form-label">Bulk Import </label>
                        <span class="custom-check">
                            <input type="checkbox" name="bulk_import" id="bulk_import" data-switch="warning"/>
                            <label for="bulk_import" data-on-label="Yes" data-off-label="No"></label>
                        </span>
                    </div>
                    <div class="col-4">
                        <label for="role" class="col-form-label">Database Backup </label>
                        <span class="custom-check">
                            <input type="checkbox" name="database_backup" id="database_backup" data-switch="warning"/>
                            <label for="database_backup" data-on-label="Yes" data-off-label="No"></label>
                        </span>
                    </div>
                    <div class="col-4">
                        <label for="role" class="col-form-label"> Work Automation </label>
                        <span class="custom-check">
                            <input type="checkbox" name="work_automation" id="work_automation" data-switch="warning"/>
                            <label for="work_automation" data-on-label="Yes" data-off-label="No"></label>
                        </span>
                    </div>
                    <div class="col-4">
                        <label for="role" class="col-form-label"> Telegram Bot </label>
                        <span class="custom-check">
                            <input type="checkbox" name="telegram_bot" id="telegram_bot" data-switch="warning"/>
                            <label for="telegram_bot" data-on-label="Yes" data-off-label="No"></label>
                        </span>
                    </div>
                    <div class="col-4">
                        <label for="role" class="col-form-label">Sms Integration </label>
                        <span class="custom-check">
                            <input type="checkbox" name="sms_integration" id="sms_integration" data-switch="warning"/>
                            <label for="sms_integration" data-on-label="Yes" data-off-label="No"></label>
                        </span>
                    </div>
                    <div class="col-4">
                        <label for="role" class="col-form-label"> Payment Gateway </label>
                        <span class="custom-check">
                            <input type="checkbox" name="payment_gateway" id="payment_gateway" data-switch="warning"/>
                            <label for="payment_gateway" data-on-label="Yes" data-off-label="No"></label>
                        </span>
                    </div>
                    <div class="col-4">
                        <label for="role" class="col-form-label"> Business Whatsapp </label>
                        <span class="custom-check">
                            <input type="checkbox" name="business_whatsapp" id="business_whatsapp" data-switch="warning"/>
                            <label for="business_whatsapp" data-on-label="Yes" data-off-label="No"></label>
                        </span>
                    </div>
                </div>
                
               <div class="row mb-3">
                    <label for="description" class="col-3 col-form-label">Status</label>
                    <!-- Success Switch-->
                    <div class="col-9">
                        <input type="checkbox" name="status" id="switch3" {{ (isset($info->status) && $info->status == '1' )  ? 'checked' : '' }} data-switch="success"/>
                        <label for="switch3" data-on-label="" data-off-label=""></label>
                    </div>
               </div>
                
                <div class=" row">
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-info" id="save">Save</button>
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
                    </div>
                </div>
            </form> 
        </div>
    </div><!-- /.modal-content -->
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
                            $('#error').addClass('alert alert-danger');
                            response.error.forEach(display_errors);
                        } else {
                            $('#error').addClass('alert alert-success');
                            response.error.forEach(display_errors);
                            setTimeout(function(){
                                $('#Mymodal').modal('hide');
                            },100);
                            ReloadDataTableModal('roles-datatable');
                        }
                    }            
                });
            }
        });

        
</script>