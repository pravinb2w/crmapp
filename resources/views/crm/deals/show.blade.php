@extends('crm.layouts.template')

@section('content')
<link href="{{ asset('assets/css/vendor/simplemde.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    .CodeMirror, .editor-toolbar, #notes {
        background: rgb(255, 252, 220);
    }
    .notes-pane {
        position: absolute;
        bottom: 46px;
        right: 8px;
        z-index: 9;
    }
/* HIDE RADIO */
[type=radio] { 
  position: absolute;
  opacity: 0;
  width: 0;
  height: 0;
}

/* IMAGE STYLES */
[type=radio] + i {
  cursor: pointer;
}

/* CHECKED STYLES */
[type=radio]:checked + i {
  outline: 2px solid #10b9f1;
}

form#activites-form>div>label>i {
    padding: 5px;
    border: 0.5px solid #ddd;
    font-size: 20px;
}
#activites-form {
    padding:15px;
}
.timeinput {
    display: inline-flex;
    width: 100%;
}
.timeinput > span {
    padding: 10px;
}
.w-35 {
    width: 35% !important;
}
.w-80 {
    width: 80% !important;
}

.timeline-item-left>.timeline-desk>.timeline-box {
    background: rgb(255, 252, 220);
}
.dropdown {
    position: absolute;
    right: 0;
    top: 0;
}
</style>
<style>
    .loader{
    position: absolute;
    top:0px;
    right:0px;
    border: 10px solid #f3f3f3; /* Light grey */
    border-top: 10px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 75px;
    height: 75px;
    animation: spin 0.5s linear infinite;
    background-position:center;
    z-index:10000000;
    opacity: 0.4;
    filter: alpha(opacity=40);
    left: 50%;
    top: 30%;
    display: none;
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<div class="container-fluid">
                        
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Deals</li>
                    </ol>
                </div>
                <h4 class="page-title">Overview Deal </h4>
            </div>
        </div>
    </div>  

    <div class="row card p-4 mb-3">
        <div class="col-12" id="deal_info">
            @include('crm.deals._info')
        </div>
    </div>
    <div class="card shadow-sm">
        <ul class="nav nav-pills bg-nav-pills nav-justified custom">

            @if(Auth::user()->hasAccess('deals', 'is_edit') && ( Auth::id() == $info->assigned_to || $info->assigned_to == null ) )
            <li class="nav-item">
                <a href="#Notes" data-bs-toggle="tab" data-id="note" aria-expanded="false" class="nav-link rounded-0 active deal-tab">
                    <i class="uil uil-pen"></i>
                    <span>Notes</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#Activity" data-bs-toggle="tab" data-id="activity" aria-expanded="true" class="nav-link rounded-0 deal-tab">
                    <i class="uil uil-user"></i>
                    <span >Activity</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="#Files" data-bs-toggle="tab" aria-expanded="false" data-id="file" class="nav-link rounded-0 deal-tab">
                    <i class="uil-files-landscapes-alt uil"></i>
                    <span>Files</span>
                </a>
            </li>
           
            <li class="nav-item">
                <a href="#Invoices" data-bs-toggle="tab" data-id="invoice" aria-expanded="false" class="nav-link rounded-0 deal-tab">
                    <i class="uil uil-invoice"></i>
                    <span>Invoices</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a href="#History" data-bs-toggle="tab" data-id="history" aria-expanded="false" class="nav-link rounded-0 deal-tab">
                    <i class="uil uil-invoice"></i>
                    <span>History</span>
                </a>
            </li>
        </ul>
         
        <div class="tab-content p-3">
            <div class="tab-pane active" id="dealtab">
                @if(Auth::user()->hasAccess('deals', 'is_edit') && ( Auth::id() == $info->assigned_to || $info->assigned_to == null ))
                    @include('crm.deals._note_form')
                @else
                    @include('crm.deals._history_form')
                @endif
            </div>
            {{-- <div id="deal-sub-list"></div> --}}
            <div class="loader"></div>
        </div>
    </div>
    {{-- <div class="card">
        <div class="card-body" id="lead_timeline">
            @include('crm.deals._timeline')
        </div>
    </div> --}}
</div>
<script>
    get_deal_common_sub_list('{{ $deal_id }}', 'note');
    function deal_finalize(status, id) {
        var comman;
        status = parseInt(status);
        if( status == 1 ) {
            comman = 'You are trying to reopen Deals';
        } else if( status == 2 ) {
            comman  = 'You are trying to Won Deals';
        } else {
            comman  = 'You are trying to Loss Deals';
        }

       Swal.fire({
           title: 'Are you sure?',
           text: comman,
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Yes, do it!'
           }).then((result) => {
               /* Read more about isConfirmed, isDenied below */
               if (result.isConfirmed) {
                   var ajax_url = "{{ route('deals.finalize') }}";
                   $.ajaxSetup({
                       headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       }
                   });
                   $.ajax({
                       url: ajax_url,
                       method:'POST',
                       data: {status:status, id:id},
                       success:function(response){
                           $('#deal_info').html(response);
                       }      
                   });
                   Swal.fire('Updated!', '', 'success')
               } 
           })
           return false;
    }

    function get_add_items() {
        var limit = $('#limit').val();
        if( $('#with_tax').is(":checked") ) {
            var with_tax = 'yes';
        } else {
            var with_tax = '';
        }

        limit = parseInt(limit);
        limit++;
        $('#limit').val(limit);
        $.ajaxSetup({
                       headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       }
                   });
        $.ajax({
            url: "{{ route('invoices.add_items') }}",
            type: 'POST',
            data: {limit:limit, with_tax:with_tax},
            success: function(response) {
                $('#invoice-items').append(response);
            }            
        });
    }

    function get_product_tax(product_id, limit) {
        var ajax_url = "{{ route('deals.get_product_tax') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: ajax_url,
            method:'POST',
            data: {product_id:product_id, limit:limit},
            success:function(response){
                if( response.cgst ){
                    $('input[name="cgst_'+limit+'"]').val(response.cgst);
                }
                if( response.sgst ){
                    $('input[name="sgst_'+limit+'"]').val(response.sgst);
                }
                if( response.igst ){
                    $('input[name="igst_'+limit+'"]').val(response.igst);
                }
            }      
        });
    }

    function remove_items(limit) {
        $('#add-product-tab_'+limit).remove();
        get_total();
    }

    function get_total(limit) {
        total = 0;
        $('.calc').each(function() {
            amount = 0;
            pro_amount = 0;
            dis_amount = 0;
            sub_total = 0;
            price = $(this).find( '#unit_price' ).val();
            qty = $(this).find( '#qty' ).val();

            discount = $(this).find( '#discount' ).val();

            cgst = $(this).find( '#cgst' ).val();
            sgst = $(this).find( '#sgst' ).val();
            igst = $(this).find( '#igst' ).val();

            if( isNaN(price) || price == '' || price == undefined ){price=0;}
            if( isNaN(cgst) || cgst == '' || cgst == undefined ){cgst=0;}
            if( isNaN(sgst) || sgst == '' || sgst == undefined ){sgst=0;}
            if( isNaN(igst) || igst == '' || igst == undefined ){igst=0;}
            if( isNaN(discount) || discount == '' || discount == undefined ){discount=0;}
            if( isNaN(qty) || qty == '' || qty == undefined ){qty=0;}

            pro_amount = parseInt(price) * parseInt(qty);
            
            if( discount != 0 ) {
               dis_amount = ( pro_amount * discount/100 ); 
            }
            if( cgst != 0 ) {
                amount += ( pro_amount * cgst/100 ); 
            }
            if( sgst != 0 ) {
                amount += ( pro_amount * sgst/100 ); 
            }
            if( igst != 0 ) {
                amount += ( pro_amount * igst/100 ); 
            }
            sub_total = (pro_amount + amount ) - dis_amount;
            total += sub_total;
            $(this).find('#amount').val(sub_total.toFixed(2));

        });
        $('#subtotal').html(total.toFixed(2));
        $('#total_cost').val(total.toFixed(2));

    }

    function unlink_invoice(deal_id, invoice_id, type) {
        var comman = 'You are trying to unlink invoice from Deals';

        Swal.fire({
           title: 'Are you sure?',
           text: comman,
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Yes, do it!'
           }).then((result) => {
               /* Read more about isConfirmed, isDenied below */
               if (result.isConfirmed) {
                   var ajax_url = "{{ route('deals.unlink') }}";
                   $.ajaxSetup({
                       headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       }
                   });
                   $.ajax({
                       url: ajax_url,
                       method:'POST',
                       data: {deal_id:deal_id, invoice_id:invoice_id, type:type},
                       success:function(response){
                            if(response.deal_id ) {
                                get_deal_common_sub_list(response.deal_id, 'invoice');
                           }
                           
                       }      
                   });
                   Swal.fire('Updated!', '', 'success')
               } 
           })
           return false;
    }

    function submit_approve_invoice(deal_id, invoice_id, type) {
        var comman = 'You are trying to submiot for Approval';

        Swal.fire({
           title: 'Are you sure?',
           text: comman,
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Yes, do it!'
           }).then((result) => {
               /* Read more about isConfirmed, isDenied below */
               if (result.isConfirmed) {
                   var ajax_url = "{{ route('deals.submit-approve') }}";
                   $.ajaxSetup({
                       headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       }
                   });
                   $.ajax({
                       url: ajax_url,
                       method:'POST',
                       data: {deal_id:deal_id, invoice_id:invoice_id, type:type},
                    //    async:true,
                        beforeSend:function(){
                            $('.loader').show();
                        },
                       success:function(response){
                            if(response.deal_id ) {
                                $('.loader').hide();
                                get_deal_common_sub_list(response.deal_id, 'invoice');
                            }
                       }      
                   });
                   Swal.fire('Updated!', '', 'success')
               } 
           })
           return false;
    } 

    $('.deal-tab').click(function(){
        var tab = $(this).attr('data-id');
        var deal_id = '{{ $id }}';
        get_tab(tab, deal_id);
    })

    function get_tab(tab, deal_id){
        var ajax_url = "{{ route('deals.get_tab') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: ajax_url,
            method:'POST',
            data: {deal_id:deal_id, tab:tab},
            beforeSend:function(){
                $('.loader').show();
            },
            success:function(response){
                $('#dealtab').html(response);
                if( tab != 'history') {
                    get_deal_common_sub_list(deal_id, tab);
                } else {
                    $('#deal-sub-list').hide();
                }
              
                $('.loader').hide();
            }      
        });
    }

</script>

@endsection 
