<div class="modal-dialog modal-lg modal-right">
    
    <div class="modal-content h-100">
        <div class="modal-header px-3" id="myLargeModalLabel">
            <h4>{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="max-height: 95vh;overflow:auto">
            
            <div class="modal-body d-flex justify-content-center align-items-center h-100 p-3">
                <div class="w-100">
                    <div class="row">
                        <div class="col-12 text-end">
                            <a class="btn btn-primary" target="_blank" href="{{ asset('invoice').'/'. str_replace("/", "_", $info->invoice_no) . '.pdf' }}">Download PDF</a>
                        </div>
                    </div>
                    @include('crm.invoice._invoice_table')  
                        
                    <div class="col-md-12 mt-2 text-end">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Close</button>
                    </div>
                </div>  
            </div>
        </div>
    </div><!-- /.modal-content -->
</div>
