<div class="card text-center">
    <div class="card-body">
        <img :src="profileImage" :class="[gotProfilePicResponse ? '' : 'blur', 'rounded-circle avatar-xxl img-border']" alt="profile-image">
       
        <h4 class="mb-0 mt-2"  v-for="customer in customerInfo">@{{ customer.first_name }}</h4>
        <p class="text-muted font-14"  v-for="company in companyInfo">@{{ company.name }}</p>

        <button type="button" class="btn btn-success btn-sm mb-2" @click="$refs.file.click()">
            <input type="file" ref="file" name="profilePicture"  @change="changeProfilePicture" style="display: none">
            <i class="mdi mdi-pen" ></i>
        </button>
        <button type="button" class="btn btn-danger btn-sm mb-2 mx-2" @click="removeProfilePicture">
            <i class="mdi mdi-delete"></i>
        </button>

        <div class="text-start mt-3" v-for="customer in customerInfo">
            <h4 class="font-13 text-uppercase">About Me :</h4>
            
            <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> 
                <span class="ms-2">@{{ customer.first_name }} @{{ customer.last_name }}</span>
            </p>

            <p class="text-muted mb-2 font-13"><strong>Mobile :</strong>
                <span class="ms-2"> @{{ customer.mobile_no }} </span>
            </p>

            <p class="text-muted mb-2 font-13"><strong>Email :</strong> 
                <span class="ms-2 "> @{{ customer.email }} </span>
            </p>

            <p class="text-muted mb-1 font-13"><strong>Address :</strong> 
                <span class="ms-2"> @{{  customer.address }}</span>
            </p>
        </div>
        
    </div> <!-- end card-body -->
</div> <!-- end card -->
