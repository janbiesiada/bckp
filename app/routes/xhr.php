<?php

/********************************
 * XHR Comments/Replies (@Module)
 * 
 * @Module  (Load Comments)
 * @Module  (Load Replies)
 */
 
/**
 * @Module  (Load Comments)
 */
Route::post('/load/comments', array(
    'as'    => 'load-more-comments',
    'uses'  => 'CommentController@loadMore'
));

/**
 * @Module  (Load Replies)
 */
Route::post('/load/replies', array(
    'as'    => 'load-more-replies',
    'uses'  =>  'ReplyController@loadMore'
));

?>