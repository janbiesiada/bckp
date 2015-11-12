@extends('admin.authenticated.dashboard')
@section('admincontent')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Flagged Posts</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/9gag-admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Post Reports</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="posts">
            @if(!count($posts))
            <li  class="approved">There are no flagged posts waiting for action!</li>
            @endif
            @foreach($posts as $post)
            <li>
                <div class="thumbnail">
                    <img src="{{$post->image_uri}}" alt="...">
                    <div class="caption">
                        <h3>{{$post->title}} <small>By <a target="_blank" href="/s/{{$post->username}}">{{$post->username}}</a></small></h3>
                        <div class="well well-sm">
                            <p>Reported By <a target="_blank" href="/s/{{$post->reported_by}}">{{$post->reported_by}}</a></p>
                            <p><b>Reason : </b>{{$post->reason}} </p>
                        </div>
                        <p>
                            <a href="#" class="btn btn btn-danger remove-post-report" data-reportid="{{$post->reportid}}" data-pid="{{$post->p_id}}" role="button">Remove Content</a>
                            <a href="#" class="btn btn-primary cancel-post-report" data-pid="{{$post->p_id}}" data-reportid="{{$post->reportid}}" role="button">Cancel Request</a>
                            <form action="/hide/report" method="post">
                            <input type="hidden" name="pid" value="{{$post->p_id}}" />

                            <input type="submit" class="btn btn-primary" role="button" value="Move to Controversial" /> 
                            </form>
                        </p>
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
