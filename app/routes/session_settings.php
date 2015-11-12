<?php

/**************************************
 * Session Settings (@Module)
 * 
 * @Module  (Timezone)
 * @Module  (Language)
 */
 
/**
 * @Module  (Timezone)
 */
Route::post('/set_timezone', array(
    'as'    => 'set-timezone',
    'uses'  => 'TimeZoneController@setTimeZone'
));



?>