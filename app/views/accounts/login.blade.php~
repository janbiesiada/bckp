<div class="popup" id="login-popup">
	<div class="overlay"></div>
	
	<div class="login-popup ahzp-ready">
	    
		<div class="wraper">
			<h5 class="popup-title">Login</h5>
			<p>Connect with a social network</p>

			<ul>
				<li class="facebook">
					<a href="/fb"><i class="flicon flaticon-facebook"></i><span>Facebook</span></a>
				</li>
				<li class="google">
					<a href="/gp"><i class="flicon flaticon-google-plus"></i><span>Google</span></a>
				</li>
			</ul>
		</div>

		<form class="clearfix" action="{{ URL::secure('/login')}}" method="post" enctype="multipart/form-data">
			<div class="wraper">
				<p>Log in with your email address</p>

				<input type="text" name="email" placeholder="Email" class="input-field login-email" required>
            <input type="password" name="password" placeholder="Password" class="input-field login-password" required>
				<p class="forgot"><a href="/recover">Forgot Password</a></p>
			</div>

			<button type="submit" class="btn-submit">Submit</button>
			<a href="#" class="btn-new-user registeruser">New User</a>
		</form>
	</div>
</div>

<div class="popup" id="register-popup">
	<div class="overlay"></div>
	
	<div class="register-popup ahzp-ready">
	    
		<div class="wraper">
			<h5 class="popup-title">Registration</h5>
			<p>Connect with a social network</p>

			<ul>
				<li class="facebook">
					<a href="{{URL::secure('/fb')}}"><i class="flicon flaticon-facebook"></i><span>Facebook</span></a>
				</li>
				<li class="google">
					<a href="{{URL::secure('/gp')}}"><i class="flicon flaticon-google-plus"></i><span>Google</span></a>
				</li>
				<li class="twitter">
					<a href="{{URL::secure('/tp')}}"><i class="flicon flaticon-google-plus"></i><span>Twitter</span></a>
				</li>
			</ul>
		</div>
        
        <div class="wraper">
            <p>Sign up with your <a href="#" class="registeruser">Email Address</a></p>
            <p>Have an account? <a href="#" class="showloginbox">Login</a></p>
        </div>
		
	</div>
</div>



<div class="popup" id="register-popup-form">
	<div class="overlay"></div>
	
	<div class="register-popup-form ahzp-ready">
	    
		<div class="wraper">
			<h5 class="popup-title">Register Account</h5>
		</div>
        
        <div class="wraper">
            <form  action="{{ URL::secure('/register')}}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" placeholder="Name" class="input-field register-name">
                </div>
                <div class="form-group">
                    <label>Username </label>
                    <input type="text" name="username" placeholder="Email" class="input-field register-username">
                </div>
                <div class="form-group">
                    <label>Email address</label>
                    <input type="text" name="email" placeholder="Email" class="input-field register-email">
                </div>
                <div class="form-group">
                    <label for="language">Password</label>
                    <input type="password" name="password" placeholder="Password" class="input-field register-password">
                </div>
                <div class="form-group">
                    <label for="language">Language</label>
                    <select class="form-control" name=language id="sel1">
                        <option value="">Choose Language</option>
                        <?php
                         /*   $languages = explode(',',MetaData::where('type','=','details')->first()->languages);
                                    
                            foreach ($languages as $k=>$v) {
                                echo '<option value="'.$v.'">'.$v.'</option>';
                            }*/
                            
                            $languages = Language::where('enabled','=',1)->get(); 
                    foreach ($languages as $v) {
                        echo '<option value="'.$v->code.'">'.$v->name.'</option>';
                    }
                ?>
           
                            
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-submit">Register</button>
                </div>
            </form>
        </div>
		
	</div>
</div>
