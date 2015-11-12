@extends('admin.authenticated.dashboard')

@section('admincontent')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small><b>Registered Users ({{User::all()->count()}})</b></small> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="/9gag-admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Registered Users </li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        
        <div id="no-more-tables">
            <div class="userslist">
                <div class="header">
                    <div class="sortusers">
                        <form class="form-inline user-list-form">
                            <div class="form-group">
                                
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                    <input type="text" class="form-control" id="sort-users-list" placeholder="Username">
                                      
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <table class="table table-bordered table-hover">
                    <thead class="cf">
                        <tr>
                            <td>
                                <b>Profile Picture</b>
                            </td>
                            <th>
                                <b>Username</b>
                            </th>
                            <th>
                                <b>Email</b>
                            </th>
                            <th>
                                <b>Member Since</b>
                            </th>
                            <td>
                                <b>Actions</b>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <div class="profilepic">
                                        <img style="width: 50px;" src="{{$user->dp_uri}}" >
                                    </div>
                                </td>
                                <td>
                                    
                                    
                                    <a class="username" target="_blank" href="/s/{{$user->username}}">{{$user->username}}</a>
                                </td>
                                <td>
                                    {{$user->email}}
                                </td>
                                <td>{{ date("Y-m-d", strtotime($user->created_at)) }}</td>
                                <td>
                                    
                                    @if($user->ban == 0)
                                    <button type="button" class="btn btn-warning banuser" data-username="{{$user->username}}">Ban User</button>
                                    @elseif($user->ban == 1 )
                                    <button type="button" class="btn btn-primary unbanuser" data-username="{{$user->username}}">Unban User</button>
                                    @endif
                                    <button type="button" class="btn btn-danger deleteuser" data-username="{{$user->username}}">Delete User</button>
                                    
                                </td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                    
                </table>
                    
                
            </div>
        </div>
        
        <div class="links">
            {{$users->links()}}
        </div>
        
    </div>
</section>
<!-- /.content -->
@stop