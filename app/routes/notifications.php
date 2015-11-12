<?php

Route::group(array('before' => 'auth'), function(){
    
    
    /*****************************
     * User Nofications (@Module)
     * @Module  (Read Notification)
     */
    
    /**
     * @Module  (Read Notification)
     */
    Route::post('/read/notification',array(
        'as'    => 'read-notification',
        'uses'  => 'notificationController@readNotification'
    ));
    
    /**
     * @Module  (SoftRead Notification)
     */
    Route::post('/s_read/notification',array(
        'as'    => 's-read-notification',
        'uses'  => 'notificationController@s_readNotification'
    ));
    
    
    /**
     * @Module  (Hard Read All Notification)
     */
    Route::post('/read_all/notification',array(
        'as'    => 'readall-notification',
        'uses'  => 'notificationController@readAllNotification'
    ));
    
});

?>