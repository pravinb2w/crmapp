<div class="modal-dialog modal-lg modal-right">
    <style>
        #main-product-tab {
            height: 208px;
            overflow: auto;
        }
    </style>
    <form id="deals-form" method="POST" action="{{ route('deals.save', $companyCode) }}" autocomplete="off" class="modal-content h-100">
        <div class="modal-header px-3" id="myLargeModalLabel">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div> 
        @csrf
        <div class="modal-body d-flex justify-content-center p-3">
            <div class="w-100 h-100">
                <div class="row">
                    <div class="col-12" id="error"></div>
                </div>
                <div class="row">
                    <input type="hidden" name="id" value="{{ $id ?? '' }}">
                    <input type="hidden" name="from" id="from" value="{{ $from ?? '' }}">
                    <input type="hidden" name="lead_id" value="{{ $lead_id ?? '' }}"> 
                    <div class="form-group">
                        <span><i class="dripicons-user"></i></span>
                        <label for="name" class="col-form-label">Customer <span class="text-danger">*</span></label>                   
                        <input type="text" name="customer" id="customer" class="form-control" required value="{{ $lead_info->customer->first_name ?? $info->customer->first_name ?? '' }}" autocomplete="off" required>
                        <input type="hidden" name="customer_id" id="customer_id" value="{{ $lead_info->customer_id ?? $info->customer_id ?? '' }}">
                        <div id="result" class="typeahead-custom"></div>
                    </div>    
                    
                    <div class="form-group mt-2">
                        <label for="name" class="col-form-label">Organization </label>                   
                        <input type="text" name="organization" id="organization" value="{{ $lead_info->customer->company->name ?? $info->customer->company->name ?? '' }}" class="form-control" autocomplete="off" required>
                        <input type="hidden" name="organization_id" id="organization_id" value="{{ $lead_info->customer->organization_id ?? $info->customer->organization_id ?? '' }}">
                        <div id="result-org" class="typeahead-custom"></div>
                    </div>
                    <div class="col-6 form-group mt-2">
                        <label for="name" class="col-form-label">Title </label>                   
                        <input type="text" name="title" id="title" value="{{ $lead_info->lead_title ?? $lead_info->lead_subject ?? $info->deal_title ?? '' }}" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="col-6 form-group mt-2">
                        <label for="deal_value" class="col-form-label"> Value </label>                   
                        <input type="text" name="deal_value" id="deal_value" value="{{ $lead_info->lead_value ?? $info->deal_value ?? '' }}" class="form-control" autocomplete="off">
                    </div>
                    <div class="col-6 mb-4 mt-2">
                        <label for="deal_stage" class="col-form-label">Deal Stage <span class="text-danger">*</span></label>
                        <select name="deal_stage" id="deal_stage" class="form-control" required>
                            <option value="">--select--</option>
                            @if( isset($stage) && !empty($stage))
                                @foreach ($stage as $item)
                                    <option value="{{ $item->id }}" @if(isset($info->current_stage_id) && $info->current_stage_id == $item->id ) selected @endif> {{ $item->stages }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-6 mt-2">
                        <label for="description" class="col-form-label">Expected Completed Date <span class="text-danger">*</span></label>
                        <input type="text" required name="expected_date" id="expected_date" class="form-control datepicker w-100" value="<?= isset($info->expected_completed_date) ? date('d-m-Y', strtotime($info->expected_completed_date)): ''?>">
                    </div>
                    <div class="row " id="product-list">
                        <a href="javascript:;" id="add_product_btn" @if( isset($info->deal_products ) && count($info->deal_products) > 0 )  style="display:none"  @endif > Add Product </a>
                        <div id="main-product-tab" @if( isset($info->deal_products ) &&  count($info->deal_products) > 0 ) @else style="display:none" @endif >
                            <a href="javascript:;" id="add_remove_btn"> Remove Product </a>
                            <a href="javascript:;" id="add_more" class="badge badge-success-lighten mb-2" onclick="return add_field();"> Add More </a>
                            <input type="hidden" name="limit" id="limit" value="{{ isset($info->deal_products) ? count($info->deal_products) : 0 }}">
                            <div class="col-12 mb-2 product_pane" id="product_pane">
                                @if( isset( $info->deal_products ) && !empty($info->deal_products))
                                @php
                                    $limit = 0;
                                @endphp
                                    @foreach ($info->deal_products as $item)
                                    <div id="add-product-tab" class="d-flex w-100 mb-1 calc">
                                        <select name="item_{{ $limit }}" id="item_{{ $limit }}" class="form-select rounded-0 ">
                                            @if( isset( $list ) && !empty($list))
                                                @foreach($list as $litem)
                                                    <option value="{{ $litem->id }}" @if($item->product_id == $litem->id) selected @endif>{{ $litem->product_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <input type="numer" value="{{ $item->price ?? '' }}" class="form-control rounded-0 w-20" name="price_{{ $limit }}" id="price" onchange="return get_total({{ $limit }})" placeholder="Price" required>
                                        <input type="numer" value="{{ $item->quantity ?? '' }}" class="form-control rounded-0 w-10" name="quantity_{{ $limit }}" id="qty" onchange="return get_total({{ $limit }})" placeholder="Qty" value="1">
                                        <input type="numer" value="{{ $item->amount ?? '' }}"  class="form-control rounded-0 w-20" name="amount_{{ $limit }}" id="amount" placeholder="Amount" readonly>
                                    </div>
                                    @php
                                        $limit++;
                                    @endphp
                                    @endforeach
                                @endif
                            </div>
                            <div class="text-end">
                                <p>Total : </p>
                                <p id="tot">{{ $info->product_total ?? '0.00' }}</p>
                                <input type="hidden" name="total_cost" id="total_cost" value="{{ $info->product_total ?? '' }}">
                            </div>
                            <hr>
                        </div>
                    </div>
                    @if(Auth::user()->hasAccess('deals', 'is_assign'))

                    <div class="col-12 mt-2 mb-3">
                        <div class=" r">
                            <label for="description" class="col-form-label me-2">Assign To</label>
                            <select name="assigned_to" id="assigned_to" class="form-control">
                                <option value="">--select--</option>
                                @if( isset($users) && !empty($users))
                                    @foreach ($users as $item)
                                        <option value="{{ $item->id }}"  @if(isset($info->assigned_to) && $info->assigned_to == $item->id ) selected @endif > {{ $item->name.' '.$item->last_name ?? '' }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    @else 
                        <input type="hidden" name="assigned_to" id="assigned_to" value="{{ Auth::id() }}">
                    @endif
                    <div >
                        <div class="d-flex align-items-center">
                            <label for="description" class="col-form-label me-2">Status</label>
                            <div>
                                <input type="checkbox" name="status" id="switch3" data-switch="primary" {{ (isset($info->status) && $info->status == '1' )  ? 'checked' : ((isset($info->status) && $info->status == '0' ) ? '':'checked')}}>
                                <label for="switch3" data-on-label="" data-off-label=""></label>
                            </div>  
                        </div>
                    </div> 
                </div> 
            </div> 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
            <button type="submit" class="btn btn-primary" id="save">Save</button>
        </div>
    </form><!-- /.modal-content -->
</div>

<script>
    $('#result').hide();
    $('#result-org').hide();
        $('#customer').keyup(function(){
            var inputs = this.value;
            $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
            $.ajax({
                    url: "{{ route('autocomplete_customer', $companyCode) }}",
                    method:'POST',
                    data: {org:inputs, 'type':'lead'},
                    success:function(response){
                        $('#result').html(response);
                        $('#result').show();
                    }      
                });
        })

        $('#organization').keyup(function(){
            var inputs = this.value;
            $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
            $.ajax({
                    url: "{{ route('autocomplete_org', $companyCode) }}",
                    method:'POST',
                    data: {org:inputs},
                    success:function(response){
                        $('#result-org').html(response);
                        $('#result-org').show();
                    }      
                });
        })

        $("#deals-form").validate({
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
                        var from = $('#from').val();

                        if(response.error.length > 0 && response.status == "1" ) {
                            toastr.error('Error', response.error );
                        } else {
                            toastr.success('Success', response.error );

                            setTimeout(function(){
                                if(response.lead_id) {
                                    window.location.href = "{{ route('deals', $companyCode) }}";
                                } else {
                                    $('#Mymodal').modal('hide');
                                }
                            },100);
                            if( from == 'dashboard' ) {
                                window.location.href="{{ route('deals', $companyCode) }}";
                            } else{
                                ReloadDataTableModal('deals-datatable');
                            }
                            
                        }
                    }            
                });
            }
        });

        $(function(){
            $('.datepicker').datepicker({
                format: 'dd-mm-yyyy',
                todayHighlight: true,
                // endDate: '+0d',
                autoclose: true
            });
        }); 

        $('#add_product_btn').click(function(){
            $('#main-product-tab').show();
            add_field();
            $('#add_product_btn').hide();
        })

        $('#add_remove_btn').click(function(){
            $('#product_pane').html('');
            $('#main-product-tab').hide();
            $('#add_product_btn').show();
            $('#limit').val(0);
            $('#tot').html('0');
            $('#total_cost').val(0);
        });
        
        function add_field() {
            var limit = $('#limit').val();
            limit = parseInt( limit );
            $.ajax({
                url: "{{ route('deals.product-list', $companyCode)}}",
                type: 'POST',
                data: {limit:limit},
                beforeSend: function() {
                },
                success: function(response) {
                    $('#product_pane').append(response);
                    limit++;
                    $('#limit').val(limit);
                }            
            });

        }

        function get_total(limit) {
            total = 0;
            $('.calc').each(function() {
                amount = 0;
                price = $(this).find( '#price' ).val();
                qty = $(this).find( '#qty' ).val();
                if( isNaN(price) || price == '' || price == undefined ){price=0;}
                if( isNaN(qty) || qty == '' || qty == undefined ){qty=0;}

                amount = parseInt(price) * parseInt(qty);
                total += amount;
                $(this).find('#amount').val(amount);

            });
            $('#tot').html(total);
            $('#total_cost').val(total);

        }
</script>