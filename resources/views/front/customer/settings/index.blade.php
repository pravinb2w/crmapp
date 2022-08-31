<div class="row">
    <div class="col-xl-4 col-lg-5">
        @include('front.customer.myaccount.profileView')
    </div> <!-- end col-->

    <div class="col-xl-8 col-lg-7">
        <div v-if="formError" class="alert alert-danger" role="alert">
            @{{ formError }}
        </div>
        <div v-if="formSuccess" class="alert alert-success" role="alert">
            @{{ formSuccess }}
        </div> 
        <div class="card">
            <div class="card-body">
                <div class="tab-content">
                    <!-- end timeline content-->
                    <div class="tab-pane show active" >
                        <form @submit="submitPassword" ref="passForm" >
                            @csrf
                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> 
                                Change Password
                            </h5>
                           
                            <div class="row">
                               
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="input-group input-group-merge">
                                            <input id="password" placeholder="New Password" type="password" :class="[passwordFields.password.length > 7 ? validClass : inValidClass, 'form-control']" name="password"  v-model="passwordFields.password" required >
                                            
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                          
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <div class="input-group input-group-merge">
                                            <input id="password" placeholder="Confirm Password" type="password" :class="[passwordFields.confirmPassword == passwordFields.password && passwordFields.confirmPassword.length > 7 ? validClass : inValidClass, 'form-control']" v-model="passwordFields.confirmPassword"  name="confirmPassword" required >
                                            
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                          
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                               
                            <div class="text-end">
                                <button type="submit" onclick="" class="btn btn-success mt-2"  :disabled="(passwordFields.password == passwordFields.confirmPassword && passwordFields.password.length > 7 && gotPasswordResponse) ? false : true">
                                    <i class="mdi mdi-content-save"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- end settings content-->
                    
                </div> <!-- end tab-content -->
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
</div>