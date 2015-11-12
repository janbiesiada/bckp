<?php


Route::group(array('before' => 'auth'), function(){
    
    
    /*************************************
     * Comment & Replies Posting (@Module)
     *
     * @Module  (Post Comment)
     * @Module  (Post Reply)
     * @Module  (Get Details)
     * @Module  (Update Comment)
     * @Module  (Update Reply)
     */
     
    /**
     * @Module  (Post Comment)
     */
    Route::post('/post/comment', array(
        'as'    => 'comment-post',
        'uses'  => 'CommentController@postComment'
    ));
    
    /**
     * @Module  (Post Reply)
     */
    Route::post('/post/reply',array(
        'as'    => 'post-comment-reply',
        'uses'  => 'ReplyController@postReply'
    ));

    /**
     * @Module  (Get Details)
     */
    Route::post('/get/details', array(
        'as'    => 'get-user-details',
        'uses'  => 'ProfileController@getDetails'
    ));
    
    /**
     * @Module  (Update Comment)
     */
    Route::post('/update/comment',array(
        'as'    =>  'update-comment',
        'uses'  =>  'CommentController@updateComment'
    ));
    
    /**
     * @Module  (Update Reply)
     */
    Route::post('/update/reply', array(
        'as'    =>  'update-reply',
        'uses'  => 'ReplyController@updateReply'
    ));
    
});

?>