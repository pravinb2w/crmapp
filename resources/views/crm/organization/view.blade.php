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
                                <tr>
                                    <th>
                                        Company Name
                                    </th>
                                    <td>
                                        {{ $info->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Phone Number
                                    </th>
                                    <td>
                                        {{ ($info->dial_code).$info->mobile_no ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>
                                        {{ $info->email ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>
                                        {{ $info->address ?? '' }}
                                    </td>
                                </tr>
                            </table>
                            
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
