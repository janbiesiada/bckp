@extends('index')

@section('title')
    <title>Change Account Password - {{MetaData::where('type','=','details')->first()->title}}</title>
@stop


@section('changepassword')
<div class="login-get-form">
    <div class="wraper">
        <h2>Change Password</h2>
    </div>
    <form class="clearfix login-form" action="{{ URL::secure('/recover/'.$code)}}" method="post" enctype="multipart/form-data">
        
        <br>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="Email" value="{{$user->email}}" class="input-field register-password" readonly="readonly">
            <div class="col-sm-10">
                @if($errors->has('email'))
                {{'*'. $errors->first('email')}}
                @endif
            </div>
        </div>
        
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Password" class="input-field register-password" required>
            <div class="col-sm-10">
                @if($errors->has('password'))
                {{'*'. $errors->first('password')}}
                @endif
            </div>
        </div>
        
        <div class="form-group">
            <label>Confirm</label>
            <input type="password" name="confirm-password" placeholder="Confirm Password" class="input-field register-password" required>
            <div class="col-sm-10">
                @if($errors->has('confirm-password'))
                {{'*'. $errors->first('confirm-password')}}
                @endif
            </div>
        </div>
        <input style="visibility:hidden" type="password" name="code" value="{{$code}}">
        
        <button style="float:right" type="submit" class="btn-submit">Submit</button>
    </form>
</div>
@stop