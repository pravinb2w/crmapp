@php
// $path_name = str_replace(
//     '/',
//     '',
//     request()
//         ->route()
//         ->getAction()['prefix'],
// );
$path_name = \Request::route()->getName();
$path_name = empty($path_name) ? request()->route()->uri : $path_name;
// echo $path_name;
@endphp
<div class="row mb-2">
    <div class="col-sm-5">
    @if (Auth::user()->hasAccess($path_name, 'is_edit') && Auth::user()->hasLimit($path_name) )
        
            @if( isset( $is_add_exits ) && $is_add_exits == 'no' ) 
            @else
                @if (isset($btn_href) && !empty($btn_href))
                    <a href="{{ $btn_href }}" class="btn btn-secondary mb-2">
                    @else
                        <a href="javascript:void(0);" class="btn btn-secondary mb-2"
                            onclick="return get_add_modal('{{ $btn_fn_param }}');">
                @endif
                <i class="mdi mdi-plus-circle me-2"></i> Add {{ $btn_name }}</a>
            @endif
        
    @endif
</div>
    @php
        $not_in_export = array('workflow_automation', 'company')
    @endphp
    @if (Auth::user()->hasAccess($path_name, 'is_export') && !in_array(strtolower(str_replace(' ', '_', $btn_name)), $not_in_export ) )
        <div class="col-sm-7">
            <div class="text-sm-end">
                <a href="{{ route('export.' . strtolower(str_replace(' ', '_', $btn_name)), $companyCode) }}"
                    class="btn btn-success btn-sm"> <i class="fa fa-download"></i> Excel </a>
            </div>
        </div><!-- end col-->
    @endif
</div>
