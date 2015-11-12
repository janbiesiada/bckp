<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>9GAG Administration Services</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link rel="stylesheet" href="{{URL::secure('/').'/assets/bower_components/bootstrap/dist/css/bootstrap.min.css'}}">
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    
    <link href="{{URL::secure('/').'/admin/assets/dist/css/AdminLTE.min.css'}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="{{URL::secure('/').'/admin/assets/dist/css/skins/_all-skins.min.css'}}" rel="stylesheet" type="text/css" />
    
    
    <link rel="stylesheet" href="{{URL::secure('/').'/admin/assets/css/stylesheets/app.css'}}">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      
      @include('admin.authenticated.header')
      
      
      @include('admin.authenticated.sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          
          @yield('admincontent')
          
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        
       
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="{{URL::secure('/').'/assets/bower_components/jquery/dist/jquery.min.js'}}"></script>
    <!-- jQuery UI 1.11.2 -->
    <script src="https://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{URL::secure('/').'/assets/bower_components/bootstrap/dist/js/bootstrap.min.js'}}" type="text/javascript"></script>    

    <script src="{{URL::secure('/').'/admin/assets/dist/js/app.min.js'}}" type="text/javascript"></script>
    
    <script src="{{URL::secure('/').'/admin/assets/js/app.min.js'}}" type="text/javascript"></script>
    
  </body>
</html>