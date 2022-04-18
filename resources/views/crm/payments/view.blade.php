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
                            <table>
                                <tr>
                                    <th>Payment Date</th>
                                    <td> {{ date('d/M/Y h:i A', strtotime($info->created_at )) }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Mode</th>
                                    <td>{{ ucfirst($info->payment_mode) }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Method</th>
                                    <td>{{ ucfirst($info->payment_method) }}</td>
                                </tr>
                                <tr>
                                    <th>Amount</th>
                                    <td>{{ $info->amount }}</td>
                                </tr>
                                <tr>
                                    <th>Customer</th>
                                    <td>{{ $info->customer->first_name }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Status</th>
                                    <td>{{ ucfirst($info->payment_status) }}</td>
                                </tr>
                                <tr>
                                    <th>Transaction Details</th>
                                    <td>
                                        @if(isset($info->reference_no) && !empty($info->reference_no))
                                        <div>
                                            Reference No: {{ $info->reference_no }}
                                        </div>
                                        @endif
                                        @if(isset($info->cheque_no) && !empty($info->cheque_no))
                                        <div>
                                            Cheque No: {{ $info->cheque_no }}
                                        </div>
                                        @endif
                                        @if(isset($info->cheque_date) && !empty($info->cheque_date))
                                        <div>
                                            Cheque Date: {{ date('d/M/Y', strtotime($info->cheque_date)) }}
                                        </div>
                                        @endif
                                    </td>
                                </tr>
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
