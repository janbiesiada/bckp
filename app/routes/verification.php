<?php

/*************************************
 * User Verification Routes (@Module)
 * 
 * @Module  (User Verification)
 * @Module  (Adminstrator Verification)
 */
 
/**
 * @Module  (User Verification)
 */
Route::get('/account/activate/{code}', array(
    'as'    => 'account-activate',
    'uses'  => 'AccountController@getActivate'
));

/**
 * @Module  (Administrator Verification)
 */
Route::get('/a_account/activate/{code}', array(
    'as'    => 'admin-account-activate',
    'uses'  => 'AdminController@getActivate'
));

?>