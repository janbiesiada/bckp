<?php

Route::group(array('before' => 'auth'), function(){
    

    /***********************
     * 
     * POST Upload (@Module)
     * 
     * @Module  (URL Upload)
     * @Module  (File Upload)
     */
     
    /**
     * @Module  (File Upload)
     */
    Route::post('/upload/item/photo',array(
        'as'    => 'upload-post',
        'uses'  => 'PostsController@uploadPost'
    ));
    
    /**
     * @Module (URL Upload)
     */
    Route::post('/upload/item/url',array(
        'as'    => 'url-upload-post',
        'uses'  => 'PostsController@urlUploadPost'
    ));
    
    Route::post('/upload/item/vine', array(
        'as'    => 'vine-upload',
        'uses'  => 'PostsController@vinesUpload'
    ));
    
    Route::post('/upload/item/youtube', array(
        'as'    => 'youtube-upload',
        'uses'  => 'PostsController@youtubeUpload'
    ));
    
    Route::post('/upload/item/tag', array(
        'as'    => 'add-tag',
        'uses'  => 'PostsController@addTag'
    ));
  
});
