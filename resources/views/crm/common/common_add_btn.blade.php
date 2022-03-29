@php
    $path_name = str_replace("/","",request()->route()->getAction()['prefix'] );
    $path_name = (empty($path_name) ? request()->route()->uri : $path_name);
@endphp
@if(Auth::user()->hasAccess($path_name, 'is_edit')) 
<div class="row mb-2">
    <div class="col-sm-5">
        @if( isset($btn_href ) && !empty($btn_href) ) 
            <a href="{{ $btn_href }}" class="btn btn-secondary mb-2" >
        @else 
            <a href="javascript:void(0);" class="btn btn-secondary mb-2" onclick="return get_add_modal('{{ $btn_fn_param }}');">
        @endif
            <i class="mdi mdi-plus-circle me-2"></i> Add {{ $btn_name }}</a>
    </div>
    <div class="col-sm-7">
        <div class="text-sm-end">
            {{-- <button type="button" class="btn btn-success mb-2 me-1"><i class="mdi mdi-cog-outline"></i></button> --}}
            {{-- <button type="button" class="btn btn-light mb-2">Export</button> --}}
        </div>
    </div><!-- end col-->
</div>
@endif