<div class="row  ">
    <div class="col-md-6 mb-3">
       <h3 class="h4 link"><a href="#" class="me-1">{{ $info->lead_title ?? $info->lead_subject }}</a> <i class="mdi mdi-tag"></i></h3>
        <div class="d-flex">
            @if( isset($info->lead_value ) && !empty($info->lead_value))
            <div class="btn ps-0"><b class="h4">RS.{{ $info->lead_value }}</b></div>
            @endif
            <div class="btn link">5 Products</div>
            <div class="btn"><i class="me-1 dripicons-user"></i> {{ $info->customer->first_name ?? '' }} {{ $info->customer->email ?? '' }}</div>
            <div class="btn"><i class="me-1 mdi-office-building mdi"></i> {{ $info->customer->company->name ?? '' }}</div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="d-flex align-items-center justify-content-end">
            
            <div class="btn me-2 btn-success">Accept</div>
            <div class="btn  me-2 btn-danger">Reject</div>
            
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-dots-vertical"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Edit Lead</a>
                    <a class="dropdown-item" href="#">Delete Lead</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-2"> 
        
        <div class="form-group">
            
        </div>
    </div>
</div>