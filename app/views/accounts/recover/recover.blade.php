@extends('index')

@section('title')
    <title>Recover Account - {{MetaData::where('type','=','details')->first()->title}}</title>
@stop


@section('recoveryform')
<div class="login-get-form"><br>
    <div class="wraper">
        <h2>Recover Account</h2>
    </div>
    <form class="clearfix login-form" action="{{ URL::secure('/recover')}}" method="post" enctype="multipart/form-data">
        <div class="wraper">
            <p>Email Address</p>
            <input type="text" name="email" placeholder="Email" class="input-field login-email" required>
            @if($errors->has('email'))
                *{{$errors->first('email')}}<br>
            @endif
        </div><br>
        <button style="float:right" type="submit" class="btn-submit">Submit</button>
    </form>
</div>
@stop