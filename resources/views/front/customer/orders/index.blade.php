<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card text-center" v-if="orderDetails.lastOrder">
            <div class="card-body">
                <h4 class="header-title mb-3">Last Order Summary</h4>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th> Date </th>
                                <th> Order No </th>
                                <th> Invoice No </th>
                                <th> Product </th>
                                <th> Price </th>
                                <th> Qty </th>
                                <th> Payment Status </th>
                                <th> Order Status </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                   @{{ orderDetails.lastOrder.date }}
                                </td>
                                <td> @{{ orderDetails.lastOrder.orderNo }} </td>
                                <td> @{{ orderDetails.lastOrder.invoiceNo }}</td>
                                <td> @{{ orderDetails.lastOrder.product }} </td>
                                <td> @{{ orderDetails.lastOrder.price }} </td>
                                <td> @{{ orderDetails.lastOrder.qty }} </td>
                                <td>
                                    <h5>
                                        <span class="badge badge-success-lighten" v-if="orderDetails.lastOrder.payment_status == 'Paid'">

                                            <i class="mdi mdi-bitcoin"></i>
                                            @{{ orderDetails.lastOrder.payment_status }}
                                        </span>
                                        <span class="badge badge-danger-lighten" v-else>
                                            <i class="mdi mdi-bitcoin"></i>
                                            @{{ orderDetails.lastOrder.payment_status }}
                                        </span>
                                           
                                    </h5>
                                </td>
                                <td>
                                    <h5>
                                        <span class="badge badge-success-lighten" v-if="orderDetails.lastOrder.order_status == 'Completed'">
                                            <i class="mdi mdi-bitcoin"></i>
                                            @{{ orderDetails.lastOrder.order_status }} 
                                        </span>
                                        <span class="badge badge-danger-lighten" v-else>
                                            <i class="mdi mdi-bitcoin"></i>
                                            @{{ orderDetails.lastOrder.order_status }} 
                                        </span>
                                    </h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- end table-responsive -->

            </div> <!-- end card-body -->
        </div> <!-- end card -->

        <div class="card text-center" v-if="orderDetails.pendingApproval">
            <div class="card-body">
                <h4 class="header-title mb-3">Pending Invoice Approval</h4>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th> Date </th>
                                <th> Invoice No </th>
                                <th> Product </th>
                                <th> Price </th>
                                <th> Qty </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="pending in orderDetails.pendingApproval">
                                <td>
                                    @{{ pending.date }}
                                </td>
                                <td> @{{ pending.invoiceNo }}</td>
                                <td> @{{ pending.product }} </td>
                                <td> @{{ pending.price }} </td>
                                <td> @{{ pending.qty }} </td>
                                <td>
                                    <div class="col-auto" id="tooltip-container9">
                                        <!-- Button -->
                                        <a :href="pending.file"
                                            target="_blank" data-bs-container="#tooltip-container9"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                                            class="btn btn-link text-muted btn-lg px-1"
                                            data-bs-original-title="Download">
                                            <i class="uil uil-cloud-download"></i>
                                        </a>
                                        <a href="javascript:void(0);"
                                            @click="changeDocumentStatus( pending.id, 'approved')" title="Approve"
                                            class="btn btn-link text-success btn-lg px-1">
                                            <i class="uil uil-check"></i>
                                        </a>
                                        <a href="javascript:void(0);"
                                            @click="changeDocumentStatus( pending.id, 'rejected')"
                                            data-bs-container="#tooltip-container9" data-bs-toggle="tooltip"
                                            data-bs-placement="bottom" title=""
                                            class="btn btn-link text-danger btn-lg px-1"
                                            data-bs-original-title="Reject">
                                            <i class="uil uil-multiply"></i>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- end table-responsive -->

            </div> <!-- end card-body -->
        </div> <!-- end card -->

    </div> <!-- end col-->

    <div class="col-xl-12 col-lg-12" v-if="orderDetails.orderHistory">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>
                    Customer Orders
                </h5>
                <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                    <thead class="table-dark">
                        <tr>
                            <th>Invoice No</th>
                            <th>Invoice Date</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Amount</th>
                            <th>Payment Status</th>
                            <th>Order Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr  v-for="history in orderDetails.orderHistory">
                            <td> @{{ history.invoiceNo }}
                                <span>
                                    <a :href="history.file"
                                            target="_blank" data-bs-container="#tooltip-container9"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                                            class="btn btn-link text-muted btn-lg px-1"
                                            data-bs-original-title="Download">
                                            <i class="uil uil-cloud-download"></i>
                                        </a>
                                </span>
                            </td>
                            <td> @{{ history.date }}</td>
                            <td> @{{ history.product  }}</td>
                            <td> @{{ history.qty }}</td>
                            <td> @{{ history.price }}</td>
                            <td>
                                <h5>
                                    <span class="badge badge-success-lighten" v-if="orderDetails.lastOrder.payment_status == 'Paid'">
                                        <i class="mdi mdi-bitcoin"></i>
                                        @{{ history.payment_status }}
                                    </span>
                                    <span class="badge badge-danger-lighten" v-else>
                                        <i class="mdi mdi-bitcoin"></i>
                                        @{{ history.payment_status }}
                                    </span>
                                </h5>
                            </td>
                            <td>
                                <h5>
                                    <span class="badge badge-success-lighten" v-if="orderDetails.lastOrder.order_status == 'Completed'">
                                        <i class="mdi mdi-bitcoin"></i>
                                        @{{ history.order_status }} 
                                    </span>
                                    <span class="badge badge-danger-lighten" v-else>
                                        <i class="mdi mdi-bitcoin"></i>
                                        @{{ history.order_status }} 
                                    </span>
                                </h5>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
    <div class="col-xl-12 col-lg-12">
        <div class="card text-center" v-if="orderDetails.rejectedInvoice">
            <div class="card-body">
                <h4 class="header-title mb-3">Rejected Invoices</h4>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th> Date </th>
                                <th> Invoice No </th>
                                <th> Product </th>
                                <th> Price </th>
                                <th> Qty </th>
                                <th> Reject Reason </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="pending in orderDetails.rejectedInvoice">
                                <td>
                                    @{{ pending.date }}
                                </td>
                                <td> @{{ pending.invoiceNo }}</td>
                                <td> @{{ pending.product }} </td>
                                <td> @{{ pending.price }} </td>
                                <td> @{{ pending.qty }} </td>
                                <td> @{{ pending.reject_reason }} </td>
                                <td>
                                    <div class="col-auto" id="tooltip-container9">
                                        <!-- Button -->
                                        <a :href="pending.file"
                                            target="_blank" data-bs-container="#tooltip-container9"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                                            class="btn btn-link text-muted btn-lg px-1"
                                            data-bs-original-title="Download">
                                            <i class="uil uil-cloud-download"></i>
                                        </a>
                                        
                                    </div>
                                </td>

                            </tr>
                            
                        </tbody>
                    </table>
                </div>
                <!-- end table-responsive -->

            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div>
</div>
