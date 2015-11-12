@extends('index')

@section('title')
    <title>Social Signup - {{MetaData::where('type','=','details')->first()->title}}</title>
@stop


@section('posts')

<div class="social-form">
    <form class="form-horizontal" action="{{URL::secure('/update/social')}}" method="post" enctype="multipart/form-data">
        <legend>Update Credentials</legend>
        <div class="form-group">
            <label for="email" class="col-sm-2 ">Email</label>
            <div class="col-sm-10">
           @if(!empty(Session::get('temp')['email']))
                <input type="email" class="form-control" name="email" id="email" value="{{Session::get('temp')['email']}}" placeholder="Email" readonly="readonly">
              @else
              <input type="email" class="form-control" name="email" id="email" placeholder="Email" placeholder="required">
                @endif
            </div>
            <div class="col-sm-10">
                @if($errors->has('email'))
                    {{'*'. $errors->first('email')}}
                @endif
            </div>
            
        </div>
        <div class="form-group">
            <label for="username" class="col-sm-2 ">Username</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="username" id="username" placeholder="required">
            </div>
            <div class="col-sm-10">
                @if($errors->has('username'))
                    {{'*'. $errors->first('username')}}
                @endif
            </div>
            
        </div>
        <div class="form-group">
            <label for="language" class="col-sm-2 ">Language</label>
            <div class="col-sm-10">
                <select class="form-control" name=language id="sel1">
                    <option value="">Choose Language</option>
                    <option value="English">English</option>
                    <option value="繁體中">繁體中文</option>
                    <option value="簡體中文">簡體中文</option>
                    <option value="français">français</option>
                    <option value="日本語">日本語</option>
                    <option value="Español">Español</option>
                    <option value="Português">Português</option>
                    <option value="Русский">Русский</option>
                    <option value="Türkçe">Türkçe</option>
                </select>
            </div>
            <div class="col-sm-10">
                @if($errors->has('language'))
                    {{'*'. $errors->first('language')}}
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn-submit">Update</button>
            </div>
        </div>
    </form>
</div>
@stop
