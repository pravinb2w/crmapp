
<div >
    <form v-on:submit="customerForm" v-for="(item, kindex) in customerInfo">
        @csrf
        <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Personal Info</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" :class="[item.first_name ? validClass : inValidClass, 'form-control']"  name="first_name" id="firstname" v-model="item.first_name" placeholder="Enter first name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="last_name" id="lastname" v-model="item.last_name" placeholder="Enter last name">
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="useremail" class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email" id="useremail" v-model="item.email" placeholder="Enter email" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="mobile_no" class="form-label">Mobile Number</label>
                    <input type="text" name="mobile_no" class="form-control" id="mobile_no" v-model="item.mobile_no" disabled>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <label for="userbio" class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="4" v-model="item.address" placeholder="Write something..."></textarea>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    
        <h5 class="mb-3 text-uppercase bg-light p-2">
            <i class="mdi mdi-phone me-1"></i> 
                Secondary Mobile Number
            <button type="button" @click="addSecondaryMobileNumberField(kindex)" class="btn btn-success btn-sm float-end" style="position: relative;top:-8px;"> Add + </button>
        </h5>
        <div class="row">

            <div class="col-md-6" v-for="(mobileData, index) in item.secondaryMobileData">
                <div class="mb-3">
                    <div class="input-group hover-group" @mouseover="mobileData.delete = true" @mouseleave="mobileData.delete = false">
                        <span class="input-group-text"><i class="mdi mdi-phone"></i></span>
                        <input type="text" @keypress="acceptNumber" :class="[mobileData.phoneNumber.length == 10 ? validClass : inValidClass, 'form-control']" name="secondary_phone[]" required v-model="mobileData.phoneNumber" id="social-fb" placeholder="Number here..">
                        <span :class="[{'d-none': !mobileData.delete}, 'input-group-text bg-danger text-white delete-group']" @click="deleteSecondaryMobileNumberField(kindex,index)"><i class="mdi mdi-delete"></i></span>
                    </div>
                </div>
            </div>
            
        </div> <!-- end row -->
    
        <h5 class="mb-3 text-uppercase bg-light p-2">
            <i class="mdi mdi-email me-1"></i> 
            Secondary Email
            <button type="button" @click="addSecondaryEmailField(kindex)" class="btn btn-success btn-sm float-end" style="position: relative;top:-8px;"> Add + </button>
        </h5>
        <div class="row">

            <div class="col-md-6" v-for="(eitem, index) in item.secondaryEmailData">
                <div class="mb-3">
                    <div class="input-group hover-group" @mouseover="eitem.delete = true" @mouseleave="eitem.delete = false">
                        <span class="input-group-text"><i class="mdi mdi-email"></i></span>
                        <input :key="index" type="text" :class="eitem.emailClass" @keyup="validateEmail(eitem)" v-model="eitem.email" name="secondary_email[]" id="social-fb" placeholder="Email here.." required>
                        <span :class="[{'d-none': !eitem.delete}, 'input-group-text bg-danger text-white delete-group']" @click="deleteSecondaryEmailField(kindex,index)"><i class="mdi mdi-delete"></i></span>
                    </div>
                </div>
            </div>
            
        </div> <!-- end row -->
        
        <div class="text-end">
            <button type="submit" class="btn btn-success mt-2" :disabled="(item.first_name && gotCustomerResponse) ? false : true">
                <i class="mdi mdi-content-save"></i> Save
            </button>
        </div>
    </form>
</div>

