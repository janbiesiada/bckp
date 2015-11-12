<?php

/**
 * Newsletter Subscriptin (@Module)
 *
 * @Module  (Subscribe User)
 * @Module  (Verify Subscription)
 */
 
Route::post('/subscribe', array(
    'as'    => 'newsletter-subscribe',
    'uses'  => 'SubscriptionController@subscribe'
));

Route::post('/account/verify', array(
    'as'    => 'verify-account',
    'uses'  => 'AccountController@sendVerification'
));

Route::get('/subscribe/verify/{code}', array(
    'as'    => 'newsletter-subscribe-verify',
    'uses'  => 'SubscriptionController@verify'
));

?>