<?php
Route::group(array('before' => 'auth'), function(){
    
    
    /****************************
     * Delete Content   (@Module)
     * 
     * @Module  (Delete Item)
     */
    
    /**
     * @Module  (Delete Items)
     */
    Route::post('/delete/item',array(
        'as'    => 'delete-post',
        'uses'  => 'DeleteController@remove'
    ));
});
?>