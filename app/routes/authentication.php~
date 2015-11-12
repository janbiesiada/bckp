<?php

Route::group(array('before' => 'guest'), function(){
    
    /********************************
     * Email Autheticated   (@Module)
     *
     * @Module  (Login GET)
     * @Module  (Login POST)
     */
     
    /**
     * @Module  (Login POST)
     */
    Route::post('/login',array(
        'as'    => 'login',
        'uses'  => 'AccountController@login'
    ));
    
    /**
     * @Module  (Login GET)
     */
    Route::get('/login', array(
        'as'    => 'login-get',
        'uses'  => 'AccountController@loginUserGet'
    ));
    
    
    /************************************
     * Social Authentication    (@Module)
     *
     * @Module  (Facebook Auth)
     * @Module  (Google Auth)
     */
    
    /**
     * @Module  (Facebook Auth)
     */
    Route::get('/fb', array(
        'as'    => 'fb',
        'uses'  => 'AccountController@loginWithFacebook'
    ));
    
    /**
     * @Module  (Google Auth)
     */
    Route::get('/gp', array(
        'as'    => 'gp',
        'uses'  => 'AccountController@loginWithGoogle'
    ));
    
    /**
     * @Module  (Google Auth)
     */
    Route::get('/tp', array(
        'as'    => 'tp',
        'uses'  => 'AccountController@loginWithTwitter'
    ));
    /*******************************
     * Email Registration   (@Module)
     * 
     * @Module  (Register POST)
     * @Module  (Register GET)
     */
    
    /**
     * @Module  (Register POST)
     */
    Route::post('/register',array(
        'as'    => 'register-post',
        'uses'  => 'AccountController@registerUser'
    ));
        
    /**
     * @Module  (Register GET)
     */
    Route::get('/register',array(
        'as'    => 'register-get',
        'uses'  => 'AccountController@registerUserGet'
    ));
    
    /**
     * Password Recovery    (@Module)
     */
    Route::any('/recover/{code}',array(
        'as'    => 'recover-email',
        'uses'  => 'RecoveryController@recoveryPassword'
    ));
    
    
    /********************************************************
     * Social Authentication (Temporary Session)    (@Module)
     */
    Route::group(array('before' => 'temp'), function(){
        
        /**
         * Social Authetication (@Module)
         *
         * @Module  (Generate Form)
         * @Module  (Register)
         */
        
        /**
         * @Module  (Generate Form)
         */
        Route::get('/update/social',array(
            'as'    => 'social-update',
            'uses'  => 'AccountController@updateSocial'
        ));
        
        /**
         * @Module  (Register)
         */
        Route::post('/update/social', array(
            'as'    => 'social-updatepost',
            'uses'  => 'AccountController@updateSocialPost'
        ));
    });
});



/**
 * Logout Authenticated Users   (@Module)
 * 
 * @Module  (Logout User)
 * @Module  (Logout Administrator)
 */
 
/**
 * @Module  (Logout User)
 */
Route::get('/logout' ,array(
    'as' => 'logout',
    'uses' => 'AccountController@logout'
));

/**
 * @Module  (Logout Admin)
 */
Route::get('/9gag-admin/logout' ,array(
    'as' => 'logout',
    'uses' => 'AdminController@logout'
));






?>
