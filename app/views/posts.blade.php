@extends('index')

@section('title')
@section('title')
<title>{{MetaData::where('type','=','details')->first()->title}} @if($category) {{strtoupper($category)}} @endif</title>
@stop
@stop

@section('posts')
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=1641224632816495";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<style type="text/css">
    .navbar, .navbar .container .navbar-collapse{
        background: #434242;
    }
</style>
<div class="social-box green">
    <div class="container text-center">
        <div class="social-title">What is ChaaiBreak?</div>
        <a href="#">Click here to find out!</a>
    </div>
</div>
<div class="post-container container">
    <div class="row">
        <div class="col-615">
            <div class="timer">
                Next batch of post arrives in      
                <div class="clock" style="margin:2em;"></div>
                <div class="message"></div>
            </div>
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

                    <div class="post" >
                        <div class="header">

                            <div class="title">
                                <h1><a  href="/{{$code}}/g/{{$post->p_id}}"> {{$post->title}}</a> </h1>
                            </div>

                            @if(Session::has('auth'))
                            <div class="hidecontent">
                                <a class="unfollow-content" title="Hide Content" data-pid="{{$post->p_id}}" >X</a>
                            </div>
                            @endif

                        </div>
                        <div class="imageholder" 
                             @if($post->type === 'photo' || $post->type === 'gif') 
                             @if(getimagesize(public_path().$post->uri)[1] > 800)
                             style="height:500px; position:relative; overflow:hidden; display:block;" 
                             @endif
                             @endif
                             >

                             @if($post->type === 'photo' || $post->type === 'gif')
                             @if(getimagesize(public_path().$post->uri)[1] > 800)
                             <div class="fullimage"><a href="/{{$code}}/g/{{$post->p_id}}"">View Full Post</a></div>
                            @endif
                            <a target="_blank" href="/{{$code}}/g/{{$post->p_id}}"><img src="{{URL::secure('/').$post->uri}}" alt="" class="img-responsive"></a>
                            @elseif($post->type === 'video' && $post->source === 'vine')
                            <iframe src="{{$post->uri}}/embed/simple" width="600" height="600" frameborder="0"></iframe><script src="https://platform.vine.co/static/scripts/embed.js"></script>
                            @elseif($post->type === 'video' && $post->source === 'youtube')
                            <iframe width="585" height="315" src="{{$post->uri}}" frameborder="0" allowfullscreen></iframe>
                            @endif

                        </div>

                        <div class="tags">
                            @foreach($post->tags as $tag)
                            <ul class="hashtag">
                                <li><a href="/hashtag/{{$tag}}">#{{$tag}}</a></li>
                            </ul>
                            @endforeach
                        </div>
                        <div class="social-activity">
                            <div class="share-post">
                                <ul>
                                    <li>
                                        <a class="share" href="http://www.facebook.com/sharer.php?u={{URL::secure('/').'/'.$code.'/g/'.$post->p_id}}&t={{$post->title}}">
                                            <i class="flicon flaticon-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="share" href="https://twitter.com/intent/tweet?via=9gag&text={{$post->title}}&source=tweetbutton&original_referer={{URL::secure('/')}}&url={{URL::secure('/').'/'.$code.'/g/'.$post->p_id}}&t={{$post->title}}&t={{$post->title}}">
                                            <i class="flicon flaticon-twitter"></i>
                                        </a>
                                    </li>
                                    <li><a href=""><i class="flicon flaticon-share"></i></a></li>
                                    <!--                                    <li><div class="fb-share-button" data-href="https://localhost/" data-layout="button_count"></div></li>-->
                                </ul>
                            </div>
                            <div class="votes">
                                <ul class="viewer-opinion pull-left">
                                    <li><i class="fire-icon"></i> <span class="totalpoints">{{$post->points}}</span> Points</li>
                                    <li><a href="/{{$code}}/g/{{$post->p_id}}#comments"><i class="comment-icon"></i>{{$post->c_count}}</a></li>
                                </ul>
                                <ul class="viewer-opinion pull-right">
                                    @if(!Session::has('auth'))
                                    <li><span >Superr <i class="thumbs-up-alt showregisterbox"></i></span></li>
                                    <li><span >Mokkai <i class="thumbs-down-alt showregisterbox"></i></span></li>
                                    @else
                                    @if($post->up)
                                    <li>
                                        <span >Superr
                                            <i data-pid="{{$post->p_id}}" data-username="{{$post->username}}" class="thumbs-up-alt upvote checked unvote"></i>
                                        </span>
                                    </li>

                                    @else
                                    <li>Superr
                                        <span ><i data-pid="{{$post->p_id}}" data-username="{{$post->username}}" class="thumbs-up-alt upvote up-vote"></i>
                                        </span>
                                    </li>
                                    @endif
                                    @if($post->down)
                                    <li>
                                        <span >Mokkai
                                            <i data-pid="{{$post->p_id}}" data-username="{{$post->username}}" class="thumbs-down-alt checked downvote unvotedown"></i>
                                        </span>
                                    </li>
                                    @else
                                    <li>
                                        <span >Mokkai
                                            <i data-pid="{{$post->p_id}}" data-username="{{$post->username}}" class="thumbs-down-alt downvote votedown"></i>
                                        </span>
                                    </li>
                                    @endif
                                    @endif


                                </ul>
                            </div>
                        </div>
                        <!-- end of .social-activity -->

                        <!-- SINGLE COMMENT VIEW -->
                        @if($post->first_comment)
                        <div class="comment-section clearfix">
                            <ul>
                                <li>
                                    <div class="profilepic">
                                        <img src="{{$post->first_comment->comment_user_dp}}" alt="lp" class="thumb">
                                    </div>


                                    <div class="comments">
                                        <div class="blockquote">
                                            <header class="meta">

                                                <a target="_blank" href="/s/{{$post->first_comment->username}}">
                                                    {{$post->first_comment->username}}
                                                </a>
                                                <span>{{$post->first_comment->tstamp}}</span>

                                            </header>
                                            <div class="comment-body">
                                                <p class="comment">{{$post->first_comment->comment}}</p>
                                            </div>

                                            <footer>
                                                <div class="viewer-opinion" style="display:none">
                                                    @if(Session::has('auth'))
                                                    @if($post->first_comment->up)
                                                    <span><i data-id="{{$post->first_comment->id}}" data-username="{{$post->first_comment->username}}" class="flicon flaticon-thumbs-up upvotecomment checked unvote"></i></span>
                                                    @else
                                                    <span><i data-id="{{$post->first_comment->id}}" data-username="{{$post->first_comment->username}}" class="flicon flaticon-thumbs-up upvotecomment up-vote"></i></span>
                                                    @endif
                                                    <span>{{$post->first_comment->points}}</span>
                                                    @if($post->first_comment->down)
                                                    <span><i data-id="{{$post->first_comment->id}}" data-username="{{$post->first_comment->username}}" class="flicon flaticon-thumbs-up downvotecomment checked unvotedown"></i></span>
                                                    @else
                                                    <span><i data-id="{{$post->first_comment->id}}" data-username="{{$post->first_comment->username}}" class="flicon flaticon-thumbs-down downvotecomment votedown"></i></span>
                                                    @endif
                                                    @else
                                                    <span><i  class="flicon flaticon-thumbs-up showregisterbox"></i></span>
                                                    <span>{{$post->first_comment->points}}</span>
                                                    <span><i  class="flicon flaticon-thumbs-down showregisterbox"></i></span>
                                                    @endif
                                                </div>
                                            </footer>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <a href="/{{$code}}/g/{{$post->p_id}}#comments" class="continue">Read more comments</a>
                        </div>
                        <!-- end of .comment-section -->
                        @endif
                    </div>
                    @endforeach

                    @if($posts->getLastPage() > 1)
                    <div class="pages">
                        {{$posts->links()}}
                    </div>
                    @endif

                    <div class="banner">


                        @if(Input::get('page') % 2 == 0 && Input::get('page')  > 1)


                        <div class="banner1">
                            <div class="body">
                                <h2>Your Work Could Be Here</h2>
                            </div>
                            <div class="footer">
                                Get the app now!
                            </div>
                        </div>
                        @endif
                        @if(Input::get('page') % 3 == 0 && Input::get('page')  > 1)

                        <div class="banner2">
                            <div class="body">
                                <h3>Funny tell the Truth? Download the app.</h3>
                            </div>

                        </div>
                        @endif

                </main>

                @else

                <main class="main-body">
                    <div class="no-data">
                        <p>No Posts to show!</p>
                    </div>
                </main>
                @endif
        </div>

        @include('sidebar')
    </div>
</div>
@stop
