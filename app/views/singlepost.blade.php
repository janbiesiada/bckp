@extends('index')
@section('title')
<title>{{$post->title}} - {{ MetaData::where('type','=','details')->first()->title}}</title>
@stop
@section('singlepost')

<div class="post-container">
    <div class="row">
        <div class="col-615">
            <!-- =========================
                MAIN BODY 
                ============================== -->
            <main class="main-body">
                <!--Next Previous Links-->
                <div class="previousnext">
                    <?php
                    $next = Post::where('id', '>', $post->id);

                    if ($next->count()) {
                        $next = $next->first()->p_id;
                        ?>
                        <a href="/{{$code}}/g/{{$next}}"><button class="next">Next Post</button></a>
                        <?php
                    }

                    $prev = Post::where('id', '<', $post->id);

                    if ($prev->count()) {
                        $prev = $prev->first()->p_id;
                        ?>
                        <a href="/{{$code}}/g/{{$prev}}"><button class="prev">Previous Post</button></a>
                        <?php
                    }
                    ?>
                </div>
                <!--ENDS HERE-->
                <!--Post Body-->
                <div class="post single-post">
                    <div class="post-inner">
                        <!--Post Header-->
                        <div class="header">

                            <!--Post Title-->
                            <div class="title">
                                <h1><a> {{$post->title}}</a> </h1>
                            </div>
                        </div>
                        <!--HEADER ENDS HERE-->
                        <!--POST IMAGE-->
                        <div class="imageholder">
                            @if($post->type === 'photo' || $post->type === 'gif')
                            <a><img src="{{URL::secure('/').$post->uri}}" alt="" class="img-responsive"></a>
                            @elseif($post->type === 'video' && $post->source === 'vine')
                            <iframe src="{{$post->uri}}/embed/simple?audio=1" width="600" height="600" frameborder="0"></iframe><script src="https://platform.vine.co/static/scripts/embed.js"></script>
                            @elseif($post->type === 'video' && $post->source === 'youtube')
                            <iframe width="585" height="315" src="{{$post->uri}}" frameborder="0" allowfullscreen></iframe>
                            @endif
                        </div>
                        <!--Post Tags-->
                        <div class="tags">
                            @foreach($post->tags as $tag)
                            <ul class="hashtag fl-right">
                                <li><a target="_blank" href="/hashtag/{{$tag}}">#{{$tag}}</a></li>
                            </ul>
                            @endforeach
                        </div>
                        <!--ENDS HERE-->
                        <!--Social Activity Buttons (UP/DOWN Votes, Facebook, Twitter Share-->
                        <div class="social-activity">
                            <!--Facebook Twitter Share-->
                            <div class="share-post">
                                <ul>
                                    <li>
                                        <a class="share" href="http://www.facebook.com/sharer.php?u={{URL::secure('/').'/'.$code.'/g/'.$post->p_id}}&t={{$post->title}}">
                                            <i class="facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="share" href="https://twitter.com/intent/tweet?via=9gag&text={{$post->title}}&source=tweetbutton&original_referer={{URL::secure('/')}}&url={{URL::secure('/').'/'.$code.'/g/'.$post->p_id}}&t={{$post->title}}&t={{$post->title}}">
                                            <i class="twitter"></i>
                                        </a>
                                    </li>
                                    <li><a href=""><i class="share"></i></a></li>
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

                            <!--POST CREDIT-->
                            <div class="credits">
                                <span class="post-credit">
                                    by
                                    <a class="user" target="_blank" href="/s/{{$post->username}}">{{$post->username}}</a>
                                    @if(Session::get('auth')['username'] != $post->username && Session::has('auth'))
                                    .
                                    <a href="#" class="report-post" data-pid="{{$post->p_id}}">Report</a> . 
                                    <a href="#" class="add-tags" data-pid="{{$post->p_id}}">Add Tags</a>
                                </span>
                                </span>
                                @elseif(!Session::has('auth'))
                                .
                                <a href="#" class="showregisterbox" data-pid="{{$post->p_id}}">Report</a> . <a href="#" class="showregisterbox" data-pid="{{$post->p_id}}">Add Tags</a></span>
                                </span>
                                @endif
                            </div>
                            <div class="addtags">
                                <div class="form-group">
                                    <input class="form-control tag-suggestion" rows="5" data-pid="{{$post->p_id}}" placeholder="Enter Tag by pressing Enter" maxlength="120" name="tag">
                                </div>
                            </div>
                            <!--ENDS HERE-->
                        </div>
                    </div>
                    <div class="total-comment">
                        <div class="comment-cont">305 Comments</div>
                    </div>
                    <!-- end of .social-activity -->
                    @if(Session::has('auth'))
                    <!--Post Comment Form-->
                    <div class="comment-form">
                        <div class="profilepic">
                            <img src="{{Session::get('auth')['dp_uri']}}" alt="lp" class="thumb">
                        </div>
                        <div class="comment-text">
                            <div class="form-group">
                                <textarea class="form-control" data-pid="{{$post->p_id}}" id="post-comment" style="resize:none; height: 50px;" placeholder="Write Comments!" rows="5" name="comment"></textarea>
                            </div>
                            <div class="form-group actions">
                            <label>Comment Anonymously</label><input type="checkbox" name="comment_anonymously" id="show_user" value="1">

                            <?php
                            foreach ($post->comments as $current_comments) {
                                $get_post_username = DB::table('posts')
                                                ->where('posts.p_id', '=', $post->p_id)
                                                ->select('posts.username')->get();

                                if (Session::get('auth')['username'] != $get_post_username[0]->username) {

                                    $get_first_comment = DB::table('comments')->where('username', Session::get('auth')['username'])->orderBy('id', 'desc')->select('created_at')->first();
                                    if (!empty($get_first_comment)) {
                                        $new_date = date("m/d/Y h:i:s a", strtotime($get_first_comment->created_at));
                                        $date = new DateTime($get_first_comment->created_at);
                                        $date->getTimestamp();
                                        $time = date("Y-m-d h:i:s", $date->getTimestamp() - 11);
                                        $currentDate = date("Y-m-d");
                                        $currentTime = date("H:i:s");
                                        $currentDate = date("Y-m-d H:i:s", strtotime($currentDate . $currentTime));
                                        $get_comment_count = DB::table('comments')->where('username', Session::get('auth')['username'])->orderBy('id', 'desc')->where('created_at', '<=', $time)->take(8)->get();
                                        $get_count = DB::table('block_comment')->select('blocked_time')->where('username', Session::get('auth')['username'])->count();


                                        $get_bloc_time = DB::table('block_comment')->select('blocked_time')->where('username', Session::get('auth')['username'])->get();
                                        if (!empty($get_bloc_time)) {
                                            $time_to_Check = $get_bloc_time[0]->blocked_time;
                                        }
                                    }
                                }
                            }
                            ?>
                            @if(isset($get_comment_count) && !empty($get_comment_count))

                            <?php
                            $get_count = DB::table('block_comment')->select('blocked_time')->where('username', Session::get('auth')['username'])->count();
                            if ($get_count <= 0) {
                                $save_time = date("Y-m-d h:i:s", strtotime("+1 minutes"));
                                $save_tim = array();
                                $save_tim['blocked_time'] = $save_time;
                                $save_tim['username'] = Session::get('auth')['username'];
                                $insert = DB::table('block_comment')->insert($save_tim);
                            }
                            ?>
                            <script> alert('You commented a post regularly many times.This functionality is disabled for 30 minutes.')</script>
                            @else
                            <?php
                            $currentDate = date("Y-m-d");
                            $currentTime = date("H:i:s");
                            $currentDate = date("Y-m-d H:i:s", strtotime($currentDate . $currentTime));
                            $delete_block_comment = DB::table('block_comment')->where('username', Session::get('auth')['username'])->where('blocked_time', '<=', $currentDate)->delete();
                            ?>
                            
                                <button type="submit" class="btn-submit" id="submit-comment">Post</button>
                            </div>

                            @endif
                        </div>
                    </div>
                    @endif
                    <!--Post Comments Section-->
                    <div class="comment-section clearfix" id="comments">
                        @if($post->comments->count())
                        @foreach($post->comments as $comment)
                        <?php ?>                       
                        @if((!in_array($comment->username, $blocked_users['who_banned_this_user']))||!$comment->show_user)
                        <ul>
                            <li>
                                <div class="profilepic">
                                    @if($comment->show_user)
                                    <img src="{{$comment->comment_user_dp}}" alt="lp" class="thumb">
                                    @else 
                                    <img src="{{URL::secure('/assets/uploads').'/no_image.jpeg'}}" alt="lp" class="thumb">
                                    @endif
                                </div>
                                <div class="comments">
                                    <div class="blockquote">
                                        <header class="meta">
                                            @if($comment->show_user)
                                            <a target="_blank" href="/s/{{$comment->username}}">
                                                {{$comment->username}} 
                                                @else 
                                                <a> Anonymous<?php // print_r($blocked_users);         ?>
                                                    @endif
                                                </a>
                                                <span>{{$comment->at}}</span>
                                                <div class="commentactions">
                                                    <ul class="dropdown">
                                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="caret"></i> </a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            @if($comment->username === Session::get('auth')['username'])
                                                            <a class="remove-comment" data-cid="{{$comment->id}}" >Delete Comment</a>
                                                            <a class="edit-comment" data-cid="{{$comment->id}}" >Edit Comment</a>
                                                            @endif
                                                            @if($comment->username != Session::get('auth')['username'] && Session::has('auth'))
                                                            <a class="report-comment" data-cid="{{$comment->id}}" >Report Comment</a>
                                                            @elseif(!Session::has('auth'))
                                                            <a class="showregisterbox" data-cid="{{$comment->id}}" >Report Comment</a>
                                                            @endif
                                                        </ul>
                                                    </ul>
                                                </div>
                                        </header>
                                        <div class="comment-body">
                                            <p class="comment">{{$comment->comment}}</p>
                                        </div>
                                        <footer>
                                            <div class="viewer-opinion">
                                                @if(Session::has('auth'))
                                                @if($comment->up)
                                                <span><i data-id="{{$comment->id}}" data-username="{{$comment->username}}" class="thumbs-up upvotecomment checked unvote"></i></span>
                                                @else
                                                <span><i data-id="{{$comment->id}}" data-username="{{$comment->username}}" class="thumbs-up upvotecomment up-vote"></i></span>
                                                @endif
                                                <span>{{$comment->points}}</span>
                                                @if($comment->down)
                                                <span><i data-id="{{$comment->id}}" data-username="{{$comment->username}}" class="thumbs-down downvotecomment checked unvotedown"></i></span>
                                                @else
                                                <span><i data-id="{{$comment->id}}" data-username="{{$comment->username}}" class="thumbs-down downvotecomment votedown"></i></span>
                                                @endif
                                                <span data-id="{{$comment->id}}" data-username="{{$post->username}}" class="reply-comment">Reply</span>
                                                @else
                                                <span><i  class="thumbs-up showregisterbox"></i></span>
                                                <span>{{$comment->points}}</span>
                                                <span href=""><i  class="thumbs-down showregisterbox"></i></span>
                                                @endif
                                            </div>
                                        </footer>
                                    </div>
                                </div>
                            </li>
                            @if($comment->replies->count())
                            @foreach($comment->replies as $reply)
                            <li class="comment-replies">
                                <div class="profilepic">
                                    <img src="{{$reply->user_dp}}" alt="lp" class="thumb">
                                </div>
                                <div class="replies">
                                    <div class="blockquote">
                                        <header class="meta">
                                            <a target="_blank" href="/s/{{$reply->username}}">
                                                {{$reply->username}} 
                                            </a>
                                            <span>{{$reply->at}}</span>
                                            <div class="replyactions">
                                                <ul class="dropdown">
                                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="caret"></i> </a>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        @if($reply->username === Session::get('auth')['username'] && Session::has('auth'))
                                                        <a class="remove-reply" data-cid="{{$comment->id}}" data-rid="{{$reply->id}}" >Delete Comment</a>
                                                        <a class="edit-reply" data-cid="{{$comment->id}}" data-rid="{{$reply->id}}" >Edit Comment</a>
                                                        @endif
                                                        @if($reply->username != Session::get('auth')['username'] && Session::has('auth'))
                                                        <a class="report-reply" data-cid="{{$comment->id}}" data-rid="{{$reply->id}}" >Report Comment</a>
                                                        @elseif(!Session::has('auth'))
                                                        <a class="showregisterbox" data-cid="{{$comment->id}}" data-rid="{{$reply->id}}" >Report Comment</a>
                                                        @endif
                                                    </ul>
                                                </ul>
                                            </div>
                                        </header>
                                        <div class="reply-body">
                                            <p class="reply">{{$reply->comment}}</p>
                                        </div>
                                        <footer>
                                            <div class="viewer-opinion">
                                                @if(Session::has('auth'))
                                                @if($reply->up)
                                                <span><i data-id="{{$reply->id}}" data-username="{{$reply->username}}" class="thumbs-up upvotereply checked unvote"></i></span>
                                                @else
                                                <span><i data-id="{{$reply->id}}" data-username="{{$reply->username}}" class="thumbs-up upvotereply up-vote"></i></span>
                                                @endif
                                                <span>{{$reply->points}}</span>
                                                @if($reply->down)
                                                <span><i data-id="{{$reply->id}}" data-username="{{$reply->username}}" class="thumbs-down downvotereply checked unvotedown"></i></span>
                                                @else
                                                <span><i data-id="{{$reply->id}}" data-username="{{$reply->username}}" class="thumbs-down downvotereply votedown"></i></span>
                                                @endif
                                                @else
                                                <span><i  class="thumbs-up showregisterbox"></i></span>
                                                <span>{{$reply->points}}</span>
                                                <span><i  class="thumbs-down showregisterbox"></i></span>
                                                @endif
                                            </div>
                                        </footer>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                            @endif
                            @if($comment->replies->reply_count > 5)
                            <span href="#" data-cid="{{$comment->id}}" data-offset="{{$comment->replies->count()}}" class="load-more-replies">Load More Replies</span>
                            @endif
                        </ul>
                        @endif
                        @endforeach
                    </div>
                    @endif
                    @if($post->c_count > $post->comments->count())
                    <div id="load-more-wrapper">
                        <span href="#" data-pid="{{$post->p_id}}" data-offset="6" id="load-comments">Load More Comments</span>
                    </div>
                    @endif
                </div>
            </main>
        </div>
        @include('sidebar')
    </div>
</div>
@stop
