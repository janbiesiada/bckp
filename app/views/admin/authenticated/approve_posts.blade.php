@extends('admin.authenticated.dashboard')
@section('admincontent')
<!-- Content Header (Page header) -->

<section class="content-header">
    <h1>
        Dashboard
        <small>Submission Approval</small> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="/9gag-admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Submissions Approval</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        
        <div class="posts">
            @if(!count($posts))
            <li class="approved">There are no submission waiting for approval</li>
            @endif
            @foreach($posts as $post)
            <li>
                <div class="thumbnail">
                    @if($post->type === 'photo' || $post->type === 'gif')
                        <img src="{{$post->uri}}" alt="...">
                    @elseif($post->type === 'video' && $post->source === 'vine')
                        <iframe src="{{$post->uri}}/embed/simple" width="600" height="600" frameborder="0"></iframe><script src="https://platform.vine.co/static/scripts/embed.js"></script>
                    @elseif($post->type === 'video' && $post->source === 'youtube')
                        <iframe width="585" height="315" src="{{$post->uri}}" frameborder="0" allowfullscreen></iframe>
                    @endif
                    
                    <div class="caption">
                        <h3>{{$post->title}}</h3>
                        <p>Submitted By <a target="_blank" href="/s/{{$post->username}}">{{$post->username}}</a></p>
                        <p><a href="#" class="btn btn-primary approve-post" data-pid="{{$post->p_id}}" role="button">Approve</a> 
                            <a href="#" class="btn btn-danger" role="button">Remove</a>
                        </p>
                    </div>
                </div>
            </li>
            @endforeach
        </div>
        <div class="links">
            {{$posts->links()}}
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