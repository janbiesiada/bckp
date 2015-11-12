<?php
 
 class SubscriptionController extends BaseController{
     
     public function subscribe(){
        $validator =    Validator::make(Input::all(),array(
                            'email' =>  'required|email'
                        ));
        
        if($validator->fails()){
            return Redirect::secure('/#newsletter')->with('global','Unable to Subscrible')->withErrors($validator);
        }else{
            $check  =   Subscribe::where('email','=',Input::get('email'));
            if($check->count()){
                return Redirect::secure('/#newsletter')->with('global',"you're already on the subscriptions list!");
            }else{
                $email              =   Input::get('email');
                $code               =   str_random(60);
                $subscribe          =   new Subscribe;
                $subscribe->email   =   $email;
                $subscribe->code    =   $code;
                $subscribe->verified=   0;
                
                if($subscribe->save()){
                    
                    Mail::send('emails.auth.subscribe', array(
    					'link' => URL::route('newsletter-subscribe-verify', $code)
    				),
                               
    				function ($message) use($email){
    					$message->to($email)->subject('Confirm Newsletter Subscription');
    				});
                    
                    return Redirect::secure('/#newsletter')->with('global',"Subscription Successfully, check your email!");
                }
            }
        }
     }
     
     public function verify($code){
        $user   =   Subscribe::where('code','=',$code)
                            ->where('verified','=',0);
        
        if($user->count()){
            $user           =   $user->first();
            $user->verified =   1;
            
            if($user->save()){
                return Redirect::secure('/#newsletter')->with('global',"Newsletter Subscription Confirmed!");
            }
        }
     }
 }