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
                    $bg = array('success','warning', 'info', 'primary', 'danger');
                    $i=0;
                @endphp
                @foreach ($stage as $item)
                <div class="tasks p-0 m-0" data-plugin="dragula" data-containers='["task-list-one", "task-list-two", "task-list-three", "task-list-four", "task-list-five"]'>
                    <h6 class="m-0 task-header bg-{{ $bg[$i] }} text-white">{{ $item->stages }} </h6>
                    <div id="task-list-one" class="task-list-items px-0">
                        @if( isset( $item->deals) && !empty($item->deals))
                        @foreach ($item->deals as $deal)
                         <!-- Task Item -->
                         <div class="card m-1">
                            <div class="card-body p-2">
                                <small class="float-end text-muted">{{ date('d M Y', strtotime($deal->updated_at)) }}</small>
                                <span class="badge bg-success">Low</span>

                                <h6 class="mt-2 mb-2">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal" class="text-body">{{ $deal->deal_title }}</a>
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
                                    <img src="assets/images/users/avatar-3.jpg" alt="user-img" class="avatar-xs rounded-circle me-1" />
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
@endsection