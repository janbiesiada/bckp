<nav class="navbar navbar-default navbar-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
            <a class="navbar-brand" href="{{URL::secure('/9gag-admin')}}">9GAG Admin</a>
        </div>
        
        <div class="collapse navbar-collapse" id="myNavbar">
           
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/9gag-admin/register" class="showregisterbox"><span class="glyphicon glyphicon-user"></span> Register</a></li>
                <li><a href="/9gag-admin/login" class="showloginbox"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                
            </ul>
        </div>
        
    </div>
</nav>