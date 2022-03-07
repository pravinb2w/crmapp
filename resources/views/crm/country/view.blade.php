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
                                <label for="">Country</label>
                                <div>
                                    {{ $info->country_name ?? '' }}
                                </div>
                            </div>
                            @if(isset( $info->dial_code) && !empty($info->dial_code))
                            <div class="col-6">
                                <label for="">Dial Code</label>
                                <div>
                                    {{ $info->dial_code ?? '' }}
                                </div>
                            </div>
                            @endif

                            @if(isset( $info->country_code) && !empty($info->country_code))
                            <div class="col-6">
                                <label for="">Country Code</label>
                                <div>
                                    {{ $info->country_code ?? '' }}
                                </div>
                            </div>
                            @endif
                            
                            @if(isset( $info->iso) && !empty($info->iso))
                            <div class="col-6">
                                <label for="">ISO</label>
                                <div>
                                    {{ $info->iso ?? '' }}
                                </div>
                            </div>
                            @endif

                            @if(isset( $info->currency) && !empty($info->currency))
                            <div class="col-6">
                                <label for="">Currency</label>
                                <div>
                                    {{ $info->currency ?? '' }}
                                </div>
                            </div>
                            @endif

                            <div class="col-6">
                                <label for="">Description</label>
                                <div>
                                    {{ $info->description ?? '' }}
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
