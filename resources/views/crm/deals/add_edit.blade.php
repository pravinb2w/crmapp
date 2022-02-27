<div class="modal-dialog modal-lg modal-right">
    <style>
        #product-list {
            max-height: 250px;
            overflow-y: auto;
        }
    </style>
    <div class="modal-content">
        <div class="modal-header px-3" id="myLargeModalLabel">{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body d-flex justify-content-center align-items-center h-100 p-3">
            <form class="form-horizontal " id="deals-form" method="POST" action="{{ route('deals.save') }}" autocomplete="off">

            <div class="w-100">
                <div class="row">
                    <div class="col-12" id="error"></div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <span><i class="dripicons-user"></i></span>
                        <label for="name" class="col-form-label">Customer </label>                   
                        <input type="text" name="customer" id="customer" class="form-control" required value="{{ $info->customer->first_name ?? '' }}" autocomplete="off">
                        <input type="hidden" name="customer_id" id="customer_id" value="{{ $info->customer_id ?? '' }}">
                        <div id="result" class="typeahead-custom"></div>
                    </div>    
                    
                    <div class="form-group mt-2">
                        <label for="name" class="col-form-label">Organization </label>                   
                        <input type="text" name="organization" id="organization" class="form-control" autocomplete="off" required>
                        <input type="hidden" name="organization_id" id="organization_id">
                        <div id="result-org" class="typeahead-custom"></div>
                    </div>
                    <div class="col-6 form-group mt-2">
                        <label for="name" class="col-form-label">Title </label>                   
                        <input type="text" name="title" id="title" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="col-6 form-group mt-2">
                        <label for="lead_value" class="col-form-label"> Value </label>                   
                        <input type="text" name="lead_value" id="lead_value" class="form-control" autocomplete="off">
                    </div>
                    <div class="col-6 mb-4 mt-2">
                        <label for="lead_type" class="col-form-label">Deal Stage</label>
                        <select name="lead_type" id="lead_type" class="form-control">
                            <option value="">--select--</option>
                            @if( isset($stage) && !empty($stage))
                                @foreach ($stage as $item)
                                    <option value="{{ $item->id }}"> {{ $item->stages }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                   
                    <div class="col-6 mt-2">
                        <label for="description" class="col-form-label">Expected Completed Date</label>
                        <input type="text" required name="start_date" id="start_date" class="form-control datepicker w-100" value="<?= isset($info->startAt) ? date('d-m-Y', strtotime($info->startAt)): ''?>">
                    </div>
                    <div class="row " id="product-list">
                        <a href="javascript:;" id="add_product_btn"> Add Product </a>
                        
                        <div id="main-product-tab" style="display:none">
                            <a href="javascript:;" id="add_remove_btn"> Remove Product </a>
                            <a href="javascript:;" id="add_more" class="badge badge-success-lighten" onclick="return add_field();"> Add More </a>
                            <input type="hidden" name="limit" id="limit" value="0">
                            <div class="col-12 mb-2 product_pane" id="product_pane">
                                
                            </div>
                            <div class="text-end">
                                <p>Total : </p>
                                <p id="tot">10229.00</p>
                            </div>
                            <hr>
                        </div>
                        
                    </div>
                    <div class=" row col-6 mt-2">
                        <div class="d-flex align-items-center">
                            <label for="description" class="col-form-label me-2">Status</label>
                            <div>
                                <input type="checkbox" name="status" id="switch3" data-switch="primary">
                                <label for="switch3" data-on-label="" data-off-label=""></label>
                            </div>  
                        </div>
                    </div>
                </div>  
            </div>
        </div>
        <div class="modal-footer px-3">
            <div class="col-12 text-end">
                <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Cancel</button>
                <button type="submit" class="btn btn-primary" id="save">Save</button>
            </div>
        </div>
    </div><!-- /.modal-content -->
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
                    url: "{{ route('autocomplete_customer') }}",
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
                    url: "{{ route('autocomplete_org') }}",
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
                        if(response.error.length > 0 && response.status == "1" ) {
                            $('#error').addClass('alert alert-danger');
                            response.error.forEach(display_errors);
                        } else {
                            $('#error').addClass('alert alert-success');
                            response.error.forEach(display_errors);
                            setTimeout(function(){
                                $('#Mymodal').modal('hide');
                            },100);
                            ReloadDataTableModal('deals-datatable');
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
        });
        
        function add_field() {
            var limit = $('#limit').val();
            limit = parseInt( limit );
            console.log(limit);
            $.ajax({
                url: "{{ route('deals.product-list')}}",
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

        }
</script>