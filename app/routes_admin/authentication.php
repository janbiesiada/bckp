<?php
Route::group(array('before' => 'admin_guest'), function(){
     
    /****************************************
     * Administrator Registration   (@Module)
     *
     * @Module  (Generate FORM)
     * @Module  (Registe)
     */
     
     /**
      * @Module (Generate FORM)
      */
    Route::get('/9gag-admin/register',array(
        'as'    =>  'admin-register',
        'uses'  =>  'AdminController@registerGet'
    ));
    
    /**
     * @Module  (Register)
     */
    Route::post('/9gag-admin/register', array(
        'as'    => 'admin-register-post',
        'uses'  => 'AdminController@Register'
    ));
    
    
    /**
     * Admin Authentication (@Module)
     *
     * @Module  (Generate FORM)
     * @Module  (Authenticate)
     */
    
    /**
     * @Module  (Generate FORM)
     */
    Route::get('/9gag-admin/login', array(
        'as'    => 'admin-login',
        'uses'  => 'AdminController@loginGet'
    ));

    /**
     * @Module  (Authenticate)
     */
    Route::post('/9gag-admin/login', array(
        'as'    => 'admin-login-post',
        'uses'  => 'AdminController@Login'
    ));
});



?>