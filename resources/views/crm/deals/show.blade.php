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
                <h4 class="page-title">Overview deal </h4>
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
            <li class="nav-item">
                <a href="#Notes" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active">
                    <i class="uil uil-pen"></i>
                    <span>Notes</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#Activity" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 ">
                    <i class="uil uil-user"></i>
                    <span >Activity</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="#Files" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                    <i class="uil-files-landscapes-alt uil"></i>
                    <span>Files</span>
                </a>
            </li>
           
            <li class="nav-item">
                <a href="#Invoices" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                    <i class="uil uil-invoice"></i>
                    <span>Invoices</span>
                </a>
            </li>
        </ul>
        
        <div class="tab-content p-3">
            <div class="tab-pane active" id="Notes">
                @include('crm.deals._note_form')
            </div>
            <div class="tab-pane show" id="Activity">
                @include('crm.deals._activity_form')
            </div> 
            <div class="tab-pane show" id="Files">
                @include('crm.deals._file_form')
            </div> 
            
            <div class="tab-pane" id="Invoices">
                @include('crm.deals._invoice_form')
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body" id="lead_timeline">
            @include('crm.deals._timeline')
        </div>
    </div>
</div>
<script>
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
            data: {limit:limit},
            success: function(response) {
                $('#invoice-items').append(response);
            }            
        });
    }

    function remove_items(limit) {
        $('#add-product-tab_'+limit).remove();
    }

    function get_total(limit) {
        total = 0;
        $('.calc').each(function() {
            amount = 0;
            price = $(this).find( '#unit_price' ).val();
            qty = $(this).find( '#qty' ).val();
            if( isNaN(price) || price == '' || price == undefined ){price=0;}
            if( isNaN(qty) || qty == '' || qty == undefined ){qty=0;}

            amount = parseInt(price) * parseInt(qty);
            total += amount;
            $(this).find('#amount').val(amount);

        });
        $('#subtotal').html(total);
        $('#total_cost').val(total);

    }

     

</script>

@endsection 
