@extends('index')

@section('title')
<title>{{$user->name}} - {{MetaData::where('type','=','details')->first()->title}}</title>
@stop

@section('userprofile')
<div class="admin-dashboard">
    <div class="covergraph" style="background : url('{{$user->cover_uri}}');background-repeat: no-repeat;background-position: center; background-color: black;">
        <figure class="logged-user">
            <div class="profilepic">
                <img src="{{$user->dp_uri}}" alt="">
            </div>
            <figcaption>
                <p>{{$user->name}}</p>
            </figcaption>
        </figure>
        <!--<ul class="admin-nav">
            <li class="one"><a href=""><i class="flicon flaticon-clock"></i></a></li>
            <li class="two"><a href=""><i class="flicon flaticon-airplane"></i></a></li>
            </ul>-->
    </div>
    
    <ul class="navigate">
		<li><a href="/s/{{$user->username}}/uploads">Uploads</a></li>
		<li><a href="/s/{{$user->username}}/comments">Comments</a></li>
		<li><a href="/s/{{$user->username}}/upvotes">Upvotes</a></li>
		<li><a href="/s/{{$user->username}}/badges">Badges</a></li>
	</ul>
    <!-- /.covergraph -->
    <div class="container">
        <div class="row">
            <div class="col-615 fl-none">
                <!-- =========================
                    MAIN BODY 
                    ============================== -->
                @if($comments->count())
                @if($comments->getLastPage() > 1)
                    <main class="main-body content-to-load">
                @else
                    <main class="main-body">
                @endif
    
                    @foreach($comments as $post)

                    <div class="post">
                        <div style="margin-bottom: 5px; border-bottom: 1px solid #F6F6F6;"><b>{{$user->username}} commented</b></div>
                        <div class="header">
                            <div class="title">
                                <h1><a  href="/{{$code}}/g/{{$post->post->p_id}}"> {{$post->post->title}}</a> </h1>
                            </div>
                            <div class="tags">
                                @foreach($post->post->tags as $tag)
                                <ul class="hashtag fl-right">
                                    <li><a href="/hashtag/{{$tag}}">#{{$tag}}</a></li>
                                </ul>
                                @endforeach
                            </div>
                        </div>
                        <div class="imageholder">
                            @if($post->post->type === 'photo' || $post->post->type === 'gif')
                                <a target="_blank" href="/{{$code}}/g/{{$post->post->p_id}}"><img src="{{URL::secure('/').$post->post->uri}}" alt="" class="img-responsive"></a>
                            @elseif($post->post->type === 'video' && $post->post->source === 'vine')
                                <iframe src="{{$post->post->uri}}/embed/simple?audio=1" width="600" height="600" frameborder="0"></iframe><script src="https://platform.vine.co/static/scripts/embed.js"></script>
                            @elseif($post->post->type === 'video' && $post->post->source === 'youtube')
                                <iframe width="585" height="315" src="{{$post->post->uri}}" frameborder="0" allowfullscreen></iframe>
                            @endif
                        </div>
                        
                        
                        <div class="social-activity">
                            <div class="share-post">            
                                <ul>
                                    <li>
                                        <a class="share" href="http://www.facebook.com/sharer.php?u={{URL::secure('/').'/'.$code.'/g/'.$post->post->p_id}}&t={{$post->post->title}}">
                                            <i class="flicon flaticon-facebook">Facebook</i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="share" href="https://twitter.com/intent/tweet?via=9gag&text={{$post->post->title}}&source=tweetbutton&original_referer={{URL::secure('/')}}&url={{URL::secure('/').'/'.$code.'/g/'.$post->post->p_id}}&t={{$post->post->title}}&t={{$post->post->title}}">
                                            <i class="flicon flaticon-twitter">Twitter</i>
                                        </a>
                                    </li>
                                    <li><a href=""><i class="flicon flaticon-share"></i></a></li>
                                </ul>
                            </div>
                            <div class="votes">
                                <ul class="viewer-opinion">
                                    @if(!Session::has('auth'))
                                    <li><a href="#"><i class="flicon flaticon-thumbs-up-alt showregisterbox"></i></a></li>
                                    <li><a href="#"><i class="flicon flaticon-thumbs-down-alt showregisterbox"></i></a></li>
                                    @else
                                    @if($post->post->up)
                                    <li>
                                        <span>
                                        	<i data-pid="{{$post->post->p_id}}" class="flicon flaticon-thumbs-up-alt upvote checked unvote"></i>
                                        </span>
                                    </li>
                                    
                                    @else
                                    <li>
                                        <span>
                                        	<i data-pid="{{$post->post->p_id}}" class="flicon flaticon-thumbs-up-alt upvote up-vote"></i>
                                        </span>
                                    </li>
                                    @endif
                                    @if($post->post->down)
                                    <li>
                                        <span>
                                        	<i data-pid="{{$post->post->p_id}}" class="flicon flaticon-thumbs-down-alt checked downvote unvotedown"></i>
                                        </span>
                                    </li>
                                    
                                    @else
                                    <li>
                                        <span>
                                        	<i data-pid="{{$post->post->p_id}}" class="flicon flaticon-thumbs-down-alt downvote votedown"></i>
                                        </span>
                                    </li>
                                    @endif
                                    @endif
                                    <li><i class="flicon flaticon-fire"></i> <span class="totalpoints">{{$post->post->points}}</span> Points</li>
                                    <li><a href="/{{$code}}/g/{{$post->post->p_id}}#comments"><i class="flicon flaticon-comment"></i>{{$post->post->c_count}}</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- end of .social-activity -->
                    </div>
                    @endforeach
                    
                    @if($comments->getLastPage() > 1)
                    <div class="pages">
                        {{$comments->links()}}
                    </div>
                    @endif
                    
                </main>
                
                @else
                <main class="main-body">
                    <div class="no-data">
                        <p>User has not commented on any post!</p>
                    </div>
                </main>
                @endif
            </div>
        
            </div>
        </div>
    </div>
</div>
<!-- /.admin-dashboard -->
@stop

