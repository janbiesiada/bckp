<?php

Route::post('/hide/tag', array(
    'as'    => 'hide-content',
    'uses'  => 'ContentController@hidePost'
));

Route::post('/follow/tag', array(
    'as'    => 'follow-tag',
    'uses'  => 'ContentController@followTag'
));


Route::post('/follow/post', array(
    'as'    => 'follow-post',
    'uses'  => 'ContentController@followPost'
));
Route::post('/hide/report', array(
    'as'    => 'hide-report-content',
    'uses'  => 'ContentController@hidePostReport'
));


?>
