<?php

/**
 * Main Site Views  (@Module)
 * 
 * @Module  (Home)
 * @Module  (Sorted)
 * @Module  (Hashtag Pages)
 * @Module  (Category Pages)
 */
 
/**
 * @Module  (Home)
 */
Route::get('/', array(
    'as'    => 'home',
    'uses'  => 'ContentController@postsFeed'
));

/**
 * @Module (Sorted)
 */
Route::get('/sort/{ctype}', array(
    'as'    => 'content-type',
    'uses'  => 'ContentController@ShowCategoriesContent'
));

/**
 * @Module  (Hashtag Pages)
 */
Route::get('/hashtag/{tag}', array(
    'as'    => 'tags-content',
    'uses'  => 'ContentController@ShowHashTagContent'
));

Route::get('controversial/hashtag/{tag}', array(
    'as'    => 'tags-content-controversial',
    'uses'  => 'ContentController@ShowHashTagContentControversial'
));

/**
 * @Module  (Category Pages)
 */
Route::get('/c/{category}', array(
    'as'        => 'categories-content',
    'uses'      => 'ContentController@categories'
));

/*****************************
 * Post View    (@Module)
 * 
 * @Module  (Single Post View)
 */
 
/**
 * @Module  (Single Post View)
 */
Route::get('/gag/{lang}/{post}',array(
    'as'    => 'language-post',
    'uses'  => 'SingleViewController@singlePost'
)); 


/**
 * @Module  (Lanauge)
 */
Route::get('/set_language/{language}',array(
    'as'    => 'set-language',
    'uses'  => 'LanguageController@setLanguage'
));

$languages = Language::where('enabled','=',1)->lists('code');

foreach($languages as $language){
    Route::get('/'.$language,array(
        'as'    => 'serve-language',
        'uses'  => 'ContentController@languageContent'
    ));
}

foreach($languages as $language){
    Route::get($language.'/g/{pid}',array(
        'as'    => 'languages',
        'uses'  => 'SingleViewController@singlePost'
    ));
}

?>