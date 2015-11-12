@extends('index')

@section('title')
    <title>Login Account - {{MetaData::where('type','=','details')->first()->title}}</title>
@stop

@section('logingetform')
<div class="login-get-form">
    <div class="wraper">
        <h2>Login</h2>
        
        <p>Connect with a social network</p>
        <ul>
            <li class="facebook">
                <a href="/fb"><i class="flicon flaticon-facebook"></i><span>Facebook</span></a>
            </li>
            <li class="google">
                <a href="/gp"><i class="flicon flaticon-google-plus"></i><span>Google</span></a>
            </li>
        </ul>
    </div>
    <form class="clearfix login-form" action="/login" method="post" enctype="multipart/form-data">
        <div class="wraper">
            <p>Log in with your email address</p>
            <input type="text" name="email" placeholder="Email" class="input-field login-email">
            @if($errors->has('email'))
                *{{$errors->first('email')}}
            @endif
            <input type="password" name="password" placeholder="Password" class="input-field login-password">
            @if($errors->has('password'))
                *{{$errors->first('password')}}
            @endif
            <p class="forgot"><a href="/recover">Forgot Password</a></p>
        </div>
        
        @if(Session::has('failure'))
            <p style="color:red">* {{Session::get('failure')}}</p>
        @endif
        <button type="submit" class="btn-submit">Log in</button>
    </form>
</div>
@stop
