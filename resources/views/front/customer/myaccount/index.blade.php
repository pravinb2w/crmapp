<div class="row">
    <div class="col-xl-4 col-lg-5">
        @include('front.customer.myaccount.profileView')
    </div> <!-- end col-->

    <div class="col-xl-8 col-lg-7">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                    <li class="nav-item profile">
                        <a href="#profile" data-bs-toggle="tab" data-id="profile" aria-expanded="false" class="nav-link rounded-0 active profile-tabe">
                            Profile
                        </a>
                    </li>
                    <li class="nav-item profile">
                        <a href="#company" data-bs-toggle="tab" data-id="company" aria-expanded="false" class="nav-link rounded-0 profile-tabe">
                            Company
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane  show active" id="profile-tabe-view">
                        @include('front.customer.myaccount._profileForm')
                    </div>
                </div> <!-- end tab-content -->
            </div> <!-- end card body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
</div>