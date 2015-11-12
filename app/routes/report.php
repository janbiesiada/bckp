<?php

Route::group(array('before' => 'auth'), function(){

    
    /**********************************
     * Report Content   (@Module)
     * 
     * @Module  (Report Comment/Replies)
     * @Module  (Report Posts)
     */
    
    /**
     * @Module  (Report Comment/Replies)
     */
    Route::post('/report/item', array(
        'as'    => 'report-item',
        'uses'  => 'ReportController@report'
    ));
    
    /**
     * @Module  (Report Posts)
     */
    Route::post('/report/flag', array(
        'as'    => 'report-post',
        'uses'  => 'ReportController@reportPost'
    ));
     
}); 

?>
