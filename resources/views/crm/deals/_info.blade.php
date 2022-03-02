<div class="row  ">
    <style>
        .pipeline-loader {
            position: absolute;
            text-align: center;
            top: 50%;
        }
    </style>
    <div class="col-md-6 mb-3">
       <h3 class="h4 link"><a href="#" class="me-1">{{ $info->deal_title ?? '' }}</a> <i class="mdi mdi-tag"></i></h3>
        <div class="d-flex">
            <div class="btn ps-0"><b class="h4">{{ $info->deal_currency ?? '' }} {{ $info->deal_value ?? '' }}</b></div>
            <div class="btn link">{{ isset($info->deal_products) ? count($info->deal_products) : '0'; }} Products</div>
            <div class="btn"><i class="me-1 dripicons-user"></i> {{ $info->customer->first_name ?? '' }} </div>
            <div class="btn"><i class="me-1 mdi-office-building mdi"></i> {{ $info->customer->company->name ?? '' }}</div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="d-flex align-items-center justify-content-end">
           
            <div class="btn me-2 btn-success">Won</div>
            <div class="btn  me-2 btn-danger">Loss</div>
            <div class="btn  me-2 btn-info">Reopen</div>
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-dots-vertical"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mb-2" id="pipline-view">
        @include('crm.deals._pipeline_view')
    </div>
    <div class="pipeline-loader" style="display: none;">
        <div class="spinner-border text-primary" role="status"></div>
   </div>
</div>