<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{Session::get('admin_auth')['dp_uri']}}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{Session::get('admin_auth')['name']}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">9GAG Dashboard</li>
            @if(Session::get('admin_auth')['type'] === "owner")
            <li>
                <a href="/9gag-admin/manage">
                <i class="fa fa-users"></i> <span>Manage Admins</span>
                @if(Admin::where('approved','=',0)->count())
                <small class="label pull-right bg-yellow">{{Admin::where('approved','=',0)->count()}}</small>
                @endif
                
                </a>
            </li>
            @endif
            
            <li>
                <a href="/9gag-admin/users">
                <i class="fa fa-user"></i> <span>Registered Users</span>
                </a>
            </li>
            
            <li>
                <a href="/9gag-admin/subscriptions">
                <i class="fa fa-envelope-o"></i> <span>Newsletter Subscriptions</span>
                </a>
            </li>
            
            <li>
                <a href="/9gag-admin/analytics">
                <i class="fa fa-bar-chart"></i> <span>Analytics</span>
                </a>
            </li>
            
            <li>
                <a href="/9gag-admin/submissions">
                    <i class="fa fa-clock-o"></i> <span>Submissions</span>
                    @if(Post::where('status','=',0)->count() > 0)
                    <small class="label pull-right bg-yellow">{{Post::where('status','=',0)->count()}}</small>
                    @endif
                
                </a>
            </li>
            
            <li class="treeview">
                <a href="#">
                <i class="fa fa-flag"></i> <span>Manage Accounts</span>
                
                <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/9gag-admin/details"><i class="fa fa-circle-o"></i>Account Details</a></li>
                    <li><a href="/9gag-admin/delete"><i class="fa fa-circle-o"></i>Delete Account</a></li>
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#">
                <i class="fa fa-flag"></i> <span>Flagged Content</span>
                
                <small class="label pull-right bg-red">{{Report::where('status',0)->count()}}</small>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="/9gag-admin/flagged/post">
                        
                        @if(Report::where('type','=','post')->count())
                        <small class="label pull-right bg-red">{{Report::where('type','=','post')->count()}}</small>
                        @endif
                        <i class="fa fa-circle-o"></i>Posts</a></li>
                    <li>
                        <a href="/9gag-admin/flagged/comments">
                        
                        @if(Report::where('type','=','comment')->count())
                        <small class="label pull-right bg-red">{{Report::where('type','=','comment')->count()}}</small>
                        @endif
                        <i class="fa fa-circle-o"></i>Comments</a></li>
                    <li>
                        <a href="/9gag-admin/flagged/replies">
                            
                        @if(Report::where('type','=','reply')->count())
                        <small class="label pull-right bg-red">{{Report::where('type','=','reply')->count()}}</small>
                        @endif
                        <i class="fa fa-circle-o"></i>Replies</a></li>
                        <li>
                        <a href="/9gag-admin/flagged/remove-profile">
                            
                        @if(Report::where('type','=','user-profile')->where('status',0)->count())
                        <small class="label pull-right bg-red">{{Report::where('type','=','user-profile')->where('status',0)->count()}}</small>
                        @endif
                        <i class="fa fa-circle-o"></i>Report Profile</a></li>
                </ul>
            </li>
             <li class="treeview">
                <a href="#">
                <i class="fa fa-flag"></i> <span>Opted Out Tags</span>
                
                <small class="label pull-right bg-red">{{Hide::count()}}</small>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="/9gag-admin/flagged/tags">
                        
                        @if(Hide::count())
                        <small class="label pull-right bg-red">{{Hide::count()}}</small>
                        @endif
                        <i class="fa fa-circle-o"></i>Opted Out Tags</a></li>
            <li>
             </ul>
            </li>
                <a href="/9gag-admin/editor/policy">
                <i class="fa fa-pencil"></i> <span>Privacy Policy Editor</span>
                </a>
            </li>
            
            <li>
                <a href="/9gag-admin/language">
               <i class="fa fa-language"></i> <span>Manage Languages</span>
                </a>
            </li>
            
            <li>
                <a href="/9gag-admin/look">
               <i class="fa fa-adjust"></i> <span>Manage Header</span>
                </a>
            </li>
            
            <li>
                <a href="/9gag-admin/mail">
               <i class="fa fa-cog"></i> <span>Email Settings</span>
                </a>
            </li>
            
            <li>
                <a href="/9gag-admin/adverts">
               <i class="fa fa-buysellads"></i> <span>Manage Advertisements</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
