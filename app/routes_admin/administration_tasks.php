<?php

Route::group(array('before' => 'admin_auth'), function(){
    
    /**
     * Administration Task (@Module)
     *
     * @Module  (Generate Dashboard)
     * @Module  (Manage Admins)
     * @Module  (Submissions Approval)
     */
     
    /**
     * @Module (Generate Dashboard)
     */
    Route::any('/9gag-admin', array(
        'as'    =>  'admin-login',
        'uses'  =>  'AdminController@index'
    ));
    
    /**
     * @Module  (Manage Admins)
     */
    Route::any('/9gag-admin/manage',array(
        'as'    =>  'admin-manage-users',
        'uses'  =>  'AdminController@manageAdmins'
    ));
    
    /**
     * @Module  (Submissions Approval)
     */
    Route::any('/9gag-admin/submissions', array(
        'as'    =>  'submitted-posts',
        'uses'  =>  'AdminController@approvePosts'
    ));
});


?>