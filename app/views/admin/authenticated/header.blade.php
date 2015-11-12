<header class="main-header">
    <!-- Logo -->
    <a href="/9gag-admin" class="logo">9GAG Admin</a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{Session::get('admin_auth')['dp_uri']}}" class="user-image" alt="User Image"/>
                    <span class="hidden-xs">{{Session::get('admin_auth')['name']}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{Session::get('admin_auth')['dp_uri']}}" class="img-circle" alt="User Image" />
                            <p>
                                {{Session::get('admin_auth')['name']}}
                                <small>Member since {{date('Y-m-d',strtotime(Session::get('admin_auth')['created_at']))}}</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="/9gag-admin/logout" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>