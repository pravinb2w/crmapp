@extends('crm.layouts.template')

@section('content')
<div class="container-fluid"> 
    <!-- start page title --> 
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Phoenix</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">DEALS</li>
                    </ol>
                </div>
                <h4 class="page-title">CRM</h4>
            </div>
        </div>
    </div>  
    <div class="row">
        <div class="col-12">
            <div class="board">
                <div class="tasks p-0" data-plugin="dragula" data-containers='["task-list-one", "task-list-two", "task-list-three", "task-list-four", "task-list-five"]'>
                    <h6 class="m-0 task-header bg-success text-white">Qualified </h6>
                    
                    <div id="task-list-one" class="task-list-items px-0">

                        <!-- Task Item -->
                        <div class="card m-1">
                            <div class="card-body p-2">
                                <small class="float-end text-muted">18 Jul 2018</small>
                                <span class="badge bg-danger">High</span>

                                <h6 class="mt-2 mb-2">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal" class="text-body">iOS App home page</a>
                                </h6>

                                <p class="mb-0">
                                    <span class="pe-2 text-nowrap mb-2 d-inline-block">
                                        <i class="mdi mdi-briefcase-outline text-muted"></i>
                                        iOS
                                    </span>
                                    <span class="text-nowrap mb-2 d-inline-block">
                                        <i class="mdi mdi-comment-multiple-outline text-muted"></i>
                                        <b>74</b> Comments
                                    </span>
                                </p>

                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical font-18"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-pencil me-1"></i>Edit</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-delete me-1"></i>Delete</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-plus-circle-outline me-1"></i>Add People</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-exit-to-app me-1"></i>Leave</a>
                                    </div>
                                </div>

                                <p class="mb-0">
                                    <img src="assets/images/users/avatar-2.jpg" alt="user-img" class="avatar-xs rounded-circle me-1" />
                                    <span class="align-middle">Robert Carlile</span>
                                </p>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- Task Item End -->

                        <!-- Task Item -->
                        <div class="card m-1">
                            <div class="card-body p-2">
                                <small class="float-end text-muted">18 Jul 2018</small>
                                <span class="badge bg-secondary text-light">Medium</span>

                                <h6 class="mt-2 mb-2">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal" class="text-body">Topnav layout design</a>
                                </h6>

                                <p class="mb-0">
                                    <span class="pe-2 text-nowrap mb-2 d-inline-block">
                                        <i class="mdi mdi-briefcase-outline text-muted"></i>
                                        Hyper
                                    </span>
                                    <span class="text-nowrap mb-2 d-inline-block">
                                        <i class="mdi mdi-comment-multiple-outline text-muted"></i>
                                        <b>28</b> Comments
                                    </span>
                                </p>

                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical font-18"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-pencil me-1"></i>Edit</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-delete me-1"></i>Delete</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-plus-circle-outline me-1"></i>Add People</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-exit-to-app me-1"></i>Leave</a>
                                    </div>
                                </div>

                                <p class="mb-0">
                                    <img src="assets/images/users/avatar-1.jpg" alt="user-img" class="avatar-xs rounded-circle me-1" />
                                    <span class="align-middle">Coder Themes</span>
                                </p>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- Task Item End -->

                        <!-- Task Item -->
                        <div class="card m-1">
                            <div class="card-body p-2">
                                <small class="float-end text-muted">11 Jul 2018</small>
                                <span class="badge bg-success">Low</span>

                                <h6 class="mt-2 mb-2">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal" class="text-body">Invite user to a project</a>
                                </h6>

                                <p class="mb-0">
                                    <span class="pe-2 text-nowrap mb-2 d-inline-block">
                                        <i class="mdi mdi-briefcase-outline text-muted"></i>
                                        CRM
                                    </span>
                                    <span class="text-nowrap mb-2 d-inline-block">
                                        <i class="mdi mdi-comment-multiple-outline text-muted"></i>
                                        <b>68</b> Comments
                                    </span>
                                </p>

                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical font-18"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-pencil me-1"></i>Edit</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-delete me-1"></i>Delete</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-plus-circle-outline me-1"></i>Add People</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-exit-to-app me-1"></i>Leave</a>
                                    </div>
                                </div>

                                <p class="mb-0">
                                    <img src="assets/images/users/avatar-3.jpg" alt="user-img" class="avatar-xs rounded-circle me-1" />
                                    <span class="align-middle">Lucas Hardy</span>
                                </p>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- Task Item End -->
                        
                    </div> <!-- end company-list-1-->
                </div> 
                <div class="tasks p-0">
                    <h6 class="m-0 task-header text-uppercase bg-warning text-white">Contact Made</h6>
                    
                    <div id="task-list-two" class="task-list-items px-0">

                        <!-- Task Item -->
                        <div class="card m-1">
                            <div class="card-body p-2">
                                <small class="float-end text-muted">22 Jun 2018</small>
                                <span class="badge bg-secondary text-light">Medium</span>

                                <h6 class="mt-2 mb-2">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal" class="text-body">Write a release note</a>
                                </h6>

                                <p class="mb-0">
                                    <span class="pe-2 text-nowrap mb-2 d-inline-block">
                                        <i class="mdi mdi-briefcase-outline text-muted"></i>
                                        Hyper
                                    </span>
                                    <span class="text-nowrap mb-2 d-inline-block">
                                        <i class="mdi mdi-comment-multiple-outline text-muted"></i>
                                        <b>17</b> Comments
                                    </span>
                                </p>

                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical font-18"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-pencil me-1"></i>Edit</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-delete me-1"></i>Delete</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-plus-circle-outline me-1"></i>Add People</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-exit-to-app me-1"></i>Leave</a>
                                    </div>
                                </div>

                                <p class="mb-0">
                                    <img src="assets/images/users/avatar-5.jpg" alt="user-img" class="avatar-xs rounded-circle me-1" />
                                    <span class="align-middle">Sean White</span>
                                </p>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- Task Item End -->

                        <!-- Task Item -->
                        <div class="card m-1">
                            <div class="card-body p-2">
                                <small class="float-end text-muted">19 Jun 2018</small>
                                <span class="badge bg-success">Low</span>

                                <h6 class="mt-2 mb-2">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal" class="text-body">Enable analytics tracking</a>
                                </h6>

                                <p class="mb-0">
                                    <span class="pe-2 text-nowrap mb-2 d-inline-block">
                                        <i class="mdi mdi-briefcase-outline text-muted"></i>
                                        CRM
                                    </span>
                                    <span class="text-nowrap mb-2 d-inline-block">
                                        <i class="mdi mdi-comment-multiple-outline text-muted"></i>
                                        <b>48</b> Comments
                                    </span>
                                </p>

                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical font-18"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-pencil me-1"></i>Edit</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-delete me-1"></i>Delete</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-plus-circle-outline me-1"></i>Add People</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-exit-to-app me-1"></i>Leave</a>
                                    </div>
                                </div>

                                <p class="mb-0">
                                    <img src="assets/images/users/avatar-6.jpg" alt="user-img" class="avatar-xs rounded-circle me-1" />
                                    <span class="align-middle">Louis Allen</span>
                                </p>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- Task Item End -->

                    </div> <!-- end company-list-2-->
                </div> 
                <div class="tasks p-0">
                    <h6 class="m-0 task-header text-uppercase bg-info text-white">Demo Schedulded</h6>
                    <div id="task-list-three" class="task-list-items px-0">

                        <!-- Task Item -->
                        <div class="card m-1">
                            <div class="card-body p-2">
                                <small class="float-end text-muted">2 May 2018</small>
                                <span class="badge bg-danger">High</span>

                                <h6 class="mt-2 mb-2">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal" class="text-body">Kanban board design</a>
                                </h6>

                                <p class="mb-0">
                                    <span class="pe-2 text-nowrap mb-2 d-inline-block">
                                        <i class="mdi mdi-briefcase-outline text-muted"></i>
                                        CRM
                                    </span>
                                    <span class="text-nowrap mb-2 d-inline-block">
                                        <i class="mdi mdi-comment-multiple-outline text-muted"></i>
                                        <b>65</b> Comments
                                    </span>
                                </p>

                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical font-18"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-pencil me-1"></i>Edit</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-delete me-1"></i>Delete</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-plus-circle-outline me-1"></i>Add People</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-exit-to-app me-1"></i>Leave</a>
                                    </div>
                                </div>

                                <p class="mb-0">
                                    <img src="assets/images/users/avatar-1.jpg" alt="user-img" class="avatar-xs rounded-circle me-1" />
                                    <span class="align-middle">Coder Themes</span>
                                </p>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- Task Item End -->

                        <!-- Task Item -->
                        <div class="card m-1">
                            <div class="card-body p-2">
                                <small class="float-end text-muted">7 May 2018</small>
                                <span class="badge bg-secondary text-light">Medium</span>

                                <h6 class="mt-2 mb-2">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal" class="text-body">Code HTML email template</a>
                                </h6>

                                <p class="mb-0">
                                    <span class="pe-2 text-nowrap mb-2 d-inline-block">
                                        <i class="mdi mdi-briefcase-outline text-muted"></i>
                                        CRM
                                    </span>
                                    <span class="text-nowrap mb-2 d-inline-block">
                                        <i class="mdi mdi-comment-multiple-outline text-muted"></i>
                                        <b>106</b> Comments
                                    </span>
                                </p>

                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical font-18"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-pencil me-1"></i>Edit</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-delete me-1"></i>Delete</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-plus-circle-outline me-1"></i>Add People</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-exit-to-app me-1"></i>Leave</a>
                                    </div>
                                </div>

                                <p class="mb-0">
                                    <img src="assets/images/users/avatar-9.jpg" alt="user-img" class="avatar-xs rounded-circle me-1" />
                                    <span class="align-middle">Zak Turnbull</span>
                                </p>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- Task Item End -->

                        <!-- Task Item -->
                        <div class="card m-1">
                            <div class="card-body p-2">
                                <small class="float-end text-muted">8 Jul 2018</small>
                                <span class="badge bg-secondary text-light">Medium</span>

                                <h6 class="mt-2 mb-2">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal" class="text-body">Brand logo design</a>
                                </h6>

                                <p class="mb-0">
                                    <span class="pe-2 text-nowrap mb-2 d-inline-block">
                                        <i class="mdi mdi-briefcase-outline text-muted"></i>
                                        Design
                                    </span>
                                    <span class="text-nowrap mb-2 d-inline-block">
                                        <i class="mdi mdi-comment-multiple-outline text-muted"></i>
                                        <b>95</b> Comments
                                    </span>
                                </p>

                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical font-18"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-pencil me-1"></i>Edit</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-delete me-1"></i>Delete</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-plus-circle-outline me-1"></i>Add People</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-exit-to-app me-1"></i>Leave</a>
                                    </div>
                                </div>

                                <p class="mb-0">
                                    <img src="assets/images/users/avatar-8.jpg" alt="user-img" class="avatar-xs rounded-circle me-1" />
                                    <span class="align-middle">Lily Parkin</span>
                                </p>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- Task Item End -->

                        <!-- Task Item -->
                        <div class="card m-1">
                            <div class="card-body p-2">
                                <small class="float-end text-muted">22 Jul 2018</small>
                                <span class="badge bg-danger">High</span>

                                <h6 class="mt-2 mb-2">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal" class="text-body">Improve animation loader</a>
                                </h6>

                                <p class="mb-0">
                                    <span class="pe-2 text-nowrap mb-2 d-inline-block">
                                        <i class="mdi mdi-briefcase-outline text-muted"></i>
                                        CRM
                                    </span>
                                    <span class="text-nowrap mb-2 d-inline-block">
                                        <i class="mdi mdi-comment-multiple-outline text-muted"></i>
                                        <b>39</b> Comments
                                    </span>
                                </p>

                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical font-18"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-pencil me-1"></i>Edit</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-delete me-1"></i>Delete</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-plus-circle-outline me-1"></i>Add People</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-exit-to-app me-1"></i>Leave</a>
                                    </div>
                                </div>

                                <p class="mb-0">
                                    <img src="assets/images/users/avatar-4.jpg" alt="user-img" class="avatar-xs rounded-circle me-1" />
                                    <span class="align-middle">Riley Steele</span>
                                </p>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- Task Item End -->

                    </div> <!-- end company-list-3-->
                </div> 
                <div class="tasks p-0">
                    <h6 class="m-0 task-header text-uppercase bg-primary text-white">Proposal Made</h6>
                    <div id="task-list-four" class="task-list-items px-0">

                        <!-- Task Item -->
                        <div class="card m-1">
                            <div class="card-body p-2">
                                <small class="float-end text-muted">16 Jul 2018</small>
                                <span class="badge bg-success">Low</span>

                                <h6 class="mt-2 mb-2">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal" class="text-body">Dashboard design</a>
                                </h6>

                                <p class="mb-0">
                                    <span class="pe-2 text-nowrap mb-2 d-inline-block">
                                        <i class="mdi mdi-briefcase-outline text-muted"></i>
                                        Hyper
                                    </span>
                                    <span class="text-nowrap mb-2 d-inline-block">
                                        <i class="mdi mdi-comment-multiple-outline text-muted"></i>
                                        <b>287</b> Comments
                                    </span>
                                </p>

                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical font-18"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-pencil me-1"></i>Edit</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-delete me-1"></i>Delete</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-plus-circle-outline me-1"></i>Add People</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-exit-to-app me-1"></i>Leave</a>
                                    </div>
                                </div>

                                <p class="mb-0">
                                    <img src="assets/images/users/avatar-10.jpg" alt="user-img" class="avatar-xs rounded-circle me-1" />
                                    <span class="align-middle">Harvey Dickinson</span>
                                </p>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- Task Item End -->
                        
                    </div> <!-- end company-list-4-->
                </div> 
                <div class="tasks p-0">
                    <h6 class="m-0 task-header text-uppercase bg-danger text-white">Negation Started</h6>
                    <div id="task-list-five" class="task-list-items px-0">

                        <!-- Task Item -->
                        <div class="card m-1">
                            <div class="card-body p-2">
                                <small class="float-end text-muted">16 Jul 2018</small>
                                <span class="badge bg-success">Low</span>

                                <h6 class="mt-2 mb-2">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#task-detail-modal" class="text-body">Dashboard design</a>
                                </h6>

                                <p class="mb-0">
                                    <span class="pe-2 text-nowrap mb-2 d-inline-block">
                                        <i class="mdi mdi-briefcase-outline text-muted"></i>
                                        Hyper
                                    </span>
                                    <span class="text-nowrap mb-2 d-inline-block">
                                        <i class="mdi mdi-comment-multiple-outline text-muted"></i>
                                        <b>287</b> Comments
                                    </span>
                                </p>

                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle text-muted arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical font-18"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-pencil me-1"></i>Edit</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-delete me-1"></i>Delete</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-plus-circle-outline me-1"></i>Add People</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-exit-to-app me-1"></i>Leave</a>
                                    </div>
                                </div>

                                <p class="mb-0">
                                    <img src="assets/images/users/avatar-10.jpg" alt="user-img" class="avatar-xs rounded-circle me-1" />
                                    <span class="align-middle">Harvey Dickinson</span>
                                </p>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- Task Item End -->
                        
                    </div> <!-- end company-list-4-->
                </div> 
            </div> <!-- end .board-->
        </div> <!-- end col -->
    </div>
    <!-- end row-->
</div> 
@endsection

@section('add_on_script')
    <script src="{{ asset('assets/js/vendor/dragula.min.js') }}"></script>
    <script src="{{ asset('assets/js/ui/component.dragula.js') }}"></script>
@endsection