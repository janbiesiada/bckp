@extends('admin.authenticated.dashboard')


@section('admincontent')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Flagged Comments</small> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="/9gag-admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Comments Reports</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
       <div class="comments">
           @if(!count($comments))
           <li>There are no flagged commented waiting for action!</li>
           @endif
           
           @foreach($comments as $comment)
               <li>
                   <div class="header">
                       <div class="submittedby">
                           Comment Posted By <a target="_blank" href="/s/{{$comment->username}}">{{$comment->username}}</a> - Reported By <a target="_blank" href="/s/{{$comment->reported_by}}">{{$comment->reported_by}}</a>
                       </div>
                       
                       <div class="comment">
                           <p>{{$comment->comment}}</p>
                       </div>
                       
                       <div class="comment-report-actions">
                            <a href="#" class="btn btn btn-danger remove-comment-report" data-cid="{{$comment->id}}" data-reportid="{{$comment->reportid}}" role="button">Remove Comment</a> 
                            <a href="#" class="btn btn-primary cancel-comment-report" data-cid="{{$comment->id}}" data-reportid="{{$comment->reportid}}" role="button">Cancel Request</a>
                                
                        
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