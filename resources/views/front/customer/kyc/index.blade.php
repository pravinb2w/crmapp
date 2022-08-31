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
                        <form id="kycForm"  v-on:submit="submitKycForm"  >
                            @csrf
                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> 
                                KYC DOCUMENTS
                                <button type="button" class="btn btn-success btn-sm float-end" @click="addRowDocument" style="position: relative;top:-8px;"> Add + </button>
                            </h5>
                           
                            <div class="row" v-for="(kycItem, kycindex) in kycDocument" :key="kycindex">
                                <div class="col-5">
                                    <div class="mb-3">
                                        <select name="document_type[]" :class="[kycItem.document_id ? validClass : inValidClass, 'form-control']" v-if="!kycItem.customerDocumentId" v-model="kycItem.document_id" required >
                                            <option disabled value="">Please select one</option>
                                            <option v-for="doc in documentTypes" v-bind:disabled="isDisabled(doc)" v-bind:value="doc.id" >@{{ doc.type }}</option>
                                        </select>
                                        <input type="text" readonly name="document_type" v-model="kycItem.document_type" v-else class="form-control">

                                        <input type="hidden" name="document_id[]" v-if="!kycItem.image_url" v-model="kycItem.document_id">
                                        <input type="hidden" :name="'customerDocumentId_'+kycItem.document_id+''"  v-model="kycItem.customerDocumentId">
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="mb-3">
                                        <div class="input-group" v-if="!kycItem.image_url" >
                                            <span class="input-group-text"><i class="mdi mdi-file"></i></span>
                                            <input type="file" :name="'file_'+kycItem.document_id+''" ref="file"  @change="fileChange($event,kycindex)" required class="form-control" :class="kycItem.document ? validClass : inValidClass" id="social-fb" placeholder="Number here..">
                                        </div>
                                        <div v-else class="text-center mt-1">
                                            <a :href="kycItem.image_url" target="_blank" rel="noopener noreferrer">View File</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2 d-flex" id="tooltip-container2">
                                    
                                    <a v-if="kycItem.document_status == 'rejected'" href="javascript: void(0);" class="social-list-item border-danger text-danger" data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" data-bs-placement="top" title="Verification Rejected">
                                        <i class="mdi mdi-close valid-doc"></i>
                                    </a>
                                   
                                    <a v-if="kycItem.document_status == 'approved'" href="javascript: void(0);" class="social-list-item border-success text-success mx-2"  data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" data-bs-placement="top" title="Approved Successfully">
                                        <i class="mdi mdi-check valid-doc"></i>
                                    </a>
                                    <a v-if="kycItem.document_status == 'pending'" href="javascript: void(0);" class="social-list-item border-warning text-warning mx-2"  data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" data-bs-placement="top" title="Approval Pending">
                                        <i class="mdi mdi-refresh valid-doc"></i>
                                    </a>
                                    <a v-if="kycItem.document_status == 'rejected'" href="javascript: void(0);"  class="social-list-item border-success text-success" data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" data-bs-placement="top" title="Reupload">
                                        <i class="mdi mdi-upload valid-doc"></i>
                                    </a>

                                    <a v-if="kycItem.document_status == 'rejected' || kycItem.document_status == 'pending'" @click="reuploadDocument(kycindex)" href="javascript: void(0);" class="social-list-item border-success text-success" data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" data-bs-placement="top" title="Reupload or Change file">
                                        <i class="mdi mdi-upload valid-doc"></i>
                                    </a>
                                    <template v-if="!kycItem.document_status" >
                                        <a href="javascript: void(0);" class="social-list-item border-info text-info" data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" data-bs-placement="top" title="File not upload">
                                            <i class="mdi mdi-upload valid-doc"></i>
                                        </a>
                                        <a  href="javascript: void(0);" @click="deleteRowDocument(kycindex)" class="social-list-item border-danger text-danger mx-2"  data-bs-container="#tooltip-container2" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to Delete Document">
                                            <i class="mdi mdi-delete valid-doc"></i>
                                        </a>
                                    </template>
                                    
                                </div>
                            </div>
                               
                            <div class="text-end">
                                <button type="submit" :disabled="gotkycFormResponse ? false : true" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- end settings content-->
                    
                </div> <!-- end tab-content -->
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
</div>