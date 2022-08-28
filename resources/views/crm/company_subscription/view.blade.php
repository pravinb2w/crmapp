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
                                            <label for="">Subscription Name</label>
                                        </th>
                                        <td>
                                            <div>
                                                {{ $info->subscription->subscription_name ?? '' }}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="table-light">
                                            <label for="">Description</label>
                                        </th>
                                        <td>
                                            <div>
                                                {{ $info->description ?? '' }}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="table-light">
                                            <label for=""> Start At</label>
                                        </th>
                                        <td>
                                            <div>
                                                {{ date( 'd M, Y', strtotime($info->startAt)) ?? '' }}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="table-light">
                                            <label for="">End At</label>
                                        </th>
                                        <td>
                                            <div>
                                                {{ date( 'd M, Y', strtotime($info->endAt)) ?? '' }}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="table-light">
                                            <label for="">Total Amount</label>
                                        </th>
                                        <td>
                                            <div>
                                                {{ $info->total_amount }}
                                            </div>
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
