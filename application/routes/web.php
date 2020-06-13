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

Auth::routes();

Route::get('/', 'FrontEnd\PageController@index')->name('home');

Route::post('/register-member', 'Auth\RegisterController@registerMember')->name('register.member');
Route::post('/reset-password', 'Frontend\PageController@resetPassword')->name('pic.reset.password');
Route::get('/login', 'FrontEnd\PageController@login')->name('login');
Route::get('/register', 'FrontEnd\PageController@register')->name('register');
Route::post('/save-register', 'FrontEnd\PageController@saveRegister')->name('register.save');

Route::group(['prefix' => 'pic', 'middleware' => ['auth']], function () {
    Route::post('/save-account', 'FrontEnd\PicController@saveAccount')->name('pic.save.account');
});

Route::group(['prefix' => 'reservation', 'middleware' => ['auth']], function () {
    Route::get('/reservationDetail/{id}', 'FrontEnd\ReservationController@reservationDetail')->name('reservation.detail');
    Route::post('/reservationSave', 'FrontEnd\ReservationController@reservationSave')->name('reservation.save');
    Route::post('/reservationDelete/{id}', 'FrontEnd\ReservationController@reservationDelete')->name('reservation.delete');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'BackEnd\BackEndController@login')->name('admin.login');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin:ADMIN']], function () {
    Route::get('/', 'BackEnd\BackEndController@dashboard')->name('admin.dashboard');
    //Users
    Route::get('/users', 'BackEnd\UserController@index')->name('admin.users');
    Route::get('/userData', 'BackEnd\UserController@indexData')->name('admin.user.data');
    Route::get('/userGet/{id}', 'BackEnd\UserController@getUser')->name('admin.user.get');
    Route::get('/userDetail/{id}', 'BackEnd\UserController@detail')->name('admin.user.detail');
    Route::post('/userSave', 'BackEnd\UserController@save')->name('admin.user.save');
    Route::post('/userDelete/{id}', 'BackEnd\UserController@delete')->name('admin.user.delete');
    Route::get('/userExport', 'BackEnd\UserController@export')->name('admin.user.export');
    Route::get('/userSearch/{search}', 'BackEnd\UserController@search')->name('admin.user.search');

    //Members
    Route::get('/members', 'BackEnd\MemberController@index')->name('admin.members');
    Route::get('/memberData', 'BackEnd\MemberController@indexData')->name('admin.member.data');
    Route::get('/memberGet/{id}', 'BackEnd\MemberController@getData')->name('admin.member.get');
    Route::post('/memberSave', 'BackEnd\MemberController@save')->name('admin.member.save');
    Route::post('/memberDelete/{id}', 'BackEnd\MemberController@delete')->name('admin.member.delete');
    Route::get('/memberExport', 'BackEnd\MemberController@export')->name('admin.member.export');
    Route::get('/memberSearch/{search}', 'BackEnd\MemberController@search')->name('admin.member.search');

    //Categories
    Route::get('/categories', 'BackEnd\CategoryController@index')->name('admin.categories');
    Route::get('/categoryData', 'BackEnd\CategoryController@indexData')->name('admin.category.data');
    Route::get('/categoryGet/{id}', 'BackEnd\CategoryController@getData')->name('admin.category.get');
    Route::post('/categorySave', 'BackEnd\CategoryController@save')->name('admin.category.save');
    Route::post('/categoryDelete/{id}', 'BackEnd\CategoryController@delete')->name('admin.category.delete');
    Route::get('/categoryExport', 'BackEnd\CategoryController@export')->name('admin.category.export');

    //notification
    Route::get('/notifications', 'BackEnd\NotificationController@index')->name('admin.notifications');
    Route::get('/notificationData', 'BackEnd\NotificationController@indexData')->name('admin.notification.data');
    Route::post('/notificationClear', 'BackEnd\NotificationController@clear')->name('admin.notification.clear');

    //SETTING
    Route::get('/settings', 'BackEnd\SettingController@index')->name('settings');
    Route::post('/settingSave', 'BackEnd\SettingController@save')->name('setting.save');
});

Route::get('/province', 'BackEnd\BackEndController@getProvince')->name('get.province');
Route::get('/city/{province}', 'BackEnd\BackEndController@getCity')->name('get.city');
Route::get('/district/{city}', 'BackEnd\BackEndController@getDistrict')->name('get.district');
