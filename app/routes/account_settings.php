<?php

Route::group(array('before' => 'auth'), function(){
    
    /********************************
     * User Profile Settings (@Module)
     * 
     * @Module  Profile
     * @Module  Account
     * @Module  Password
     * @Module  Notifications
     */
     
    /**
     * @module Account
     */
    Route::any('/settings',array(
        'as'    => 'account-settings',
        'uses'  => 'ProfileSettingsController@accountSettings'
    ));
    /**
     * @module  Account
     */
    Route::any('/settings/account',array(
        'as'    => 'account-settings',
        'uses'  => 'ProfileSettingsController@accountSettings'
    ));
    /**
     * @module Profile
     */
    Route::any('/settings/profile',array(
        'as'    => 'account-settings',
        'uses'  => 'ProfileSettingsController@profileSettings'
    ));
    /**
     * @module  Password
     */
    Route::any('/settings/password',array(
        'as'    => 'account-settings',
        'uses'  => 'ProfileSettingsController@passwordSettings'
    ));
    /**
     * @Module Notifications
     */
    Route::any('/settings/notifications',array(
        'as'    => 'account-settings',
        'uses'  => 'ProfileSettingsController@notificationSettings'
    ));
});


?>