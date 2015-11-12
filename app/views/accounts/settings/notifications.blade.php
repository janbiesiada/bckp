@extends('index')

@section('title')
<title>Notification Settings - 9GAG</title>
@stop

@section('profilesettings')
<div class="settings-account">
    <div class="row">
        <div class="col-xs-4">
            <div class="list-group">
                <a href="/settings/account" class="list-group-item ">Account</a>
                <a href="/settings/password" class="list-group-item">Password</a>
                <a href="/settings/profile" class="list-group-item">Profile</a>
                <a href="/settings/notifications" class="list-group-item active">Notification</a>
            </div>
        </div>
        <div class="col-xs-6">
            
        </div>
    </div>
</div>
@stop