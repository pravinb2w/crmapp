@php
$path_name = str_replace(
    '/',
    '',
    request()
        ->route()
        ->getAction()['prefix'],
);
$path_name = empty($path_name) ? request()->route()->uri : $path_name;
@endphp
<div class="row mb-2">

    @if (Auth::user()->hasAccess($path_name, 'is_edit'))
        <div class="col-sm-5">
            @if (isset($btn_href) && !empty($btn_href))
                <a href="{{ $btn_href }}" class="btn btn-secondary mb-2">
                @else
                    <a href="javascript:void(0);" class="btn btn-secondary mb-2"
                        onclick="return get_add_modal('{{ $btn_fn_param }}');">
            @endif
            <i class="mdi mdi-plus-circle me-2"></i> Add {{ $btn_name }}</a>
        </div>
    @endif
    @if (Auth::user()->hasAccess($path_name, 'is_edit') &&
        strtolower(str_replace(' ', '_', $btn_name)) != 'workflow_automation')
        <div class="col-sm-7">
            <div class="text-sm-end">
                <a href="{{ route('export.' . strtolower(str_replace(' ', '_', $btn_name))) }}"
                    class="btn btn-success btn-sm"> <i class="fa fa-download"></i> Excel </a>
            </div>
        </div><!-- end col-->
    @endif
</div>
