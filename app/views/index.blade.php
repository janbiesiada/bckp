<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        @yield('title')
        <meta name="description" content="{{MetaData::where('type','=','details')->first()->description}}" />
        @if(Session::has('uploadfailure'))
        <meta name="uploadfailure" content="{{Session::get('uploadfailure')}}">
        @endif
        @if(Session::has('url-uploadfailure'))
        <meta name="url-uploadfailure" content="{{Session::get('url-uploadfailure')}}">
        @endif

        @if(Session::has('vine-uploadfailure'))
        <meta name="vine-uploadfailure" content="{{Session::get('vine-uploadfailure')}}">
        @endif

        @if(Session::has('youtube-uploadfailure'))
        <meta name="youtube-uploadfailure" content="{{Session::get('youtube-uploadfailure')}}">
        @endif


        @if(!Session::has('auth'))
        <meta name="auth" content=0>
        @endif
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,500,600|Raleway:400,500,600' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="{{URL::secure('/').'/assets/bower_components/bootstrap/dist/css/bootstrap.min.css'}}">
        <link rel="stylesheet" href="{{URL::secure('/').'/assets/fonts/flaticon.css'}}">
        <link rel="stylesheet" href="{{URL::secure('/').'/assets/css/stylesheets/style.css'}}">
        <link rel="stylesheet" href="{{URL::secure('/').'/assets/css/stylesheets/flipclock.css'}}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    </head>
    <body>
        @include('nav')
        @include('languagesnav')
        <div class="mainwrapper">
            <div class="latest-feeds">
                @yield('posts')
            </div>
            <div class="container">
                @yield('search')
                @yield('singlepost')
                @yield('userprofile')
                @yield('socialupdate')
                @yield('registerformget')
                @yield('logingetform')
                @yield('profilesettings')
                @yield('recoveryform')
                @yield('changepassword')
            </div>
            @if(Session::has('global'))
            <div class="global">
                {{Session::get('global')}}
                <span class="glyphicon glyphicon-remove close"></span>
            </div>
            @endif
        </div>

        @if(!Session::has('auth'))
        @include('accounts.login')
        @endif

        @if(Session::has('auth'))
        @include('uploads.fileupload')
        @include('uploads.videoupload')
        @include('notifications')
        @endif

        @if(Session::get('auth')['active'] == 0)
        @include('accounts.verify')
        @endif
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="{{URL::secure('/').'/assets/js/build/app.min.js'}}"></script>
        <script type="text/javascript" src="{{URL::secure('/').'/assets/js/time_zone.js'}}"></script>
        <script type="text/javascript" src="{{URL::secure('/').'/assets/js/set_timezone.js'}}"></script>
        <script type="text/javascript" src="{{URL::secure('/').'/assets/js/flipclock.js'}}"></script>
        <script type="text/javascript" src="{{URL::secure('/').'/assets/js/jquery.selectbox-0.2.min.js'}}"></script>
        <script type="text/javascript" src="{{URL::secure('/').'/assets/js/main.js'}}"></script>

        <script type="text/javascript">
var tz = jstz.determine(),
        timezone = "{{Session::get('timezone')}}";

if (timezone != tz.name()) {
    TimeZoneSettings.setTimeZone(tz.name());
}
        </script>

        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-61702191-1', 'auto');
            ga('send', 'pageview');
            /*---countdown-----*/
            var clock;

            $(document).ready(function () {
                var clock;

                clock = $('.clock').FlipClock({
                    clockFace: 'HourlyCounter',
                    autoStart: false,
                    callbacks: {
                        stop: function () {
                            $('.message').html('The clock has stopped!')
                        }
                    }
                });

                clock.setTime(2200);
                clock.setCountdown(true);
                clock.start();

            });

        </script>
    </body>
</html>