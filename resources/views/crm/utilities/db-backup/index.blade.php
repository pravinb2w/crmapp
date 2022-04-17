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
                        <li class="breadcrumb-item active">Data Base Backup</li>
                    </ol>
                </div>
                <h4 class="page-title">Data Base Backup </h4>
            </div>
        </div>
    </div>
    <form class="text-end" action="{{ route('create.backup') }}" method="POST" >
        @csrf
        <button type="submit" class="btn btn-sm btn-primary mb-2">+ Create Backup</button>
    </form>
    <div class="card">
        <div class="card-header">
            <h5>Database Backup</h5>
        </div>
        <div class="card-body">
            @if ($data)
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Backup Name</th>
                            <th>File Size</th>
                            <th>Backup By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                        <tr>
                            <td scope="row">{{ $row->created_at }}</td>
                            <td>{{ str_replace(".sql", " " ,$row->file_name) }}</td>
                            <td>{{ $row->file_size }} KB</td>
                            <td>{{ $row->created_by }}</td>
                            <td>
                                <div class="x-y">
                                    <form action="{{ route('download.database-backup',$row->id) }}" method="POST" class="me-2">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-info"><i class="mdi-download mdi"></i></button>
                                    </form>
                                    <form action="{{ route('delete.database-backup', $row->id) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="show_confirm  btn btn-sm btn-danger"><i class="mdi-trash-can mdi"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr> 
                        @endforeach
                    </tbody>
                </table>
                @else
                No Backup Found
            @endif
        </div>
        <div class="card-footer bg-light">
            {!! $data->links() !!}
        </div>
    </div>
</div>
@endsection