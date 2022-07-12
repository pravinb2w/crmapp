@extends('crm.layouts.template')

@section('content')
<div class="container-fluid"> 
    <!-- start page title --> 
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Phoenix</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">DEALS</li>
                    </ol>
                </div>
                <h4 class="page-title">CRM</h4>
            </div>
        </div>
    </div>  
    <div class="row">
        <div class="col-12 p-0">
            <div class="board">
                @if( isset( $stage ) && !empty($stage))
                @php
                    $bg = array('success','warning', 'info', 'primary', 'danger', 'secondary', 'success', 'warning', 'info', 'primary');
                    $i=0;
                @endphp
                @foreach ($stage as $item)
                <div class="tasks p-0 m-0 dropzone" data-parent="{{ $item->stages }}">
                    <h6 class="m-0 task-header bg-{{ $bg[$i] }} text-white">{{ $item->stages }} </h6>
                    <div id="task-list-one" class="task-list-items px-0" data-parent="{{ $item->stages }}">
                        @if( isset( $item->deals) && !empty($item->deals))
                        @foreach ($item->deals as $deal)
                         <!-- Task Item -->
                         <div class="card m-1" id="draggable" draggable="true" data-id="{{ $deal->id }}" data-parent="{{ $item->stages }}">
                            <div class="card-body p-2">
                                <small class="float-end text-muted">{{ date('d M Y', strtotime($deal->updated_at)) }}</small>
                                <span class="badge bg-success">Low</span>

                                <h6 class="mt-2 mb-2">
                                    <span class="text-body">{{ $deal->deal_title }}</span>
                                </h6>

                                <p class="mb-0">
                                    <span class="pe-2 text-nowrap mb-2 d-inline-block">
                                        <i class="mdi mdi-briefcase-outline text-muted"></i>
                                        CRM
                                    </span>
                                    <span class="text-nowrap mb-2 d-inline-block">
                                        <i class="mdi mdi-comment-multiple-outline text-muted"></i>
                                        <b>{{ count($deal->notes) }}</b> Notes
                                    </span>
                                </p>

                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical font-18"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="{{ route('deals.view',['id' => $deal->id])}}" target="_blank" class="dropdown-item"><i class="mdi mdi-eye me-1"></i>View</a>
                                        <!-- item-->
                                        {{-- <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-delete me-1"></i>Delete</a> --}}
                                        
                                    </div>
                                </div>

                                <p class="mb-0">
                                    <img src="{{ asset('assets/images/users/avatar-10.jpg') }}" alt="user-img" class="avatar-xs rounded-circle me-1" />
                                    <span class="align-middle">{{ $deal->customer->first_name.' '.$deal->customer->last_name ?? '' }}</span>
                                </p>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- Task Item End -->
                        
                        @endforeach
                        @endif
                    </div> <!-- end company-list-1-->
                </div> 
                @php
                            $i++;
                        @endphp
                @endforeach
               @endif
            </div> <!-- end .board-->
        </div> <!-- end col -->
    </div>
    <!-- end row-->
</div> 
@endsection

@section('add_on_script')
    <script src="{{ asset('assets/js/vendor/dragula.min.js') }}"></script>
    <script src="{{ asset('assets/js/ui/component.dragula.js') }}"></script>
    <script>
        var dragged;

/* events fired on the draggable target */
document.addEventListener("drag", function( event ) {

}, false);

document.addEventListener("dragstart", function( event ) {
    console.log('drag start');
    // store a ref. on the dragged elem
    dragged = event.target;
    // make it half transparent
    event.target.style.opacity = .5;
}, false);

document.addEventListener("dragend", function( event ) {
    console.log('drag end');

    // reset the transparency
    event.target.style.opacity = "";
}, false);

/* events fired on the drop targets */
document.addEventListener("dragover", function( event ) {
    // prevent default to allow drop
    console.log('drag over');

    event.preventDefault();
}, false);

document.addEventListener("dragenter", function( event ) {
    // highlight potential drop target when the draggable element enters it
    console.log('drag enter');

    if ( event.target.className == "dropzone" ) {
        event.target.style.background = "purple";
    }

}, false);

document.addEventListener("dragleave", function( event ) {
    // reset background of potential drop target when the draggable element leaves it
    console.log('drag leave');

    if ( event.target.className == "dropzone" ) {
        event.target.style.background = "";
    }

}, false);

document.addEventListener("drop", function( event ) {
    // prevent default action (open as link for some elements)
    console.log(event.target);
    var ldragged = dragged;
    let target_stage = event.target.getAttribute('data-parent');
    let deal_id = ldragged.getAttribute('data-id');
    console.log('deal_id', deal_id);
    console.log('target_stage', target_stage);
    event.preventDefault();
    // move dragged elem to the selected drop target
    if( target_stage != '' && target_stage != null && target_stage != 'undefined' &&
    deal_id != '' && deal_id != null && deal_id != 'undefined' ) {

        Swal.fire({
        title: 'Are you sure?',
        text: 'You are trying to change Stage',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, do it!'
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('deals.make_stage_completed_pipline') }}",
                    type: 'POST',
                    data: {stage:target_stage,deal_id:deal_id},
                    beforeSend: function() {
                        $('.pipeline-loader').show();
                    },
                    success: function(response) {
                        $('.pipeline-loader').hide();
                        if( response.status == '1' ) {
                           
                            Swal.fire('Updated!', '', 'success')

                            event.target.style.background = "";
                            dragged.parentNode.removeChild( dragged );
                            event.target.appendChild( dragged );

                        } else {
                            Swal.fire(response.error, '', 'error');
                        }   
                    }            
                });
            } 
        })
        return false;

    } else {
        toastr.error('error', 'Drag was not properly done');
    }
  
}, false);
</script>
@endsection