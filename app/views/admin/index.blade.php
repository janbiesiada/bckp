<!DOCTYPE html>
<html>
  <head>
    <title>9GAG Administration</title>
    <meta charset="UTF-8">
    <title>9GAG Administration Services</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link rel="stylesheet" href="{{URL::secure('/').'/assets/bower_components/bootstrap/dist/css/bootstrap.min.css'}}">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{URL::secure('/').'/assets/css/stylesheets/style.css'}}">
    <link rel="stylesheet" href="{{URL::secure('/').'/admin/assets/css/stylesheets/app.css'}}">
    
  </head>
  <body>
    @include('admin.nav')
    
    <div class="container">
      @if(!Session::has('admin_auth'))
        @yield('loginformget')
        @yield('registerformget')
      @endif
      
      @if(Session::has('global'))
        <div class="global">
          {{Session::get('global')}}
          <span class="glyphicon glyphicon-remove close"></span>
        </div>
      @endif
    </div>
    <script type="text/javascript" src="{{URL::secure('/').'/assets/bower_components/jquery/dist/jquery.min.js'}}"></script>
    <script type="text/javascript" src="{{URL::secure('/').'/assets/bower_components/bootstrap/dist/js/bootstrap.min.js'}}"></script>
    <script type="text/javascript" src="{{URL::secure('/').'/admin/assets/js/app.js'}}"></script>
  </body>
</html>