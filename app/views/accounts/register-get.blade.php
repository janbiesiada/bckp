@extends('index')

@section('title')
    <title>Register Account - {{MetaData::where('type','=','details')->first()->title}}</title>
@stop


@section('title')
<title>Register Account - 9GAG</title>
@stop

@section('registerformget')
<div class="register-get-form">
    <h2>Register Account</h2>
    <form action="{{ URL::secure('/register')}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" placeholder="Name" class="input-field register-name">
            <div class="col-sm-10">
                @if($errors->has('name'))
                {{'*'. $errors->first('name')}}
                @endif
            </div>
        </div>
        <br>
        <div class="form-group">
            <label>Username </label>
            <input type="text" name="username" placeholder="Email" class="input-field register-username">
            <div class="col-sm-10">
                @if($errors->has('username'))
                {{'*'. $errors->first('username')}}
                @endif
            </div>
        </div>
        <br>
        <div class="form-group">
            <label>Email address</label>
            <input type="text" name="email" placeholder="Email" class="input-field register-email">
            <div class="col-sm-10">
                @if($errors->has('email'))
                {{'*'. $errors->first('email')}}
                @endif
            </div>
        </div>
        <br>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" placeholder="Password" class="input-field register-password">
            <div class="col-sm-10">
                @if($errors->has('password'))
                {{'*'. $errors->first('password')}}
                @endif
            </div>
        </div>
        <br>
        <div class="form-group">
            <label for="language">Language</label>
            <select class="form-control" name=language id="sel1">
                <option value="">Choose Language</option>
                <?php
                 //   $languages = explode(',',MetaData::where('type','=','details')->first()->languages);
                            $languages = Language::where('enabled','=',1)->get(); 
                    foreach ($languages as $v) {
                        echo '<option value="'.$v->code.'">'.$v->name.'</option>';
                    }
                ?>
            </select>
            @if($errors->has('language'))
                {{'*'. $errors->first('language')}}
            @endif
        </div>
        <br>
        <button type="submit" class="btn-submit">Register</button>
    </form>
</div>
@stop
