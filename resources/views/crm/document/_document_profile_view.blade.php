<div class="card-body">
    <img src="{{ $info->customer->logo ? asset('storage/'.$info->customer->logo) : asset('assets/images/users/noimaged.png') }}" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

    <h4 class="mb-0 mt-2">{{ $info->customer->first_name.' '.$info->customer->last_name }}</h4>
    <p class="text-muted font-14">{{ $info->customer->company->name ?? '' }}</p>


    <div class="text-start mt-3">
        <h4 class="font-13 text-uppercase">About Me :</h4>
      
        <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> 
            <span class="ms-2">
                {{ $info->customer->first_name. ' '.$info->customer->last_name }}
           </span>
        </p>

        <p class="text-muted mb-2 font-13"><strong>Mobile :</strong>
            <span class="ms-2">
                {{ $info->customer->mobile_no }}
            </span>
        </p>

        <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ms-2 ">{{ $info->customer->email }}</span></p>

        <p class="text-muted mb-1 font-13"><strong>Location :</strong> <span class="ms-2">{{ $info->customer->address ?? 'N/A' }}</span></p>
    </div>

    <ul class="social-list list-inline mt-3 mb-0">
        @if( $info->customer->company->links->facebook_url )
        <li class="list-inline-item">
            <a href="{{ $info->customer->company->links->facebook_url }}" target="_blank" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
        </li>
        @endif
        @if( $info->customer->company->links->twitter_url )
       
        <li class="list-inline-item">
            <a href="{{  $info->customer->company->links->twitter_url }}" target="_blank" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
        </li>
        @endif
        @if( $info->customer->company->links->instagram_url )
       
        <li class="list-inline-item">
            <a href="{{  $info->customer->company->links->instagram_url }}" target="_blank" class="social-list-item border-danger text-danger"><i class="mdi mdi-instagram"></i></a>
        </li>
        @endif
        @if( $info->customer->company->links->linkedin_url )
       
        <li class="list-inline-item">
            <a href="{{  $info->customer->company->links->linkedin_url }}" target="_blank" class="social-list-item border-warnig text-warnig"><i class="mdi mdi-linkedin"></i></a>
        </li>
        @endif
       
    </ul>
</div> <!-- end card-body -->