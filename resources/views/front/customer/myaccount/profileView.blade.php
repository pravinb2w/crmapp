<div class="card text-center">
    <div class="card-body">
        <img src="assets/images/users/noimage1.png" class="rounded-circle avatar-xxl img-border" alt="profile-image">
       
        <h4 class="mb-0 mt-2">Customer Name</h4>
        <p class="text-muted font-14">Company Name</p>

        <button type="button" class="btn btn-success btn-sm mb-2">
            <i class="mdi mdi-pen"></i>
        </button>
        <button type="button" class="btn btn-danger btn-sm mb-2">
            <i class="mdi mdi-delete"></i>
        </button>

        <div class="text-start mt-3">
            <h4 class="font-13 text-uppercase">About Me :</h4>
            
            <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> 
                <span class="ms-2">{{ $info->first_name ?? '' }} {{ $info->last_name ?? '' }}</span>
            </p>

            <p class="text-muted mb-2 font-13"><strong>Mobile :</strong>
                <span class="ms-2"> {{ $info->mobile_no ?? '' }} </span>
            </p>

            <p class="text-muted mb-2 font-13"><strong>Email :</strong> 
                <span class="ms-2 "> {{ $info->email ?? '' }} </span>
            </p>

            <p class="text-muted mb-1 font-13"><strong>Address :</strong> 
                <span class="ms-2"> {{ $info->address ?? 'N/A' }}</span>
            </p>
        </div>
        
    </div> <!-- end card-body -->
</div> <!-- end card -->
