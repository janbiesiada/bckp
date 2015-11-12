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
    @if(Session::get('auth')['username'] !== $user->username && Session::has('auth') )
    <?php  $post=DB::table('posts')->get();
    //echo '<pre>';print_r($post);exit;
    ?>
                <li><a href="#" class="report-post" data-pid="{{$user->username}}">Report Profile</a></li>
                <li><a href="/s/{{$user->username}}/followers" class="test_class" >Subscribe User</a></li>
                @if(in_array($user->username,$banned_users))
                    <li><a href="/s/{{$user->username}}/block">UnBlock User</a></li>
                @else
                    <li><a href="/s/{{$user->username}}/block">Block User</a></li>
                @endif
            @endif
		<li><a href="/s/{{$user->username}}/uploads">Uploads</a></li>
		 @if(Session::get('auth')['username'] == $user->username)
		<?php $get_count=DB::table('report')->where('reported_by',Session::get('auth')['username'])->count();
		if($get_count >0){
		 ?>
		<li><a href="">Reported Post(<?php echo $get_count; ?>)</a></li>
		<?php } ?>
		@endif
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
                @if($posts->count())
                
                @if($posts->getLastPage() > 1)
                <main class="main-body content-to-load">
                @else
                <main class="main-body">
                @endif
                
                
                
                    @foreach($posts as $post)
                    <div class="post">
                        <div class="header">
                            
                            <div class="tags">
                                @foreach($post->tags as $tag)
                                <ul class="hashtag fl-right">
                                    <li><a href="/hashtag/{{$tag}}">#{{$tag}}</a></li>
                                </ul>
                                @endforeach
                            </div>
                            <div class="title">
                                <h1><a  href="/{{$code}}/g/{{$post->p_id}}"> {{$post->title}}</a> </h1>
                            </div>
                            
                            @if(Session::has('auth') && Session::get('auth')['username'] === $post->username)
                            <div class="removepost">
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="flicon flaticon-caret"></i> </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a class="remove-post" data-pid="{{$post->p_id}}" >Remove Post</a></li>
                                    </ul>
                                </li>
                            </div>
                            @endif
                            
                            
                        </div>
                        <div class="imageholder">
                            @if($post->type === 'photo' || $post->type === 'gif')
                                <a target="_blank" href="/{{$code}}/g/{{$post->p_id}}"><img src="{{URL::secure('/').$post->uri}}" alt="" class="img-responsive"></a>
                            @elseif($post->type === 'video' && $post->source === 'vine')
                                <iframe src="{{$post->uri}}/embed/simple?audio=1" width="600" height="600" frameborder="0"></iframe><script src="https://platform.vine.co/static/scripts/embed.js"></script>
                            @elseif($post->type === 'video' && $post->source === 'youtube')
                                <iframe width="585" height="315" src="{{$post->uri}}" frameborder="0" allowfullscreen></iframe>
                            @endif
                        </div>
                        
                        
                        <div class="social-activity">
                            <div class="share-post">
                                <ul>
                                    <li>
                                        <a class="share" href="http://www.facebook.com/sharer.php?u={{URL::secure('/').'/'.$code.'/g/'.$post->p_id}}&t={{$post->title}}">
                                            <i class="flicon flaticon-facebook">Facebook</i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="share" href="https://twitter.com/intent/tweet?via=9gag&text={{$post->title}}&source=tweetbutton&original_referer={{URL::secure('/')}}&url={{URL::secure('/').'/'.$code.'/g/'.$post->p_id}}&t={{$post->title}}&t={{$post->title}}">
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
                                    @if($post->up)
                                    <li>
                                        <span>
                                        	<i data-pid="{{$post->p_id}}" class="flicon flaticon-thumbs-up-alt upvote checked unvote"></i>
                                        </span>
                                    </li>
                                    
                                    @else
                                    <li>
                                    	<span><i data-pid="{{$post->p_id}}" class="flicon flaticon-thumbs-up-alt upvote up-vote"></i>
                                    	</span>
                                    </li>
                                    @endif
                                    @if($post->down)
                                    <li>
                                    	<span>
                                    		<i data-pid="{{$post->p_id}}" class="flicon flaticon-thumbs-down-alt checked downvote unvotedown"></i>
                                    	</span>
                                    </li>
                                    @else
                                    <li>
                                    	<span>
                                    		<i data-pid="{{$post->p_id}}" class="flicon flaticon-thumbs-down-alt downvote votedown"></i>
                                    	</span>
                                    </li>
                                    @endif
                                    @endif
                                    <li><i class="flicon flaticon-fire"></i> <span class="totalpoints">{{$post->pts}}</span> Points</li>
                                    <li><a href="/{{$code}}/g/{{$post->p_id}}#comments"><i class="flicon flaticon-comment"></i>{{$post->c_count}}</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- end of .social-activity -->
                    </div>
                    @endforeach
                    
                    
                    
                    @if($posts->getLastPage() > 1)
                    <div class="pages">
                        {{$posts->links()}}
                    </div>
                    @endif
                    
                </main>
                
                @else
                
                <main class="main-body">
                    <div class="no-data">
                        <p>User has not shared any post!</p>
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
