<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/','HomeController@index');
Route::get('/about','AboutController@index');
Route::get('/gallery','GalleryController@index');
Route::get('/testimonials','TestimonialController@index');
Route::get('/services','ServicesController@index');
Route::get('/career','CareerController@index');
Route::get('/contact','ContactController@index');
Route::get('/user/login','UserController@index');
Route::get('/modalcontent/{id}','HomeController@modalcontent');
Route::get('/market','ScrapController@market');
Route::get('/nifty','ScrapController@nifty');
Route::get('/sensex','ScrapController@sensex');
Route::get('/nitybank','ScrapController@nitybank');
Route::get('/niftyit','ScrapController@niftyit');
Route::get('/nikkei','ScrapController@nikkei');
Route::get('/gold','ScrapController@gold');
Route::get('/silver','ScrapController@silver');
Route::get('/crudeoil','ScrapController@crudeoil');
Route::get('/usd','ScrapController@usd');

Route::post('user/login', 'UserController@doLogin');
Route::get('user/logout', 'UserController@logout');
Route::prefix('user')->middleware(['Logged'])->middleware(['role_user'])->group(function(){
	Route::get('register','UserController@register');
	Route::post('register','UserController@store');
	Route::get('dashboard','User\DashboardController@index');
	//Route::get('listing','UserController@listing');
	Route::get('listing','UserController@showListing');
	Route::post('add-category','CategoryController@addCategory');
	Route::get('profile','UserController@profile');
	Route::post('update-profile','UserController@updateprofile');
	Route::get('review','UserController@review');
	Route::post('addreview','UserController@addreview');
	//role
	/*Route::get('role','Admin\RoleController@index');
	Route::get('role/create','Admin\RoleController@create');
	Route::get('role/edit/{id}','Admin\RoleController@edit');
	Route::post('role/store','Admin\RoleController@store');
	Route::post('role/update/{id}','Admin\RoleController@update');
	Route::get('role/delete/{id}','Admin\RoleController@delete');
	//users
	Route::get('user','Admin\UsersController@index');
	Route::get('user/create','Admin\UsersController@create');
	Route::get('user/edit/{id}','Admin\UsersController@edit');
	Route::post('user/store','Admin\UsersController@store');
	Route::post('user/update/{id}','Admin\UsersController@update');
	Route::get('user/delete/{id}','Admin\UsersController@delete');*/
});

Route::prefix('admin')->group(function(){
	Route::get('login','Admin\LoginController@index');
	Route::post('login/validation','Admin\LoginController@validation');
	Route::get('logout','Admin\LoginController@logout');
});

Route::prefix('admin')->middleware(['Logged'])->middleware(['role_admin'])->group(function(){
	Route::get('dashboard','Admin\DashboardController@index');
	//role
	Route::get('role','Admin\RoleController@index');
	Route::get('role/create','Admin\RoleController@create');
	Route::get('role/edit/{id}','Admin\RoleController@edit');
	Route::post('role/store','Admin\RoleController@store');
	Route::post('role/update/{id}','Admin\RoleController@update');
	Route::get('role/delete/{id}','Admin\RoleController@delete');
	//users
	Route::get('user','Admin\UsersController@index');
	Route::get('user/create','Admin\UsersController@create');
	Route::get('user/edit/{id}','Admin\UsersController@edit');
	Route::post('user/store','Admin\UsersController@store');
	Route::post('user/update/{id}','Admin\UsersController@update');
	Route::get('user/delete/{id}','Admin\UsersController@delete');

	//Banner
	Route::get('banner/list','Admin\BannerController@index');
	//Route::get('user/create','Admin\UsersController@create');
	Route::get('banner/edit/{id}','Admin\BannerController@edit');
	//Route::post('user/store','Admin\UsersController@store');
	Route::post('banner/update/{id}','Admin\BannerController@update');
	//Route::get('user/delete/{id}','Admin\UsersController@delete');

	//Career
	Route::get('career/list','Admin\CareerController@index');
	Route::get('user/create','Admin\UsersController@create');
	Route::get('user/edit/{id}','Admin\UsersController@edit');
	Route::post('user/store','Admin\UsersController@store');
	Route::post('user/update/{id}','Admin\UsersController@update');
	Route::get('user/delete/{id}','Admin\UsersController@delete');
	//Content
	Route::get('content/services','Admin\ContentController@service');
	Route::get('content/service/edit/{id}','Admin\ContentController@editservice');
	Route::post('content/service/update','Admin\ContentController@updateservice');
	//Site settings
	Route::get('content/site/list','Admin\ContentController@sitesettingslist');
	Route::get('content/site/edit/{id}','Admin\ContentController@editsitesettings');
	Route::post('content/site/update','Admin\ContentController@updatesitesettings');
	
	Route::get('role/create','Admin\RoleController@create');
	Route::get('role/edit/{id}','Admin\RoleController@edit');
	Route::post('role/store','Admin\RoleController@store');
	Route::post('role/update/{id}','Admin\RoleController@update');
	Route::get('role/delete/{id}','Admin\RoleController@delete');
});