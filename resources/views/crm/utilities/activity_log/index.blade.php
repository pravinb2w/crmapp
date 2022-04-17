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
                        <li class="breadcrumb-item active">Activiy Logs</li>
                    </ol>
                </div>
                <h4 class="page-title">Activiy Logs </h4>
            </div>
        </div>
    </div>     
    <div class="card">
        <div class="card-header text-end bg-light">
            <a href="{{ route("create.announcement") }}" class="btn btn-danger">Clear Logs</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Date </th>
                        <th>Staff </th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i=0; $i<30; $i++)
                        <tr>
                            <td>User Successfully Logged In [User Id: 1, Is Staff Member: No, IP: 103.251.217.72]</td>
                            <td>09/04/2022 7:57 AM</td>
                            <td>Herbert Bosco</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-light">
            
        </div>
    </div>
</div>
@endsection