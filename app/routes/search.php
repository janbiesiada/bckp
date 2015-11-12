<?php

Route::any('/search', array(
    'as'    => 'search-api',
    'uses'  => 'SearchController@search'
));

Route::post('/search/tags', array(
    'as'    => 'search-tags',
    'uses'  => 'SearchController@tags'
));

Route::any('/search/controversial', array(
    'as'    => 'search-controversial',
    'uses'  => 'SearchController@searchControversial'
));

?>