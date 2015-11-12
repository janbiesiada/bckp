<?php

class RecoveryController extends BaseController{
    
    public function recover(){
        if(Request::isMethod('get')){
            return View::make('accounts.recover.recover');
        }
        
        if(Request::isMethod('post')){
            $email      =   Input::get('email');
            $validator  =   Validator::make(Input::all(),array(
                                'email' => 'required|email'
                            ));
            
            if($validator->passes()){
                $user   =   User::where('email','=',$email)
                                ->where('password','!=','');
                
                if($user->count()){
                    $code               =   str_random(60);
                    $user               =   $user->first();
                    $user->recoverycode =   $code;
                    $email              =   $user->email;
                    $username           =   $user->username;
                    
                    if($user->save()){
                        Mail::send('emails.auth.recover', array(
        					'link' => URL::route('recover-email', $code) ,
        					'username' => $user->username
        				),
                                   
        				function ($message) use($username,$email){
        					$message->to($email, 
                            $username)->subject('Password Recovery');
        				});
                    }
                    return Redirect::secure('/recover')->with('global',"Check your Email for Password Recovery Link!");
                }else{
                    return Redirect::secure('/recover')->with('global',"Account Doesn't Exist");
                }
            }else{
                return Redirect::secure('/recover')->withErrors($validator);
            }
        }
    }
    
    public function recoveryPassword($code){
        
        if(Request::isMethod('get')){
            $user   =   User::where('recoverycode','=',$code);
            if($user->count()){
                $user   =   $user->first();
                
                return View::make('accounts.recover.changepassword')->with('user',$user)->with('code',$code);
            }else{
                return Redirect::secure('/');
            }
        }
        
        if(Request::isMethod('post')){
            $validator  =   Validator::make(Input::all(),array(
                                'email'             => 'required|email',
                                'password'          => 'required|min:6',
                                'confirm-password'  => 'required|same:password',
                                'code'              => 'required'
                            ));
            if($validator->fails()){
                return Redirect::secure('/recover/'.$code)->withErrors($validator);
            }else{
                $user   =   User::where('email','=',Input::get('email'))
                                ->where('recoverycode','=',$code)
                                ->update(array(
                                    'password'      =>  Hash::make(Input::get('password')),
                                    'recoverycode'  =>  ''
                                ));
                if($user){
                    return Redirect::secure('/login')->with('global',"Password has been successfully changed!");
                }
            }
        }
    }
}