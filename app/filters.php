<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/


App::before(function($request)
{
	
	if(!Request::secure() && array_get($_SERVER, 'SERVER_PORT') != 443){
        return Redirect::secure(Request::path());
    }
    
    
	//
	if(!Session::has('timezone')){
		Session::set('timezone', 'America/New_York');
	}
	
	
	if(Session::has('auth')){
		if(!Session::has('language')){
			Session::put('language',Session::get('auth')['language']);
		}
	}else{
		if(!Session::has('language')){
			Session::put('language','English');
		}
	}
	
	$user	=	User::where('username','=',Session::get('auth')['username']);
	
	if(!$user->count()){
		Session::forget('auth');
	}
	
	if(!MetaData::count()){
		$meta	=	MetaData::create(array(
						'type' => 'details'
					));
	}
	
	if(!Emailer::count()){
		Emailer::create(array(
			'type'	=>	'activate_user'
		));
		
		Emailer::create(array(
			'type'	=>	'recover_user'
		));
		
		Emailer::create(array(
			'type'	=>	'subscribe_newsletter'
		));
		
		Emailer::create(array(
			'type'	=>	'activate_admin'
		));
	}
	
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (!Session::has('auth'))
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::secure('login')->with('global', 'You need to sign in to view this page!');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Session::has('auth')) return Redirect::secure('/');
});


/*
|	UnAuthenticated Group Filter For Admin Dashboards
*/

Route::filter('admin_guest', function(){
	if(Session::has('admin_auth')) return Redirect::secure('/9gag-admin');
});

/*
|	Authenticated Group Filter For Admin Dashboards
*/
Route::filter('admin_auth', function(){
	if(!Session::has('admin_auth')) return Redirect::secure('/9gag-admin/login');
});


Route::filter('temp', function(){
	if(!Session::has('temp')) return Redirect::secure('/');	
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
