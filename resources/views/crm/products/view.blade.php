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
                            <table class="table table-border">
                                <tr>
                                    <th> Product name</th>
                                    <td>{{ $info->product_name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Product code </th>
                                    <td>{{  $info->product_code ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Hsn No </th>
                                    <td>{{  $info->hsn_no ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Product Price </th>
                                    <td>{{  $info->price ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>Product Description </th>
                                    <td>{{  $info->description ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>CGST</th>
                                    <td>{{ $info->cgst ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>SGST</th>
                                    <td>{{ $info->sgst ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>IGST</th>
                                    <td>{{ $info->igst ?? '' }}</td>
                                </tr>
                            </table>
                            
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
