<div class="row">
    <div class="col-xl-4 col-lg-5">
        <div class="card text-center">
            <div class="card-body">
                <h4 class="header-title mb-3">Last Order Summary</h4>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                        <tr>
                            <th>Description</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Product :</td>
                                <td> Premium</td>
                            </tr>
                        <tr>
                            <td>Grand Total :</td>
                            <td>INR 1641</td>
                        </tr>
                        <tr>
                            <td>Invoice No</td>
                            <td>INV/2022/1020</td>
                        </tr>
                        <tr>
                            <td>Payment Status </td>
                            <td>Pending</td>
                        </tr>
                        <tr>
                            <th>Order Status :</th>
                            <th>Pending</th>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- end table-responsive -->

            </div> <!-- end card-body -->
        </div> <!-- end card -->

        <div class="card text-center">
            <div class="card-body">
                <h4 class="header-title mb-3">Payment Pending Order</h4>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Order Info</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> 25/06/2022 :</td>
                                <td> INV/2022/1020</td>
                                <td> INR 1020</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- end table-responsive -->

            </div> <!-- end card-body -->
        </div> <!-- end card -->

        <div class="card text-center">
            <div class="card-body">
                <h4 class="header-title mb-3">Pending Approval</h4>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Order Info</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> 25/06/2022 :</td>
                                <td> INV/2022/1020</td>
                                <td> INR 1020</td>
                                <td> 
                                    <a href="javascript:void(0);" class="btn btn-sm btn-success"> Approve</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- end table-responsive -->

            </div> <!-- end card-body -->
        </div> <!-- end card -->

    </div> <!-- end col-->

    <div class="col-xl-8 col-lg-7">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> 
                    Customer Orders
                </h5>
                <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                    <thead>
                        <tr>
                            <th>Invoice No</th>
                            <th>Invoice Date</th>
                            <th>Due Date</th>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Amount</th>
                            <th>Payment Status</th>
                            <th>Order Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>INV/2022/0098</td>
                            <td>25/6/2022</td>
                            <td>25/12/2022</td>
                            <td>Premium</td>
                            <td>1</td>
                            <td>500</td>
                            <td>Pending</td>
                            <td>Approved</td>
                        </tr>
                        <tr>
                            <td>INV/2022/0102</td>
                            <td>25/6/2022</td>
                            <td>25/12/2022</td>
                            <td>Standard</td>
                            <td>1</td>
                            <td>500</td>
                            <td>Failed</td>
                            <td>Cancelled</td>
                        </tr>
                        <tr>
                            <td>INV/2022/0098</td>
                            <td>25/6/2022</td>
                            <td>25/12/2022</td>
                            <td>Mega </td>
                            <td>1</td>
                            <td>500</td>
                            <td>Failed</td>
                            <td>Cancelled</td>
                        </tr>
                    </tbody>
                </table>
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
</div>