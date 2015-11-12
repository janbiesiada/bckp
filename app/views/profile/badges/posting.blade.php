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
                <center>
                    <ul class="nav nav-tabs">
                      <li role="presentation"><a href="/s/{{$user->username}}/badges/reacting">Reacting</a></li>
                      <li role="presentation" class="active"><a href="/s/{{$user->username}}/badges/posting">Posting</a></li>
                      <li role="presentation" ><a href="/s/{{$user->username}}/badges/achievements">Achievements</a></li>
                    </ul>
                </center>
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="caption">
                                <p><b>Top 10 </b></p>
                            </div>
                            <img src="http://s3-ak.buzzfed.com/static/images/public/awards/medium/not_unlocked.png?v=201507151328" alt="...">
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="caption">
                                <p><b>Top 20 </b></p>
                            </div>
                            <img src="http://s3-ak.buzzfed.com/static/images/public/awards/medium/not_unlocked.png?v=201507151328" alt="...">
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="caption">
                                <p><b>Top 50 </b></p>
                            </div>
                            <img src="http://s3-ak.buzzfed.com/static/images/public/awards/medium/not_unlocked.png?v=201507151328" alt="...">
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="caption">
                                <p><b>Top 100 </b></p>
                            </div>
                            <img src="http://s3-ak.buzzfed.com/static/images/public/awards/medium/not_unlocked.png?v=201507151328" alt="...">
                        </div>
                    </div>
                    <?php
                        $p_count = Post::where('username','=',$user->username)->count();
                    ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="caption">
                                <p><b>Bronze Poster </b></p>
                            </div>
                            @if($p_count >= 50)
                                <img src="http://s3-ak.buzzfed.com/static/images/public/awards/medium/not_unlocked.png?v=201507151328" alt="...">
                            @else
                                <img src="http://s3-ak.buzzfed.com/static/images/public/awards/medium/not_unlocked.png?v=201507151328" alt="...">
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="caption">
                                <p><b>Silver Poster </b></p>
                            </div>
                            @if($p_count >= 100)
                                <img src="http://s3-ak.buzzfed.com/static/images/public/awards/medium/not_unlocked.png?v=201507151328" alt="...">
                            @else
                                <img src="http://s3-ak.buzzfed.com/static/images/public/awards/medium/not_unlocked.png?v=201507151328" alt="...">
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="caption">
                                <p><b>Gold Poster </b></p>
                            </div>
                            @if($p_count >= 250)
                                <img src="http://s3-ak.buzzfed.com/static/images/public/awards/medium/not_unlocked.png?v=201507151328" alt="...">
                            @else
                                <img src="http://s3-ak.buzzfed.com/static/images/public/awards/medium/not_unlocked.png?v=201507151328" alt="...">
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="caption">
                                <p><b>Platinum Poster </b></p>
                            </div>
                            @if($p_count >= 500)
                                <img src="http://s3-ak.buzzfed.com/static/images/public/awards/medium/not_unlocked.png?v=201507151328" alt="...">
                            @else
                                <img src="http://s3-ak.buzzfed.com/static/images/public/awards/medium/not_unlocked.png?v=201507151328" alt="...">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.admin-dashboard -->
@stop

