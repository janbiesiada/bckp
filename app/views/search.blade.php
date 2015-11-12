@extends('index')


@section('title')
    <title>{{MetaData::where('type','=','details')->first()->title}} - Search Tags</title>
@stop

@section('search')
<div class="post-container">
    <div class="row">
        <div class="col-615">
            <main class="main-body">
                <div class="searchtags">
                    <div class="form-group">
                        <span class="flaticon-search"></span>
                        <input class="form-control {{$type}}" rows="5" placeholder="Search" maxlength="120" name="url">
                    </div>
                </div>
                <div class="searchtype">
                    <span> 
                        
                        @if($type === 'searchquery')
                            <a href="/search/" class="active">Normal</a> 
                        @else
                            <a href="/search/" class="unactive">Normal</a> 
                        @endif
                        
                        @if($type === 'searchcontroversial')
                            <a href="/search/controversial" class="active">Controversial</a> 
                        @else
                            <a href="/search/controversial" class="unactive">Controversial</a> 
                        @endif
                        
                        
                    </span>
                </div>
                <div class="results">
                    <ul class="tags">
                         
                    </ul>
                </div>
            </main>
        </div>
            
        @include('sidebar')
    </div>
</div>
@stop
