<style>
    .custom-check {
        padding: 5px 10px;
        position: absolute;
    }
</style>
<div class="modal-dialog modal-xl modal-right">
    <form  id="subscriptions-form" method="POST" action="{{ route('subscriptions.save', $companyCode) }}" autocomplete="off" class="modal-content h-100">
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
                    <div class="col-sm-12">
                        @include('crm.subscription._count_fields')
                    </div>
                </div>
                <hr class="my-3">
                <div class="row m-0 ">
                    <div class="col-sm-12">
                        <label for="">Payment Gateway <span class="text-danger">*</span></label>
                        <div class="row">
                            @php
                                $payment_gateway = $info->payment_gateway ?? '';
                                if( !empty( $payment_gateway ) ) {
                                    $payment_gateway = explode(',', $payment_gateway );
                                }
                            @endphp
                            <div class="col-sm-4">
                                <label for="ccavenue">CCAvenue</label>
                                <input type="checkbox" name="payment_gateway[]" @if( isset($payment_gateway) && !empty($payment_gateway) && in_array( 'ccavenue', $payment_gateway ) ) checked @endif value="ccavenue" id="ccavenue" class="mx-2 mt-2">
                            </div>
                            <div class="col-sm-4">
                                <label for="razorpay">RazorPay</label>
                                <input type="checkbox" name="payment_gateway[]" @if( isset($payment_gateway) && !empty($payment_gateway) && in_array( 'razorpay', $payment_gateway ) ) checked @endif value="razorpay" id="razorpay" class="mx-2 mt-2">
                            </div>
                            <div class="col-sm-4">
                                <label for="payu">PayU</label>
                                <input type="checkbox" name="payment_gateway[]" @if( isset($payment_gateway) && !empty($payment_gateway) && in_array( 'payu', $payment_gateway ) ) checked @endif value="payu" id="payu" class="mx-2 mt-2">
                            </div>
                        </div>
                        
                    </div>
                </div>
                <hr class="my-3">
                <div class="row m-0 ">
                    <div class="col-3 p-2">
                        <div class="d-flex justify-content-between align-items-center p-1 px-2 rounded border">
                            <label for="role" class="col-form-label">Announcements </label>
                            <input type="checkbox" name="announcements" value="yes" id="announcements" @if( isset($info->announcements) && $info->announcements == 'yes' ) checked @endif data-switch="warning"/>
                            <label for="announcements" data-on-label="Yes" data-off-label="No"></label>
                        </div>
                    </div>
                    <div class="col-3 p-2">
                        <div class="d-flex justify-content-between align-items-center p-1 px-2 rounded border">
                            <label for="role" class="col-form-label">Bulk Upload </label>
                            <input type="checkbox" name="bulk_upload" value="yes" id="bulk_upload" @if( isset($info->bulk_upload) && $info->bulk_upload == 'yes' ) checked @endif data-switch="warning"/>
                            <label for="bulk_upload" data-on-label="Yes" data-off-label="No"></label>
                        </div>
                    </div>
                    
                    <div class="col-3 p-2">
                        <div class="d-flex justify-content-between align-items-center p-1 px-2 rounded border">
                            <label for="role" class="col-form-label"> WorkFlow Automation </label>
                            <input type="checkbox" name="work_automation" value="yes" id="work_automation"  @if( isset($info->work_automation) && $info->work_automation == 'yes' ) checked @endif  data-switch="warning"/>
                            <label for="work_automation" data-on-label="Yes" data-off-label="No"></label>
                        </div>
                    </div>
                    <div class="col-3 p-2">
                        <div class="d-flex justify-content-between align-items-center p-1 px-2 rounded border">
                            <label for="role" class="col-form-label"> Newsletter Subscription </label>
                            <input type="checkbox" name="newletter_subscriptions" value="yes" id="newletter_subscriptions" @if( isset($info->newletter_subscriptions) && $info->newletter_subscriptions == 'yes' ) checked @endif  data-switch="warning"/>
                            <label for="newletter_subscriptions" data-on-label="Yes" data-off-label="No"></label>
                        </div>
                    </div>
                    <div class="col-3 p-2">
                        <div class="d-flex justify-content-between align-items-center p-1 px-2 rounded border">
                            <label for="role" class="col-form-label"> Tasks </label>
                            <input type="checkbox" name="tasks" id="tasks" value="yes" @if( isset($info->tasks) && $info->tasks == 'yes' ) checked @endif  data-switch="warning"/>
                            <label for="tasks" data-on-label="Yes" data-off-label="No"></label>
                        </div>
                    </div>
                    <div class="col-3 p-2">
                        <div class="d-flex justify-content-between align-items-center p-1 px-2 rounded border">
                            <label for="role" class="col-form-label"> Activities </label>
                            <input type="checkbox" name="activities" id="activities" value="yes" @if( isset($info->activities) && $info->activities == 'yes' ) checked @endif  data-switch="warning"/>
                            <label for="activities" data-on-label="Yes" data-off-label="No"></label>
                        </div>
                    </div>
                    <div class="col-3 p-2">
                        <div class="d-flex justify-content-between align-items-center p-1 px-2 rounded border">
                            <label for="role" class="col-form-label"> Payment Tracking </label>
                            <input type="checkbox" name="payment_tracking" id="payment_tracking" value="yes" @if( isset($info->payment_tracking) && $info->payment_tracking == 'yes' )checked @endif  data-switch="warning"/>
                            <label for="payment_tracking" data-on-label="Yes" data-off-label="No"></label>
                        </div>
                    </div>
                    <div class="col-3 p-2">
                        <div class="d-flex justify-content-between align-items-center p-1 px-2 rounded border">
                            <label for="role" class="col-form-label"> Third Party Integration </label>
                            <input type="checkbox" name="thirdparty_integrations" id="thirdparty_integrations" value="yes" @if( isset($info->thirdparty_integrations) && $info->thirdparty_integrations == 'yes' ) checked @endif  data-switch="warning"/>
                            <label for="thirdparty_integrations" data-on-label="Yes" data-off-label="No"></label>
                        </div>
                    </div>
                    <div class="col-3 p-2">
                        <div class="d-flex justify-content-between align-items-center p-1 px-2 rounded border">
                            <label for="role" class="col-form-label"> Technical Support </label>
                            <input type="checkbox" name="technical_support" id="technical_support" value="yes" @if( isset($info->technical_support) && $info->technical_support == 'yes' ) checked @endif  data-switch="warning"/>
                            <label for="technical_support" data-on-label="Yes" data-off-label="No"></label>
                        </div>
                    </div>
                    <div class="col-3 p-2">
                        <div class="d-flex justify-content-between align-items-center p-1 px-2 rounded border">
                            <label for="role" class="col-form-label"> One Time Setup </label>
                            <input type="checkbox" name="onetime_setup" id="onetime_setup" value="yes" @if( isset($info->onetime_setup) && $info->onetime_setup == 'yes' ) checked @endif  data-switch="warning"/>
                            <label for="onetime_setup" data-on-label="Yes" data-off-label="No"></label>
                        </div>
                    </div>
                    <div class="col-3 p-2">
                        <div class="d-flex justify-content-between align-items-center p-1 px-2 rounded border">
                            <label for="role" class="col-form-label"> Server Procurement </label>
                            <input type="checkbox" name="server_procurement" id="server_procurement" value="yes" @if( isset($info->server_procurement) &&  $info->server_procurement == 'yes' ) checked @endif  data-switch="warning"/>
                            <label for="server_procurement" data-on-label="Yes" data-off-label="No"></label>
                        </div>
                    </div>
                    
                    <div class="col-3 p-2">
                        <div class="d-flex justify-content-between align-items-center p-1 px-2 rounded border">
                            <label for="role" class="col-form-label"> Predefined Configurations </label>
                            <input type="checkbox" name="predefined_configurations" id="predefined_configurations" value="yes"  @if( isset($info->predefined_configurations) && $info->predefined_configurations == 'yes' ) checked @endif  data-switch="warning"/>
                            <label for="predefined_configurations" data-on-label="Yes" data-off-label="No"></label>
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