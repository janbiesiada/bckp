<?php

class Authenticate extends BaseController{
    
    
    /**
     * Check for Authentiated Session
     * 
     * @return bool
     */
    public static function hasAuth(){
        return Session::has('auth') ? true : false;
    }
}