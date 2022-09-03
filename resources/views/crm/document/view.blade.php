@extends('crm.layouts.template')

@section('content')
<style>
    i.uil.uil-cloud-download:hover {
        color: darkolivegreen;
    }
    i.uil.uil-check:hover {
        color: green;
    }
    i.uil.uil-multiply:hover {
        color: red;
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
                            <li class="breadcrumb-item"><a href="{{ route('customer_document_approval') }}">Customer Document Approval</a></li>
                            <li class="breadcrumb-item active">Customer Document View</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Customers Document View </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="card text-center">
                    @include('crm.document._document_profile_view')
                </div> <!-- end card -->              

            </div> <!-- end col-->

            <div class="col-xl-8 col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <div class="col-xxl-12">
                            <!-- start page title -->
                            <div class="page-title-box">
                                <h4 class="page-title">Documents </h4>
                            </div>
                            <!-- end page title -->
                            <!-- tasks panel -->
                            <div class="mt-2">
                                <h5 class="m-0 pb-2">
                                    <a class="text-dark" data-bs-toggle="collapse" href="#todayTasks" role="button" aria-expanded="true" aria-controls="todayTasks">
                                        <i class="uil uil-angle-down font-18"></i>Pending <span class="text-muted">({{ count($info->customer->pendingDocuments) }})</span>
                                    </a>
                                </h5>

                                <div class="collapse show" id="todayTasks" style="">
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            @if( isset( $info->customer->pendingDocuments ) && !empty( $info->customer->pendingDocuments ) )
                                                @foreach ( $info->customer->pendingDocuments as $item)
                                                    @include('crm.document._document_parts')
                                                @endforeach                                           
                                            @endif
                                        </div> <!-- end card-body-->
                                    </div> <!-- end card -->
                                </div> <!-- end .collapse-->
                            </div> <!-- end .mt-2-->

                            <!-- upcoming tasks -->
                            <div class="mt-4">

                                <h5 class="m-0 pb-2">
                                    <a class="text-dark" data-bs-toggle="collapse" href="#upcomingTasks" role="button" aria-expanded="true" aria-controls="upcomingTasks">
                                        <i class="uil uil-angle-down font-18"></i>Rejected <span class="text-muted">({{ count($info->customer->rejectDocuments) }})</span>
                                    </a>
                                </h5>

                                <div class="collapse show" id="upcomingTasks" style="">
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            @if( isset( $info->customer->rejectDocuments ) && !empty( $info->customer->rejectDocuments ) )
                                                @foreach ( $info->customer->rejectDocuments as $item)
                                                    <!-- task -->
                                                    @include('crm.document._document_parts')
                                                    <!-- end task -->
                                                @endforeach                                           
                                            @endif
                                        </div> <!-- end card-body-->
                                    </div> <!-- end card -->
                                </div> <!-- end collapse-->
                            </div>
                            <!-- end upcoming tasks -->

                            <!-- start other tasks -->
                            <div class="mt-4 mb-4">
                                <h5 class="m-0 pb-2">
                                    <a class="text-dark" data-bs-toggle="collapse" href="#otherTasks" role="button" aria-expanded="true" aria-controls="otherTasks">
                                        <i class="uil uil-angle-down font-18"></i>Approved <span class="text-muted">({{ count($info->customer->approvedDocuments) }})</span>
                                    </a>
                                </h5>

                                <div class="collapse show" id="otherTasks" style="">
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            @if( isset( $info->customer->approvedDocuments ) && !empty( $info->customer->approvedDocuments ) )
                                                @foreach ( $info->customer->approvedDocuments as $item)
                                                    @include('crm.document._document_parts')
                                                @endforeach                                           
                                            @endif
                                        </div> <!-- end card-body-->
                                    </div> <!-- end card -->
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card body -->
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div>
    </div>
@endsection
@section('add_on_script')
   
    <script>
        
        function changeDocumentStatus(id, status){
            console.log( status );
            if( status == 'approved' ) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You are trying to Approve Document',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, do it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{ route('customer_document_approval.change.status') }}",
                            type: 'POST',
                            data: {
                                status: status,
                                id: id
                            },
                            success: function(response) {
                                if (response.status == '1') {
                                    Swal.fire('Updated!', 'Updated Document Status', 'success')
                                    setTimeout(() => {
                                        location.reload();
                                    }, 200);
                                } else {
                                    Swal.fire(response.error, '', 'error');
                                }
                            }
                        });
                    }
                })
            } else {
                Swal.fire({
                    title: "Are you sure to Reject ?",
                    text: "Add Reject reason here",
                    input: 'text',
                    showCancelButton: true,
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Reason is required!'
                        }
                    }        
                }).then((result) => {
                    if (result.value) {
                        console.log("Result: " + result.value);
                        var reason = result.value;
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{ route('customer_document_approval.change.status') }}",
                            type: 'POST',
                            data: {
                                status: status,
                                id: id,
                                reason:reason
                            },
                            success: function(response) {
                                if (response.status == '1') {
                                    Swal.fire('Updated!', 'Updated Document Status', 'success')
                                    setTimeout(() => {
                                        location.reload();
                                    }, 200);
                                } else {
                                    Swal.fire(response.error, '', 'error');
                                }
                            }
                        });

                    }
                });
            }
        }
    </script>
@endsection
