<?php

Route::group(array('before' => 'admin_auth'), function(){
    
    
    /**
     * Administration User Details (@Module)
     *
     * @Module  (User Details)
     * @Module  (Delete User)
     * @Module  (Registered Users)
     * @Module  (Subscribed Users)
     */
     
    /**
     * @Module  (User Details)
     */
    Route::any('/9gag-admin/details',array(
        'as'    =>  'user-details',
        'uses'  =>  'AdminController@userDetails'
    ));
    
    /**
     * @Module  (Registered Users)
     */
    Route::any('/9gag-admin/users',array(
        'as'    =>  'registered-users',
        'uses'  =>  'AdminController@usersList'
    ));
    
    /**
     * @Module  (Subscribed Users)
     */
    Route::any('/9gag-admin/subscriptions',array(
        'as'    =>  'subscribed-users',
        'uses'  =>  'AdminController@subscriptions'
    ));
    
    /**
     * @Module  (Delete Users)
     */
    Route::any('/9gag-admin/delete',array(
        'as'    =>  'user-details',
        'uses'  =>  'AdminController@deleteUser'
    ));
    
    /**
     * @Module  (Ban Users)
     */
    Route::any('/9gag-admin/ban',array(
        'as'    =>  'user-ban',
        'uses'  =>  'AdminController@banUser'
    ));
     
    /**
     * @Module  (UnBan Users)
     */
    Route::any('/9gag-admin/unban',array(
        'as'    =>  'user-unban',
        'uses'  =>  'AdminController@unBanUser'
    ));
    
    
    /**
     * Analytics (@Module)
     */
    Route::any('/9gag-admin/analytics',array(
        'as'    =>  'user-analytics',
        'uses'  =>  'AdminController@analytics'
    ));
    
    /**
     * Privacy Policy Editor (@Module)
     */
    Route::any('/9gag-admin/editor/policy',array(
        'as'    =>  'privacy-policy',
        'uses'  =>  'AdminController@policy'
    ));
    
    /**
     * Manage Header Content (@Module)
     */
    Route::any('/9gag-admin/look',array(
        'as'    =>  'headerlook',
        'uses'  =>  'AdminController@look'
    ));
    
    /**
     * Language Management (@Module)
     */
    Route::any('/9gag-admin/language',array(
        'as'    =>  'languages',
        'uses'  =>  'AdminController@languages'
    ));
    
    /**
     * Advertisement Manager (@Module)
     */
    
    Route::any('/9gag-admin/adverts',array(
        'as'    =>  'adverts',
        'uses'  =>  'AdminController@adverts'
    ));
    
    /**
     * Remove Adverts
     */
    Route::post('/9gag-admin/adverts/remove',array(
        'as'    =>  'adverts-remove',
        'uses'  =>  'AdminController@removeAdverts'
    ));
    
    /**
     * Email Template Settings
     */
    Route::any('/9gag-admin/mail',array(
        'as'    =>  'email-settings',
        'uses'  =>  'AdminController@emailTemplates'
    ));
});

?>