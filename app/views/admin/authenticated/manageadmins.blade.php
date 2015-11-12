@extends('admin.authenticated.dashboard')
@section('admincontent')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Admin Roles</small> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="/9gag-admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Admin Roles</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div id="no-more-tables">
            <div class="adminslist">
                <table class="table table-bordered table-hover">
                    <thead class="cf">
                        <tr>
                            <th>
                                <b>Profile Picture</b>
                            </th>
                            <th>
                                <b>Name</b>
                            </th>
                            <th>
                                <b>Username</b>
                            </th>
                            <th>
                                <b>Role</b>
                            </th>
                            <th>
                                <b>Admin Since</b>
                            </th>
                            <td>
                                <b>Actions</b>
                            </td>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach($admins as $admin)
                        <tr>
                            <td>
                                <div class="profilepic">
                                    <img style="width: 50px;" src="{{$admin->dp_uri}}" >
                                </div>
                            </td>
                            <td>
                                {{$admin->name}}
                            </td>
                            <td>
                                {{$admin->username}}
                            </td>
                            <td>
                                @if($admin->type === "owner")
                                    Owner
                                @else
                                    Staff
                                @endif
                            </td>
                            <td>{{ date("Y-m-d", strtotime($admin->created_at)) }}</td>
                            <td>
                                @if($admin->approved == 0)
                                    <div class="access">       
                                        <button type="button" class="btn btn-primary approve" data-userid="{{$admin->username}}">Approve</button>
                                        <button type="button" class="btn btn-danger remove" data-userid="{{$admin->username}}">Remove</button>
                                    </div>
                                    @else
                                    @if($admin->type != "owner")
                                    <div class="access">
                                        <button type="button" class="btn btn-warning revoke" data-userid="{{$admin->username}}">Revoke</button>
                                        <button type="button" class="btn btn-danger remove" data-userid="{{$admin->username}}">Delete</button>
                                        
                                       
                                    </div>
                                    @endif
                                @endif
                            </td>
                        </tr>
                        
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
        </section>
        <!-- /.Left col -->
    </div>
    <!-- /.row (main row) -->
</section>
<!-- /.content -->
@stop