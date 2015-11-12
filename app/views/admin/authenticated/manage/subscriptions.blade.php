@extends('admin.authenticated.dashboard')
@section('admincontent')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Subscriptions </small> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="/9gag-admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Subscribed Users </li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="subscriptionslist">
            <div id="no-more-tables">
                <table class="table table-bordered table-hover">
                    <thead class="cf">
                        <tr>
                            <td>
                                <b>Email</b>
                            </td>
                            <th>
                                <b>Subscription Date</b>
                            </th>
                            <td>
                                Actions
                            </td>
                            
                        </tr>
                        
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                {{$user->email}}
                            </td>
                            <td>{{ date("Y-m-d", strtotime($user->created_at)) }}</td>
                            <td>
                                <button type="button" class="btn btn-danger unsubscribe" data-id="{{$user->id}}">Unsubscribe</button>
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