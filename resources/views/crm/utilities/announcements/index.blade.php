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
                        <li class="breadcrumb-item active">Announcement</li>
                    </ol>
                </div>
                <h4 class="page-title">Announcement </h4>
            </div>
        </div>
    </div>     
    <div class="card">
        <div class="card-header text-end bg-light">
            <a href="{{ route("create.announcement") }}" class="btn btn-primary">New Announcement</a>
        </div>
        <div class="card-body">
            <div class="list-group">
                @foreach ($data as $row)
                    <li href="#" class="list-group-item list-group-item-action">
                        <div class="x-y d-between">
                            <h5 class="mb-1 text-capitalize">{{ $row->subject }}</h5>
                            <div>Created at : {{ $row->created_at }} </div>
                        </div>
                        <p class="mb-1 mt-1">
                            <div class="d-flex">
                                <a href="{{ route('edit.announcement', $row->id) }}" class="me-2"><i class="fa fa-pencil"></i> <u>Edit</u></a>
                            
                                <form method="post" action="{{ route('destroy.announcement', $row->id) }}">
                                    @csrf
                                    <a type="submit"  class="show_confirm text-danger"><i class="fa fa-trash"></i> <u>Delete</u></a>
                                </form>
                            </div>
                        </p>
                    </li>
                @endforeach  
            </div>
        </div>
        <div class="card-footer bg-light">
            {{ $data->links() }}
        </div>
    </div>
</div>
@endsection