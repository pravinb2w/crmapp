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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"> Pages </li>
                    </ol>
                </div>
                <h4 class="page-title">CMS Pages</h4>
            </div>
        </div>
        <div class="col-12">
             
            <div class="card">
                
                <div class="card-body"> 
                    @include('crm.common.common_add_btn')

                    <div class="table-responsive">
                        <table class="table table-centered w-100 dt-responsive nowrap" id="ladingPage-datatable">
                            <thead class="table-primary">
                                <tr>
                                    <th>S.No</th>
                                    <th class="all">Page Name</th>
                                    <th>Page Logo</th>
                                    <th>Link</th>
                                    <th>Created at</th>
                                    <th>Default Landing Page</th>
                                    <th>Status</th>
                                    <th style="width: 120px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($result)
                                    @foreach ($result as $key => $row)
                                        <tr>
                                            <th class="all" style="width: 20px;">
                                                {{ $key +1 }}
                                            </th>
                                            <td>{{ $row->page_title }}</td>
                                            <td><img src="{{  $row->page_logo }} "  height="40px" alt=""></td>
                                            <td>
                                                <div>
                                                    <label for="" id="">{{ route('landing.index', [$row->permalink]) }}</label>
                                                    <span role="button" onclick="return copy_link('{{ route('landing.index', [$row->permalink]) }}')"> <i class="fa fa-copy"></i></span>
                                                </div>
                                            </td>
                                            <td>{{ $row->created_at }}</td>
                                            <td>
                                                <span class="badge @if( $row->is_default_landing_page ) bg-success @else bg-danger @endif">@if( $row->is_default_landing_page ) Yes @else No @endif</span>
                                            </td>
                                            <td>
                                                @if ($row->status == 1)
                                                    <span class="badge bg-success"> Active </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(Auth::user()->hasAccess('pages', 'is_edit') )
                                                <a href="{{ route('pages.edit', $row->id) }}" class="action-icon"><i class="mdi mdi-square-edit-outline"></i></a>
                                                @endif
                                                @if(Auth::user()->hasAccess('pages', 'is_delete') )
                                                <a href="#" class="action-icon"><i class="mdi mdi-delete"></i> </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif                                 
                            </tbody>
                        </table>
                    </div>
               
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>
    </div> 
</div> 

@endsection

 