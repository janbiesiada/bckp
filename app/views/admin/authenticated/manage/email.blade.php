@extends('admin.authenticated.dashboard')

@section('admincontent')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Email Templates </small> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="/9gag-admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Email Templates </li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="privacyeditor">
            <!--Activate Account (USER)-->
            <form action="{{ URL::secure('/9gag-admin/mail')}}" method="post" enctype="multipart/form-data" id="activate-user">
                <div class="form-group">
                    <h3 style="padding: 0px; margin: 0px;">Activate Account (User)</h3>
                </div>
                <div class="form-group">
                    <label for="policy">Email Header</label>
                    <input type="text" class="form-control" placeholder="Email Heading" value="{{Emailer::where('type','=','activate_user')->first()->title}}" name="activate_user_title"/>
                    <label for="policy">Email Body</label>
                    <textarea class="form-control" rows="5" name="activate_user_body" placeholder="Email Body">{{Emailer::where('type','=','activate_user')->first()->body}}</textarea>
                </div>
                
                @if(Session::has('activate_user'))
                <div class="form-group">
                    <p style="color:green">{{Session::get('activate_user')}}</p>
                </div>
                @endif
                
                <button type="submit" name="activate_user" value="activate_user" class="btn btn-primary">Save Changes</button>
            </form>
            
            
            <!--Recover Account (USER)-->
            <form action="{{ URL::secure('/9gag-admin/mail')}}" method="post" enctype="multipart/form-data" id="recover-user">
                <div class="form-group">
                    <h3 style="padding: 0px; margin: 0px;">Recover Account (User)</h3>
                </div>
                <div class="form-group">
                    <label for="policy">Email Header</label>
                    <input type="text" class="form-control" placeholder="Email Heading" value="{{Emailer::where('type','=','recover_user')->first()->title}}" name="recover_user_title"/>
                    <label for="policy">Email Body</label>
                    <textarea class="form-control" rows="5" name="recover_user_body" placeholder="Email Body">{{Emailer::where('type','=','recover_user')->first()->body}}</textarea>
                </div>
                
                @if(Session::has('recover_user'))
                <div class="form-group">
                    <p style="color:green">{{Session::get('recover_user')}}</p>
                </div>
                @endif
                
                <button type="submit" name="recover_user" value="recover_user" class="btn btn-primary">Save Changes</button>
            </form>
            
            <!--Subscribe Newsletter (USER)-->
            
            <form action="{{ URL::secure('/9gag-admin/mail')}}" method="post" enctype="multipart/form-data" id="newsletter">
                <div class="form-group">
                    <h3 style="padding: 0px; margin: 0px;">Subscribe Newsletter (User)</h3>
                </div>
                <div class="form-group">
                    <label for="policy">Email Header</label>
                    <input type="text" class="form-control" placeholder="Email Heading" value="{{Emailer::where('type','=','subscribe_newsletter')->first()->title}}" name="subscribe_newsletter_title"/>
                    <label for="policy">Email Body</label>
                    <textarea class="form-control" rows="5" name="subscribe_newsletter_body" placeholder="Email Body">{{Emailer::where('type','=','subscribe_newsletter')->first()->body}}</textarea>
                </div>
                
                @if(Session::has('subscribe_newsletter'))
                <div class="form-group">
                    <p style="color:green">{{Session::get('subscribe_newsletter')}}</p>
                </div>
                @endif
                
                <button type="submit" name="subscribe_newsletter" value="subscribe_newsletter" class="btn btn-primary">Save Changes</button>
            </form>
                
            <!--Activate Account (ADMINISTRATOR)-->
            
            <form action="{{ URL::secure('/9gag-admin/mail')}}" method="post" enctype="multipart/form-data" id="activate-admin">
                <div class="form-group">
                    <h3 style="padding: 0px; margin: 0px;">Activate Account (Administrator)</h3>
                </div>
                <div class="form-group">
                    <label for="policy">Email Header</label>
                    <input type="text" class="form-control" placeholder="Email Heading" value="{{Emailer::where('type','=','activate_admin')->first()->title}}" name="activate_admin_title"/>
                    <label for="policy">Email Body</label>
                    <textarea class="form-control" rows="5" name="activate_admin_body" placeholder="Email Body">{{Emailer::where('type','=','activate_admin')->first()->body}}</textarea>
                </div>
                
                @if(Session::has('activate_admin'))
                <div class="form-group">
                    <p style="color:green">{{Session::get('activate_admin')}}</p>
                </div>
                @endif
                
                <button type="submit" name="activate_admin" value="activate_admin" class="btn btn-primary">Save Changes</button>
            </form>
            
        </div>
    </div>
</section>
<!-- /.content -->
@stop