@extends('admin.authenticated.dashboard')

@section('admincontent')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Flagged Replies</small> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="/9gag-admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Reply Reports</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
       <div class="comments">
           @if(!count($replies))
           <li>There are no flagged replies waiting for action!</li>
           @endif
           
           @foreach($replies as $reply)
               <li>
                   <div class="header">
                       <div class="submittedby">
                           Reply Posted By <a target="_blank" href="/s/{{$reply->username}}">{{$reply->username}}</a> - Reported By <a target="_blank" href="/s/{{$reply->reported_by}}">{{$reply->reported_by}}</a>
                       </div>
                       
                       <div class="comment">
                           <p>{{$reply->comment}}</p>
                       </div>
                       
                       <div class="comment-report-actions">
                            <a href="#" class="btn btn btn-danger remove-reply-report" data-rid="{{$reply->id}}" data-reportid="{{$reply->reportid}}" role="button">Remove Comment</a> 
                            <a href="#" class="btn btn-primary cancel-reply-report" data-rid="{{$reply->id}}" data-reportid="{{$reply->reportid}}" role="button">Cancel Request</a>
                        </div>
                   </div>
               </li>
           @endforeach
       </div>

    <div class="links">
        {{$report->links()}}
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