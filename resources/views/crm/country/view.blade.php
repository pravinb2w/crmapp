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
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="table-light">
                                            <label for="">Country</label>
                                        </th>
                                        <td>
                                            <div>
                                                {{ $info->country_name ?? '' }}
                                            </div>
                                        </td>
                                    </tr>
                                    @if(isset( $info->dial_code) && !empty($info->dial_code))

                                    <tr>
                                        <th class="table-light">
                                            <label for="">Dial Code</label>
                                        </th>
                                        <td>
                                            <div>
                                                {{ $info->dial_code ?? '' }}
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    @if(isset( $info->country_code) && !empty($info->country_code))
                                    <tr>
                                        <th class="table-light">
                                            <label for="">Country Code</label>
                                        </th>
                                        <td>
                                            <div>
                                                {{ $info->country_code ?? '' }}
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    @if(isset( $info->iso) && !empty($info->iso))

                                    <tr>
                                        <th class="table-light">
                                            <label for="">ISO</label>
                                        </th>
                                        <td>
                                            <div>
                                                {{ $info->iso ?? '' }}
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    @if(isset( $info->currency) && !empty($info->currency))

                                    <tr>
                                        <th class="table-light">
                                            <label for="">Currency</label>
                                        </th>
                                        <td>
                                            <div>
                                                {{ $info->currency ?? '' }}
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <th class="table-light">
                                            <label for="">Description</label>
                                        </th>
                                        <td>
                                            {{ $info->description ?? '' }}
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                            
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
