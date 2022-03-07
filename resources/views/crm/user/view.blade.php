<div class="modal-dialog modal-md">
    
    <div class="modal-content h-100">
        <div class="modal-header px-3" id="myLargeModalLabel">
            <h4>{{ $modal_title }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="max-height: 95vh;overflow:auto">

                <div class="modal-body d-flex justify-content-center align-items-center h-100 p-3">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-12" id="error"></div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="">First Name</label>
                                <div>
                                    {{ $info->name ?? '' }}
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="">Last Name</label>
                                <div>
                                    {{ $info->last_name ?? '' }}
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="">Email</label>
                                <div>
                                    {{ $info->email ?? '' }}
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="">Mobile Number</label>
                                <div>
                                    {{ $info->mobile_no ?? '' }}
                                </div>
                            </div>
                           
                        </div>

                        <div class="row">
                            
                            @if(isset( $info->lead_limit ) && !empty($info->lead_limit))
                            <div class="col-6 mt-2">
                                <label for="">Lead Limit</label>
                                <div>
                                    {{ $info->lead_limit ?? 'N/A' }}
                                </div>
                            </div>
                            @endif
                            @if(isset( $info->deal_limit ) && !empty($info->deal_limit))
                            <div class="col-6 mt-2">
                                <label for="">Deal Limit</label>
                                <div>
                                    {{ $info->deal_limit ?? 'N/A' }}
                                </div>
                            </div>
                            @endif
                            
                        </div>
                        
                            
                            <div class="col-md-12 mt-2 text-end">
                                <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Close</button>
                            </div>
                        </div>  
                    </div>
                </div>
            </form>
        </div>
    </div><!-- /.modal-content -->
</div>
