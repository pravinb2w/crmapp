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
                            <thead class="table-light">
                                <tr>
                                    <th>S.No</th>
                                    <th class="all">Page Name</th>
                                    <th>Page Logo</th>
                                    <th>Created at</th>
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
                                            <td>{{ $row->created_at }}</td>
                                            <td>
                                                @if ($row->status == 1)
                                                    <span class="badge bg-success"> Active </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('pages.edit', $row->id) }}" class="action-icon"><i class="mdi mdi-square-edit-outline"></i></a>
                                                <a href="#" class="action-icon"><i class="mdi mdi-delete"></i> </a>
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

 