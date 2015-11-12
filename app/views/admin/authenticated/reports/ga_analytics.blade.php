@extends('admin.authenticated.dashboard')

@section('admincontent')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Google Analytics</small> 
    </h1>
    <ol class="breadcrumb">
        <li><a href="/9gag-admin"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Traffic Reports</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">      

        <div class="analytics">
            <!-- Step 1: Create the containing elements. -->
            
            <section id="auth-button"></section>
            <section id="view-selector"></section>
            <section id="timeline"></section>
            
            <!-- Step 2: Load the library. -->
        </div>
    </div>
    
    <script>
        (function(w,d,s,g,js,fjs){
          g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(cb){this.q.push(cb)}};
          js=d.createElement(s);fjs=d.getElementsByTagName(s)[0];
          js.src='https://apis.google.com/js/platform.js';
          fjs.parentNode.insertBefore(js,fjs);js.onload=function(){g.load('analytics')};
        }(window,document,'script'));
    </script>
    
    <script>
        gapi.analytics.ready(function() {
        
          // Step 3: Authorize the user.
        
          var CLIENT_ID = '61544267036-ddnu8fsc87qkct1hts4chj04tcu6qhuu.apps.googleusercontent.com';
        
          gapi.analytics.auth.authorize({
            container: 'auth-button',
            clientid: CLIENT_ID,
          });
        
          // Step 4: Create the view selector.
        
          var viewSelector = new gapi.analytics.ViewSelector({
            container: 'view-selector'
          });
        
          // Step 5: Create the timeline chart.
        
          var timeline = new gapi.analytics.googleCharts.DataChart({
            reportType: 'ga',
            query: {
              'dimensions': 'ga:date',
              'metrics': 'ga:sessions',
              'start-date': '30daysAgo',
              'end-date': 'yesterday',
            },
            chart: {
              type: 'LINE',
              container: 'timeline'
            }
          });
        
          // Step 6: Hook up the components to work together.
        
          gapi.analytics.auth.on('success', function(response) {
            viewSelector.execute();
          });
        
          viewSelector.on('change', function(ids) {
            var newIds = {
              query: {
                ids: ids
              }
            }
            timeline.set(newIds).execute();
          });
        });
    </script>
</section>
<!-- /.content -->
@stop