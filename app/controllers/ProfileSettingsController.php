<?php

class ProfileSettingsController extends BaseController{
    
    /**
     * User Account Settings 
     * 
     * @Get     Generate View
     * @Post    Update Account Details
     */
    public function accountSettings(){
        
        /**
         * Generate Account Settings View
         */
         
        if (Request::isMethod('get'))
        {
            return View::make('accounts.settings.account');
        }
        
        /**
         * Submit Details
         */
        if(Request::isMethod('post')){
            $validator = Validator::make(Input::all(), array(
                'username'  => 'required|min:3',
                'email'     => 'required|email',
                'language'  => 'required'
            ));
            
            if($validator->fails()){
                return Redirect::secure('/settings/account')
                    ->withErrors($validator)
                    ->with('settingnotification','Unable to save changes');
            }else{
                $message=  '';
                $error = false;
                $new_email = 1;
                $username = Input::get('username');
                $email =    Input::get('email');
                $language = Input::get('language');
                
                if($username != Session::get('auth')['username']){
                    $check_user     = User::where('username','=',$username);
                    if($check_user->count()){
                        $error = true;
                        $message .= '* username already exist <br>';
                    }
                }
                
                if($email != Session::get('auth')['email']){
                    $new_email = 0;
                    $check_email    = User::where('email', '=', $email);
                    if($check_email->count()){
                        $error = true;
                        $message .= '* email already exist<br>';
                    }
                }
                
                if($error){
                     return Redirect::secure('/settings/account')
                            ->withErrors($validator)
                            ->with('settingnotification',$message);
                }else{
                    $code = str_random(60);
                    
                    if($new_email == 0){
                        $update = User::where('email','=', Session::get('auth')['email'])->update(array(
                            'email'         => $email,
                            'username'      => $username,
                            'language'      => $language,
                            'active'        => $new_email,
                            'activate_code' => $code
                        ));
                        
                        Mail::send('emails.auth.activate', array(
        					'link' => URL::route('account-activate', $code) ,
        					'username' => $username
        				),
                                   
        				function ($message) use($username,$email){
        					$message->to($email, 
                            $username)->subject('Activate your Account');
        				});
                    }else{
                        $update = User::where('email','=', Session::get('auth')['email'])->update(array(
                            'email'     => $email,
                            'username'  => $username,
                            'language'  => $language,
                            'active'    => $new_email
                        ));
                    }
                    
                    
                    if($update){
                        Session::forget('auth');
                        $new_session = User::where('email','=',$email)->first();
                        Session::put('auth', $new_session);
                        
                        if($new_email == 0){
                            return Redirect::secure('/settings/account')
                            ->with('settingnotification', 'Account successfully updated')
                            ->with('global','Please verify new email, check your email for link!');
                        }else{
                            return Redirect::secure('/settings/account')
                            ->with('global', 'Account successfully updated');
                        }
                        
                    }else{
                        return Redirect::secure('/settings/account')
                            ->with('global', 'yeehaw, everthing\'s updated!');
                    }
                }
            }
        }
    }
  
    
    /**
     * Update Profile Setting
     * 
     * @Get     Generate View
     * @POST    Update Profile Details
     */
    public function profileSettings(){
        
        /**
         * Generate Account Profile Settings View
         */
        if(Request::isMethod('get')){
            return View::make('accounts.settings.profile');
        }
        
        /**
         * Submit Profile Setting Details
         */
        if(Request::isMethod('post')){
            $dp         = Session::get('auth')['dp_uri'];
            $cover      = Session::get('auth')['cover_uri'];
            $username   = Session::get('auth')['username'];
            $gender     = Input::get('gender');
            $date       = '';
            $location   = Input::get('location');
            $name       = '';
            $about      = Input::get('about');
            
            $validator = Validator::make(Input::all(), array(
                'name'  => 'required'
            ));
            
            if($validator->fails()){
                return Redirect::secure('/settings/profile')
                    ->withErrors($validator);
            }else{
                $name = Input::get('name');
                if(Input::has('dob_month') || Input::has('dob_day') ||Input::has('dob_year')){
                    $dob_validate = Validator::make(Input::all(), array(
                        'dob_month' => 'required',
                        'dob_day'   => 'required',
                        'dob_year'  => 'required'
                    ));
                    
                    if($dob_validate->fails()){
                        return Redirect::secure('/settings/profile')
                                ->with('settingnotification', 'Invalid Date format');
                    }else{
                        $raw_date = new DateTime(Input::get('dob_year').'-'.Input::get('dob_month').'-'.Input::get('dob_day'));
                        $date = $raw_date->format('Y-m-d');
                    }
                }
                
                if(Input::hasFile('profilePicture')){
                    $image_validate = Validator::make(Input::all(),array(
                        'profilePicture' => 'image'
                    ));
                    
                    if($image_validate->fails()){
                        return Redirect::secure('/settings/profile')
                                ->with('settingnotification', 'Invalid Image Format');
                    }else{
                        $dp = '/uploads/profile/'.$username.'/'.$username.'.'.Input::file('profilePicture')->guessClientExtension();
                        Input::file('profilePicture')->move(public_path().'/uploads/profile/'.$username.'/',$username.'.'.Input::file('profilePicture')->guessClientExtension());
                    }
                }
                
                if(Input::hasFile('profilecover')){
                    $image_validate = Validator::make(Input::all(),array(
                        'profilecover' => 'image'
                    ));
                    
                    if($image_validate->fails()){
                        return Redirect::secure('/settings/profile')
                                ->with('settingnotification', 'Invalid Cover Image Format');
                    }else{
                        $cover = '/uploads/covers/'.$username.'/'.$username.'.'.Input::file('profilecover')->guessClientExtension();
                        Input::file('profilecover')->move(public_path().'/uploads/covers/'.$username.'/',$username.'.'.Input::file('profilecover')->guessClientExtension());
                    }
                }
                
                $update = User::where('username','=',$username)->update(array(
                    'name'      => $name,
                    'gender'    => $gender,
                    'dob'       => $date,
                    'location'  => $location,
                    'about'     => $about,
                    'dp_uri'    => $dp,
                    'cover_uri' => $cover,
                ));
                
                Session::forget('auth');
                $new_session = User::where('username','=',$username)->first();;
                Session::put('auth', $new_session);
                return Redirect::secure('/settings/profile')
                            ->with('global', 'Profile Updated');
                
            }
        }
    }  
    
    /**
     * Update Password Settings
     * 
     * @Get     Generate View
     * @POST    Update Password Details
     */
    public function passwordSettings(){
        if(Request::isMethod('get')){
            return View::make('accounts.settings.password');
        }
        
        if(Request::isMethod('post')){
            $checkpass = User::where('username','=',Session::get('auth')['username'])->where('password','=','');
            if($checkpass->count()){
                $validator = Validator::make(Input::all(), array(
                    'password'          => 'required|min:6',
                    'confirm-password'  => 'required|same:password'
                ));
                
                if($validator->fails()){
                    return Redirect::secure('/settings/password')
                        ->withErrors($validator);
                }else{
                    $update = User::where('email', '=', Session::get('auth')['email'])->update(array(
                        'password'  => Hash::make(Input::get('password'))
                    ));
                    if($update){
                        return Redirect::secure('/settings/password')
                            ->with('global', 'Password Upated');
                    }
                }
            }else{
                $validator = Validator::make(Input::all(), array(
                    'old-password'      => 'required',
                    'password'          => 'required|min:6',
                    'confirm-password'  => 'required|same:password'
                ));
                if($validator->fails()){
                    return Redirect::secure('/settings/password')
                        ->withErrors($validator);
                }else{
                    $user =  User::where('username','=',Session::get('auth')['username']);
                
                    if($user->count()){
                        $user = $user->first();
                        
                        if(Hash::check(Input::get('old-password'), $user->password)){
                            $update = User::where('email', '=', Session::get('auth')['email'])->update(array(
                                'password'  => Hash::make(Input::get('password'))
                            ));
                            if($update){
                                return Redirect::secure('/settings/password')
                                    ->with('global', 'Password Upated');
                            }
                        }else{
                            return Redirect::secure('/settings/password')
                                ->with('global', 'Old password did not matched');
                        }
                    }
                }
            }
        }
    }

    /**
     * Profile Notification Settings
     * 
     * TODO NOT IMPLEMENTED YET
     */
    public function notificationSettings(){
        return View::make('accounts.settings.notifications');
    }
}