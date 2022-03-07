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
                                <label for="">Subscription Name</label>
                                <div>
                                    {{ $info->subscription->subscription_name ?? '' }}
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="">Description</label>
                                <div>
                                    {{ $info->description ?? '' }}
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">
                                <label for=""> Start At</label>
                                <div>
                                    {{ date( 'd M, Y', strtotime($info->startAt)) ?? '' }}
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="">End At</label>
                                <div>
                                    {{ date( 'd M, Y', strtotime($info->endAt)) ?? '' }}
                                </div>
                            </div>
                            <div class="col-6 mt-3">
                                <label for="">Total Amount</label>
                                <div>
                                    {{ $info->total_amount }}
                                </div>
                            </div>
                        </div>
                            
                        <div class="col-md-12 mt-2 text-end">
                            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Close</button>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div><!-- /.modal-content -->
</div>
