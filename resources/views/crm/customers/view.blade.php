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
                            <div class="col-3 mt-1">
                                <label for="">First Name</label>
                                <div>
                                    {{ $info->first_name ?? '' }}
                                </div>
                            </div>
                            <div class="col-3">
                                <label for="">Last Name</label>
                                <div>
                                    {{ $info->last_name ?? '' }}
                                </div>
                            </div>
                            <div class="col-3">
                                <label for="">Phone Number</label>
                                <div>
                                    {{ $info->mobile_no ?? '' }}
                                </div>
                            </div>
                            <div class="col-3">
                                <label for="">Email</label>
                                <div>
                                    {{ $info->email ?? '' }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="">Organization</label>
                                {{ $info->company->name ?? 'N/A' }}
                            </div>
                        </div>
                        <div class="row">
                            
                            @if( isset( $info->secondary_mobile ) && count($info->secondary_mobile) > 0 )
                            <div class="col-6">
                                <label for=""> Secondary Phone Number </label>
                                <div>
                                @foreach ($info->secondary_mobile as $item)
                                    <div>
                                        {{ $item->mobile_no ?? '' }}
                                    </div>
                                @endforeach
                                </div>
                            @endif
                            
                            @if( isset( $info->secondary_email ) && count($info->secondary_email) > 0 )
                            <div class="col-6">
                                <label for=""> Secondary Email </label>
                                <div>
                                    @foreach ($info->secondary_email as $item)
                                        <div>
                                            {{ $item->email ?? '' }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                            
                            <div class="col-md-12 mb-3 text-end">
                                <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal" aria-label="Close"> Close</button>
                            </div>
                        </div>  
                    </div>
                </div>
            </form>
        </div>
    </div><!-- /.modal-content -->
</div>
