@extends('index')

@section('title')
<title>Account Settings - 9GAG</title>
@stop

@section('profilesettings')
<div class="settings-account">
    <div class="row">
        <div class="col-xs-4">
            <div class="list-group">
                <a href="/settings/account" class="list-group-item active">Account</a>
                <a href="/settings/password" class="list-group-item">Password</a>
                <a href="/settings/profile" class="list-group-item">Profile</a>
                <a href="/settings/notifications" class="list-group-item">Notification</a>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="settingsform">
                <h2>Account</h2>
                <form action="{{ URL::secure('/settings/account')}}" method="post" enctype="multipart/form-data">
                     <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{Session::get('auth')['username']}}" placeholder="username">
                        @if($errors->has('username'))
                            *{{$errors->first('username')}}
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{Session::get('auth')['email']}}" placeholder="Email">
                        @if($errors->has('email'))
                            *{{$errors->first('email')}}
                        @endif
                    </div>
                    
                            
                    <div class="form-group">
                        <label for="language">Language</label>
                        <select class="form-control" name=language id="sel1">
                            
                            <?php
                                $languages = Language::where('enabled','=',1)->lists('name');
                                
                                foreach ($languages as $k=>$v) {
                                    if($v === Session::get('auth')['language']){
                                        echo '<option value="'.Session::get('auth')['language'].'">'.Session::get('auth')['language'].'</option>';
                                    }
                                }
                                
                                foreach ($languages as $k=>$v) {
                                    if($v != Session::get('auth')['language']){
                                        echo '<option value="'.$v.'">'.$v.'</option>';
                                    }
                                }
                            ?>
                            
                            
                        </select>
                        @if($errors->has('language'))
                            *{{$errors->first('language')}}
                        @endif
                    </div>
                    
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