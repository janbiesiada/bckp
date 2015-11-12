<?php

/***********************************
 * Recover Password     (@Module)
 * 
 * @Module  Recover
 */
Route::any('/recover' ,array(
    'as' => 'recover-password',
    'uses' => 'RecoveryController@recover'
));


?>