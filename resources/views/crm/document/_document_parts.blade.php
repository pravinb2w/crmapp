 <!-- task -->
 <div class="row justify-content-sm-between border-bottom">
    <div class="col-sm-4 mb-2 mb-sm-0 d-table">
        <div class="form-check d-table-cell align-middle">
            <label class="form-check-label" for="task1">
            {{ $item->documentType->document_name }} 
            </label>
            @if( $item->status == 'rejected' )
            <div class="text-muted">
                Reason: {{ $item->reject_reason }}
            </div>
            @endif
        </div> <!-- end checkbox -->
    </div> <!-- end col -->
    <div class="col-sm-8">
        <div class="d-flex justify-content-between">
            
            <div class="mx-2 d-table">
                <ul class="list-inline font-13 text-end d-table-cell align-middle">
                    <li class="list-inline-item">
                        <i class="uil uil-schedule font-16 me-1"></i> 
                        {{ date('d-M-Y H:i A', strtotime($item->uploadAt)) }}
                    </li>
                </ul>
            </div>
            <div class="card m-2 shadow-none border w-75">
                <div class="p-1">
                    @php
                        $path_file = asset('storage').'/'.$item->document;
                        $size = Storage::size( 'public/'.$item->document );
                        $file_size = number_format($size / 1048576,2);
                        $extension = pathinfo(storage_path($item->document), PATHINFO_EXTENSION);
                        // echo $extension;
                    @endphp
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="avatar-sm">
                                <span class="avatar-title rounded">
                                    {{ '.'.ucfirst($extension) }}
                                </span>
                            </div>
                        </div>
                        <div class="col ps-0">
                            <a href="{{ asset('storage').'/'.$item->document }}" target="_blank" class="text-muted fw-bold">{{ $item->documentType->document_name.'.'.$extension }}</a>
                            <p class="mb-0"> {{ $file_size }} MB</p>
                        </div>
                        <div class="col-auto" id="tooltip-container9">
                            <!-- Button -->
                            <a href="{{ asset('storage').'/'.$item->document }}" target="_blank" data-bs-container="#tooltip-container9" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" class="btn btn-link text-muted btn-lg px-1" data-bs-original-title="Download">
                                <i class="uil uil-cloud-download"></i>
                            </a>
                            @if( $item->status == 'pending')
                                <a href="javascript:void(0);" onclick="return changeDocumentStatus('{{ $item->id }}', 'approved')"  title="Approve" class="btn btn-link text-success btn-lg px-1" >
                                    <i class="uil uil-check"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="return changeDocumentStatus('{{ $item->id }}', 'rejected')" data-bs-container="#tooltip-container9" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" class="btn btn-link text-danger btn-lg px-1" data-bs-original-title="Reject">
                                    <i class="uil uil-multiply"></i>
                                </a>
                            @elseif( $item->status == 'approved')
                                <a href="javascript:void(0);" data-bs-container="#tooltip-container9" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" class="btn btn-link text-success btn-lg px-1" data-bs-original-title="Approve">
                                    <i class="uil uil-check"></i>
                                </a>
                            @else
                                <a href="javascript:void(0);" data-bs-container="#tooltip-container9" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" class="btn btn-link text-danger btn-lg px-1" data-bs-original-title="Reject">
                                    <i class="uil uil-multiply"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end .d-flex-->
    </div> <!-- end col -->
</div>
<!-- end task -->