@extends('crm.layouts.template')

@section('content')
    
<div class="container-fluid">
                        
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard', $companyCode) }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"> Pages </li>
                    </ol>
                </div>
                <h4 class="page-title">Add New Page</h4>
            </div>
        </div>
        <div class="col-12 p-0">
            <div class="row m-0">
                <div class="col-12" id="error">
                </div>
            </div>  
            <form class="form-horizontal account_form" enctype="multipart/form-data" id="account_form">
                @csrf
                @include('crm.cms.form-inputs')
            </form> 
        </div>
    </div> 
</div>
<!-- SimpleMDE js -->
@endsection
@section('add_on_script')
    @include('crm.cms.assets')
    <script> 
        $('#account_form').submit(function(e) {
            e.preventDefault();
        
            let formData = new FormData(this);
            $('#error').html("");
            $('#error').removeClass("alert alert-danger");
            $('#error').removeClass("alert alert-success");
            $.ajax({
                type:'POST',
                url: '{{ route("pages.update" , [$companyCode, $result->id]) }}',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.loader').show();
                },
                success: (response) => {
                    if( response.status == '1') {
                        $('#error').addClass('alert alert-danger');
                        $('#error').text(response.error);
                    } else {
                        $('#error').addClass('alert alert-success');
                        $('#error').text(response.success);
                        setTimeout(() => {
                            window.location.href="{{ route('pages', $companyCode) }}";                            
                        }, 300);
                    }
                    $('.loader').hide();
                },
                error: function(response){
                    
                }
            });
            return false;
        }) 
    </script>
@endsection
 