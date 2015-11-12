@extends('admin.index')
@section('registerformget')
<div class="login-get-form">
    <h2>Login</h2>
    <form action="{{ URL::secure('/9gag-admin/login')}}" method="post" enctype="multipart/form-data">
        
        <div class="form-group">
            <label>Email address</label>
            <input type="text" name="email" placeholder="Email" class="input-field">
            <div class="col-sm-10">
                @if($errors->has('email'))
                {{'*'. $errors->first('email')}}
                @endif
            </div>
        </div>
       
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" placeholder="Password" class="input-field">
            <div class="col-sm-10">
                @if($errors->has('password'))
                {{'*'. $errors->first('password')}}
                @endif
            </div>
        </div>

        <button type="submit" class="btn-submit">Login</button>
    </form>
</div>
@stop