<script src="https://unpkg.com/vue@next"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/vue-router"></script>
<div id="app">
    <form >
        <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> Personal Info</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" name="first_name" id="firstname" value="{{ $info->first_name ?? '' }}" placeholder="Enter first name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="last_name" id="lastname" value="{{ $info->last_name ?? '' }}" placeholder="Enter last name">
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="useremail" class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email" id="useremail" value="{{ $info->email ?? '' }}" placeholder="Enter email" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="usermobile" class="form-label">Mobile Number</label>
                    <input type="password" class="form-control" id="usermobile" placeholder="{{ $info->mobile_no }}" disabled>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                    <label for="userbio" class="form-label">Address</label>
                    <textarea class="form-control" id="userbio" rows="4" placeholder="Write something...">{{ $info->address ?? '' }}</textarea>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    
        <h5 class="mb-3 text-uppercase bg-light p-2">
            <i class="mdi mdi-phone me-1"></i> 
                Secondary Mobile Number
            <button type="button" @click="addSecondaryMobileNumberField" class="btn btn-success btn-sm float-end" style="position: relative;top:-8px;"> Add + </button>
        </h5>
        <div class="row">

            <div class="col-md-6" v-for="item in secondaryMobileData">
                <div class="mb-3">
                    <div class="input-group hover-group" @mouseover="item.delete = true" @mouseleave="item.delete = false">
                        <span class="input-group-text"><i class="mdi mdi-phone"></i></span>
                        <input type="text" class="form-control" name="secondary_phone[]" required v-model="item.phoneNumber" id="social-fb" placeholder="Number here..">
                        <span :class="[{'d-none': !item.delete}, 'input-group-text bg-danger text-white delete-group']" @click="deleteSecondaryMobileNumberField"><i class="mdi mdi-delete"></i></span>

                    </div>
                </div>
            </div>
            
        </div> <!-- end row -->
    
        <h5 class="mb-3 text-uppercase bg-light p-2">
            <i class="mdi mdi-email me-1"></i> 
            Secondary Email
            <button type="button" @click="addSecondaryEmailField" class="btn btn-success btn-sm float-end" style="position: relative;top:-8px;"> Add + </button>
        </h5>
        <div class="row">

            <div class="col-md-6" v-for="eitem in secondaryEmailData">
                <div class="mb-3">
                    <div class="input-group hover-group" @mouseover="eitem.delete = true" @mouseleave="eitem.delete = false">
                        <span class="input-group-text"><i class="mdi mdi-email"></i></span>
                        <input type="text" v-model="eitem.email" name="secondary_email[]" class="form-control" id="social-fb" placeholder="Email here.." required>
                        <span :class="[{'d-none': !eitem.delete}, 'input-group-text bg-danger text-white delete-group']" @click="deleteSecondaryEmailField"><i class="mdi mdi-delete"></i></span>

                    </div>
                </div>
            </div>
            
        </div> <!-- end row -->
        
        <div class="text-end">
            <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i> Save</button>
        </div>
    </form>
</div>

<script>
    const { createApp } = Vue
    
    createApp({
      data() {
        return {
           
            secondaryMobileData: [{phoneNumber:'', delete:false}, {phoneNumber:'', delete:false}],
            secondaryEmailData: [{email:'', delete:false}, {email:'', delete:false}]
        }
      },
      methods: {
        addSecondaryMobileNumberField() {
            var phone_object = {phoneNumber: this.phoneNumber, delete:false};
            return this.secondaryMobileData.push(phone_object);
        },
        addSecondaryEmailField() {
            var email_object = {email: this.email, delete:false};
            return this.secondaryEmailData.push(email_object);
        },
        deleteSecondaryMobileNumberField(index) {
            this.secondaryMobileData.splice(index,1);
        },
        deleteSecondaryEmailField(index) {
            this.secondaryEmailData.splice(index,1);
        },

      }
    }).mount('#app')

   
</script>