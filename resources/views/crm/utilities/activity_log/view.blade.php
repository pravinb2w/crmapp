<div class="modal-dialog modal-lg">
    
    <div class="modal-content h-100">
        <div class="modal-header px-3" id="myLargeModalLabel">
            <h4>{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="max-height: 105vh;overflow:auto">

            <div class="modal-body d-flex justify-content-center align-items-center h-100 p-3">
                <div class="w-100">
                    <div class="row">
                        <div class="col-12" id="error"></div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Log Date</th>
                                            <td>{{ date('d M Y H:i A', strtotime($info->created_at)) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Logged By</th>
                                            <td>{{ $info->user->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Module</th>
                                            <td>{{ $info->auditable_type ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Operation</th>
                                            <td>{{ ucfirst($info->event) ?? '' }}</td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        
                        @if( isset($info->old_values) && !empty($info->old_values))
                        <div class="col-12">
                            <h5>Old Values</h5>
                            <table class="table mb-0">
                                <thead>
                                @foreach ($info->old_values as $col => $val )
                                    <tr>
                                        <th  class="table-light" style="width:40%;"> {{ ucfirst( str_replace("_", " ", $col) ) }}</th>
                                        <td> 
                                            {{ $val }}
                                        </td>
                                    </tr>
                                @endforeach
                                </thead>
                            </table>
                        </div>
                        @endif

                        {{-- new values --}}
                        <div class="col-12">
                            <h5>New Values</h5>
                            @if( isset($info->new_values) && !empty($info->new_values))
                            <table class="table mb-0">
                                <thead>
                                @foreach ($info->new_values as $col => $val )
                                    <tr>
                                        <th  class="table-light" style="width:40%;"> {{ ucfirst( str_replace("_", " ", $col) ) }}</th>
                                        <td> 
                                            {{ $val }}
                                        </td>
                                    </tr>
                                @endforeach
                                </thead>
                            </table>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-12 mt-3 text-end">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Close</button>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div><!-- /.modal-content -->

