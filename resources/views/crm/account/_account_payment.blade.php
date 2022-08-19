<div class="row">
    <div class="col-12" id="error">
    </div>
</div>
<form class="form-horizontal account_form" enctype="multipart/form-data" id="company_setting_form">
    <input type="hidden" name="type" value="{{ $type ?? '' }}">

    <div class="text-end mb-3">
        <button id="addprefRow" type="button" class="btn btn-success">Add More</button>
        <button type="submit" class="btn btn-info">Update</button>
    </div>
    <table class="table table-bordered">
        <thead class="bg-light">
            <tr>
                <th>Payment Gateway</th>
                <th width="60px" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody  id="prefRow">            
            @if( isset( $gateway ) && !empty($gateway ))
            @php
                $iCount = 0;
            @endphp
                @foreach ($gateway as $item)
                    <tr id="inputFormRow" >
                        <td style="padding: 5px !important">
                            <div class="row ">
                                <div class="col-6">
                                    <label for="">Payment Gateway</label>
                                    <input type="hidden" name="id[]" value="{{ $item->id }}">
                                    <select name="payment_gateway[]" id="payment_gateway" class="form-control">
                                        <option value="">select</option>
                                        @if( config('constant.payment_gateway') )
                                            @foreach(config('constant.payment_gateway') as $gkey => $gvalue)
                                                <option value="{{ $gkey }}" @if($item->gateway == $gkey) selected @endif>{{ $gvalue }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="status" class="">Live Mode</label>
                                    <!-- Success Switch -->
                                    <div class="">
                                        <input type="checkbox" name="status[]" onchange="return showRadioHiddenInput(this, '{{ $iCount }}')" id="status_{{ $item->id }}" {{ (isset($item->enabled) && $item->enabled == 'on' )  ? 'checked' : ((isset($item->enabled) && $item->enabled == 'test' ) ? '':'checked')}} data-switch="success"/>
                                        <label for="status_{{ $item->id }}" data-on-label="" data-off-label=""></label>
                                        <input type="hidden" name="status[]" id="default_status_{{ $iCount }}" @if(isset($item->enabled) && $item->enabled != 'test' )) disabled @endif;" >
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="">Test Access Key</label>
                                    <div class="mt-1">
                                        <input type="text" name="test_merchant_id[]" id="test_merchant_id" value="{{ $item->test_merchant_id ?? '' }}" class="form-control" placeholder="Test Merchant Id">
                                    </div>
                                    <div class="mt-1">
                                        <input type="text" name="test_access_key[]" id="test_access_key" value="{{ $item->test_access_key ?? '' }}" class="form-control" placeholder="Test Access Key">
                                    </div>
                                    <div class="mt-1">
                                        <input type="text" name="test_secret_key[]" id="test_secret_key" value="{{ $item->test_secret_key ?? '' }}" class="form-control" placeholder="Test Secret Key">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="">Live Access Key</label>
                                    <div class="mt-1">
                                        <input type="text" name="live_merchant_id[]" id="live_merchant_id" value="{{ $item->live_merchant_id ?? '' }}" class="form-control" placeholder="Live Merchant Id">
                                    </div>
                                    <div class="mt-1">
                                        <input type="text" name="live_access_key[]" id="live_access_key" value="{{ $item->live_access_key ?? '' }}" class="form-control" placeholder="Live Access Key">
                                    </div>
                                    <div class="mt-1 mb-2">
                                        <input type="text" name="live_secret_key[]" id="live_secret_key" value="{{ $item->live_secret_key ?? '' }}" class="form-control" placeholder="Live Secret Key">
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center" style="padding: 0 !important;vertical-align: middle;"><button id="removeprefRow" type="button" class="btn btn-danger">Remove</button></td>
                    </tr> 
                    @php
                        $iCount++;
                    @endphp
                @endforeach
               
            @else
            <tr id="inputFormRow" >
                <td style="padding: 5px !important">
                    <div class="row ">
                        <div class="col-6">
                            <label for="">Payment Gateway</label>
                            <input type="text" name="payment_gateway[]" id="payment_gateway" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="status" class="">Live Mode</label>
                            <!-- Success Switch -->
                            <div class="">
                                <input type="checkbox" name="status[]" onchange="return showRadioHiddenInput(this, 0)" id="status" {{ (isset($info->status) && $info->status == '1' )  ? 'checked' : ((isset($info->status) && $info->status == '0' ) ? '':'checked')}} data-switch="success"/>
                                <label for="status" data-on-label="" data-off-label=""></label>
                                <input type="hidden" name="status[]" id="default_status_0" >

                            </div>
                        </div>
                        <div class="col-6">
                            <label for="">Test Access Key</label>
                            <div class="mt-1">
                                <input type="text" name="test_merchant_id[]" id="test_merchant_id" class="form-control" placeholder="Test Merchant Id">
                            </div>
                            <div class="mt-1">
                                <input type="text" name="test_access_key[]" id="test_access_key" class="form-control" placeholder="Test Access Key">
                            </div>
                            <div class="mt-1">
                                <input type="text" name="test_secret_key[]" id="test_secret_key" class="form-control" placeholder="Test Secret Key">
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="">Live Access Key</label>
                            <div class="mt-1">
                                <input type="text" name="live_merchant_id[]" id="live_merchant_id" class="form-control" placeholder="Live Merchant Id">
                            </div>
                            <div class="mt-1">
                                <input type="text" name="live_access_key[]" id="live_access_key" class="form-control" placeholder="Live Access Key">
                            </div>
                            <div class="mt-1 mb-2">
                                <input type="text" name="live_secret_key[]" id="live_secret_key" class="form-control" placeholder="Live Secret Key">
                            </div>
                        </div>
                    </div>
                </td>
                <td class="text-center" style="padding: 0 !important;vertical-align: middle;"><button id="removeprefRow" type="button" class="btn btn-danger">Remove</button></td>
            </tr>  
            @endif            
        </tbody>
    </table>

</form> 
@php
    $gateway = config('constant.payment_gateway');
@endphp

<script>
    function showRadioHiddenInput(value, count) {
        if( value.checked ) {
            $('#default_status_'+count).attr('disabled', true);
        } else {
            $('#default_status_'+count).attr('disabled', false);
        }
    }

var count = 0;
var payment_gateway = @json($gateway);
var keys = Object.keys(payment_gateway);
var op_pay = '';
if( payment_gateway ) {
    for (var i = 0, len = keys.length; i < len; i++) {
        op_pay += '<option value="'+keys[i]+'">'+payment_gateway[keys[i]]+'</option>';
    }
}
// console.log( JSON.parse(payment_gateway));
$("#addprefRow").click(function () {
    var html = '';
    html += '<div >';
    html += '<div class="input-group mb-3">';
    html += '';
    html += '>';
    html += '<div class="input-group-append">';
    html += '';
    html += '</div>';
    html += '</div>';
        count++;
    $('#prefRow').append(`
        <tr id="inputFormRow">
            <td style="padding: 5px !important">
                    <div class="row ">
                        <div class="col-6">
                            <label for="">Payment Gateway</label>
                            <select name="payment_gateway[]" id="payment_gateway" class="form-control">
                                <option value="">select</option>`+op_pay+`
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="status_`+count+`" class="">Live Mode</label>
                            <div class="">
                                <input type="checkbox" name="status[]" onchange="return showRadioHiddenInput(this, `+count+`)" id="status_`+count+`" {{ (isset($info->status) && $info->status == '1' )  ? 'checked' : ((isset($info->status) && $info->status == '0' ) ? '':'checked')}} data-switch="success"/>
                                <label for="status_`+count+`" data-on-label="" data-off-label=""></label>
                                <input type="hidden" name="status[]" id="default_status_`+count+`" >
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="">Test Access Key</label>
                            <div class="mt-1">
                                <input type="text" name="test_merchant_id[]" id="test_merchant_id" class="form-control" placeholder="Test Merchant Id">
                            </div>
                            <div class="mt-1">
                                <input type="text" name="test_access_key[]" id="test_access_key" class="form-control" placeholder="Test Access Key">
                            </div>
                            <div class="mt-1">
                                <input type="text" name="test_secret_key[]" id="test_secret_key" class="form-control" placeholder="Test Secret Key">
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="">Live Access Key</label>
                            <div class="mt-1">
                                <input type="text" name="live_merchant_id[]" id="live_merchant_id" class="form-control" placeholder="Live Merchant Id">
                            </div>
                            <div class="mt-1">
                                <input type="text" name="live_access_key[]" id="live_access_key" class="form-control" placeholder="Live Access Key">
                            </div>
                            <div class="mt-1 mb-2">
                                <input type="text" name="live_secret_key[]" id="live_secret_key" class="form-control" placeholder="Live Secret Key">
                            </div>
                        </div>
                    </div>
                </td>
            <td class="text-center" style="padding: 0 !important;vertical-align: middle;"><button id="removeprefRow" type="button" class="btn btn-danger">Remove</button></td>
        </tr>
    `);
});

// remove row
$(document).on('click', '#removeprefRow', function () {
    $(this).closest('#inputFormRow').remove();
});
    $('#company_setting_form').submit(function(e) {
        e.preventDefault();
       
        let formData = new FormData(this);
        $('#error').removeClass("alert alert-danger");
        $('#error').removeClass("alert alert-success");

        $.ajax({
            type:'POST',
            url: '{{ route("account.payment.save") }}',
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                if(response.error.length > 0 && response.status == "1" ) {
                    response.error.forEach(msg => toastr.error(msg) ); 
                } else {
                    response.error.forEach(msg => toastr.success(msg) ); 
                    setTimeout(function(){
                        get_settings_tab('payment');
                    },100);
                }
            },
        });
        return false;
    });
</script>