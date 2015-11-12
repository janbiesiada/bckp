@extends('index')


@section('title')
<title>Password Settings - 9GAG</title>
@stop

@section('profilesettings')
<div class="settings-account">
    <div class="row">
        <div class="col-xs-4">
            <div class="list-group">
                <a href="/settings/account" class="list-group-item">Account</a>
                <a href="/settings/password" class="list-group-item active">Password</a>
                <a href="/settings/profile" class="list-group-item">Profile</a>
                <a href="/settings/notifications" class="list-group-item">Notification</a>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="settingsform">
                <h2>Password</h2>
                <form action="{{ URL::secure('/settings/password')}}" method="post" enctype="multipart/form-data">
                    <?php
                        $checkpass = User::where('username','=',Session::get('auth')['username'])->where('password','=','');
                        
                        if($checkpass->count()){
                    ?>
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="password">
                        @if($errors->has('password'))
                            * {{$errors->first('password')}}
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="password-confirm">Re-type New Password</label>
                        <input type="password" name="confirm-password" class="form-control" id="password-confirm" value="" placeholder="re-type password">
                        @if($errors->has('confirm-password'))
                            * {{$errors->first('confirm-password')}}
                        @endif
                    </div>
                    <?php
                        }else{
                    ?>
                    
                    <div class="form-group">
                        <label for="old-password">Old Password</label>
                        <input type="password" name="old-password" class="form-control" id="old-password" placeholder="old password">
                        @if($errors->has('old-password'))
                            * {{$errors->first('old-password')}}
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="password">
                        @if($errors->has('password'))
                            * {{$errors->first('password')}}
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm-password">Re-type New Password</label>
                        <input type="password" name="confirm-password" class="form-control" id="password-confirm" value="" placeholder="confirm password">
                        @if($errors->has('confirm-password'))
                            * {{$errors->first('confirm-password')}}
                        @endif
                    </div>
                    
                    <?php
                        }
                    ?>
                    @if(Session::has('settingnotification'))
                    <div class="form-group">
                        <p style="color:red">{{Session::get('settingnotification')}}</p>
                    </div>
                    @endif
                    
                    <button type="submit" class="btn-submit">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop