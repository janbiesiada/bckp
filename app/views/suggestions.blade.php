@extends('index')


@section('title')
    <title>{{MetaData::where('type','=','details')->first()->title}} - Post Suggestions</title>
@stop

@section('search')
<div class="post-container">
    <div class="row">
        <div class="col-615">
            <main class="main-body">
                <div class="suggestions">
                    
                    <?php
                        $user           =   Session::get('auth')['username'];
                        $p_ids     =   TagSuggests::where('owner','=',$user)->groupBy('p_id')->lists('p_id');
                        
                        foreach($p_ids as $p_id){
                            $dom  = TagSuggests::where('p_id','=',$p_id)->where('owner','=',$user)->get();
                            $p_details  =   Post::where('p_id','=',$p_id)->first();
			                $code = Language::where('name','=',$p_details->language)->first()->code;
                            
                    ?>
    
                    <div class="panel panel-default">
	                    <div class="panel-body">      
                            
                            <div class="header">
                    			<h2><a target="_blank" href="/{{$code}}/g/{{$p_id}}">{{$p_details->title}}</a></h3>
                            </div>
                            
                            @foreach($dom as $sug)
                                <div class="single">
                                    <div class="tags">
                            			<h4>Suggestion : <a target="_blank" href="/hashtag/{{$sug->tags}}">{{$sug->tags}}</a></h4>
                            		</div>
                                    <div class="users">
                            			<h5>
                            			Added By : <span class="label label-default"><a target="_blank" href="/s/{{$sug->username}}">{{$sug->username}}</a></span>
                            			</h5>
           
                            		</div>
                            		
                            		<div class="actions">
                            			<button type="button" data-pid="{{$p_details->p_id}}" data-tag="{{$sug->tags}}" class="btn btn-success btn-xs accept-tag">Accept</button>
                            			<button type="button" data-pid="{{$p_details->p_id}}" data-tag="{{$sug->tags}}" class="btn btn-danger btn-xs decline-tag" >Decline</button>
                            		</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <?php            
                        }
                    ?>
                    
                    <center>@if(!count($p_ids))No New Suggestions.@endif</center>
                </div>
            </main>
        </div>
            
        @include('sidebar')
    </div>
</div>
@stop
