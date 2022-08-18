<div class="row">
    <div class="col-xl-4 col-lg-5">
        @include('front.customer.myaccount.profileView')
    </div> <!-- end col-->

    <div class="col-xl-8 col-lg-7">
        <div class="card">
            <div class="card-body">
                <div class="tab-content">
                    <!-- end timeline content-->
                    <div class="tab-pane show active" id="kyc">
                        <form>
                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> 
                                KYC DOCUMENTS
                                <button type="button" class="btn btn-success btn-sm float-end" style="position: relative;top:-8px;"> Add + </button>
                            </h5>
                           
                            <div class="row">
                                <div class="col-5">
                                    <div class="mb-3">
                                        <select name="kyc" id="" class="form-control">
                                            <option value="">--select--</option>
                                            <option value="driving_licence">Driving License</option>
                                            <option value="pan_card">PAN Card</option>
                                            <option value="aadhar">Aadhar</option>
                                            <option value="voter_id">Voter Id</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="mdi mdi-phone"></i></span>
                                            <input type="file" name="file" class="form-control" id="social-fb" placeholder="Number here..">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 d-flex" id="tooltip-container2">
                                    <a href="javascript: void(0);" class="social-list-item border-danger text-danger" data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" data-bs-placement="top" title="Verification Rejected">
                                        <i class="mdi mdi-close valid-doc"></i>
                                    </a>
                                    <a href="javascript: void(0);" class="social-list-item border-danger text-danger mx-2"  data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to Delete Document">
                                        <i class="mdi mdi-delete valid-doc"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <div class="mb-3">
                                        <select name="kyc" id="" class="form-control">
                                            <option value="">--select--</option>
                                            <option value="driving_licence">Driving License</option>
                                            <option value="pan_card">PAN Card</option>
                                            <option value="aadhar">Aadhar</option>
                                            <option value="voter_id">Voter Id</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="mdi mdi-phone"></i></span>
                                            <input type="file" name="file" class="form-control" id="social-fb" placeholder="Number here..">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 d-flex" id="tooltip-container">
                                    <a href="javascript: void(0);" class="social-list-item border-warning text-warning" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="top" title="Verification Pending">
                                        <i class="mdi mdi-refresh valid-doc"></i>
                                    </a>
                                    <a href="javascript: void(0);" class="social-list-item border-danger text-danger mx-2" data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to Delete Document">
                                        <i class="mdi mdi-delete valid-doc"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <div class="mb-3">
                                        <select name="kyc" id="" class="form-control">
                                            <option value="">--select--</option>
                                            <option value="driving_licence">Driving License</option>
                                            <option value="pan_card">PAN Card</option>
                                            <option value="aadhar">Aadhar</option>
                                            <option value="voter_id">Voter Id</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="mdi mdi-phone"></i></span>
                                            <input type="file" name="file" class="form-control" id="social-fb" placeholder="Number here..">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 d-flex" id="tooltip-container1">
                                    <a href="javascript: void(0);" class="social-list-item border-success text-success" data-bs-container="#tooltip-container1" data-bs-toggle="tooltip" data-bs-placement="top" title="Document verified successfully">
                                        <i class="mdi mdi-check valid-doc"></i>
                                    </a>
                                </div>
                            </div>
                               
                            <div class="text-end">
                                <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- end settings content-->
                    
                </div> <!-- end tab-content -->
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
</div>