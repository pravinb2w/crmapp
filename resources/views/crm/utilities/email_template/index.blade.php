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
                        <li class="breadcrumb-item active">Email Templates</li>
                    </ol>
                </div>
                <h4 class="page-title">Email Templates</h4>
            </div>
        </div>
    </div>     
    <div class="text-end">
        @if( $email_count < Auth::user()->hasLimit('template'))
        <a href="{{ route('create.email_template', $companyCode) }}" class="btn btn-sm btn-primary mb-2">+ Add Template</a>
        @endif
    </div>
    <div class="card border shadow">
        <div class="card-body p-0">
            <div class="list-group">
                <li href="#" class="list-group-item list-group-item-action active">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Email Templates</h5>
                        <small class="text-white">10 templates</small>
                    </div> 
                </li>
                @foreach ($data as $row)
                    <li href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $row->title }}</h5>
                            <small class="text-muted"><b>Created by :</b> {{ $row->created_by }} <br> {{ $row->created_at }} </small>
                        </div>
                        <p class="mb-1 mt-1">
                            <div class="d-flex">
                                <a href="{{ route('edit.email_template', [ 'id' => $row->id, 'companyCode' => $companyCode ]) }}" class="me-2"><i class="fa fa-pencil"></i> <u>Edit</u></a>
                            
                                <form method="post" action="{{ route('delete.email_template', [ 'id' => $row->id, 'companyCode' => $companyCode]) }}">
                                    @csrf
                                    <a type="submit"  class="show_confirm text-danger"><i class="fa fa-trash"></i> <u>Delete</u></a>
                                </form>
                            </div>
                        </p>
                    </li>
                @endforeach  
            </div>
        </div>
        {{ $data->links() }}
    </div>
</div>  

@endsection
