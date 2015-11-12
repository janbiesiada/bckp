@extends('admin.index')
@section('loginformget')
<div class="register-get-form">
    <h2>Register Admin</h2>
    <form action="{{ URL::secure('/9gag-admin/register')}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" placeholder="Name" class="input-field" required>
            <div class="col-sm-10">
                <br>
                @if($errors->has('name'))
                {{'*'. $errors->first('name')}}
                @endif
            </div>
        </div>
        <br>
        <div class="form-group">
            <label>Username </label>
            <input type="text" name="username" placeholder="Email" class="input-field" required>
            <div class="col-sm-10">
                @if($errors->has('username'))
                {{'*'. $errors->first('username')}}
                @endif
            </div>
        </div>
        <br>
        <div class="form-group">
            <label>Email address</label>
            <input type="text" name="email" placeholder="Email" class="input-field" required>
            <div class="col-sm-10">
                @if($errors->has('email'))
                {{'*'. $errors->first('email')}}
                @endif
            </div>
        </div>
        <br>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Password" class="input-field" required>
            <div class="col-sm-10">
                @if($errors->has('password'))
                {{'*'. $errors->first('password')}}
                @endif
            </div>
        </div>
        
        <button type="submit" class="btn-submit">Register</button>
    </form>
</div>
@stop