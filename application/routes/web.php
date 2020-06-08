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
    Route::get('/users', 'BackEnd\UserController@index')->name('users');
    Route::get('/userData', 'BackEnd\UserController@indexData')->name('user.data');
    Route::get('/userGet/{id}', 'BackEnd\UserController@getUser')->name('user.get');
    Route::get('/userDetail/{id}', 'BackEnd\UserController@detail')->name('user.detail');
    Route::post('/userSave', 'BackEnd\UserController@save')->name('user.save');
    Route::post('/userDelete/{id}', 'BackEnd\UserController@delete')->name('user.delete');
    Route::get('/userExport', 'BackEnd\UserController@export')->name('user.export');
    Route::get('/userSearch/{search}', 'BackEnd\UserController@search')->name('admin.user.search');

    //divisions
    Route::get('/divisions', 'BackEnd\DivisionController@index')->name('admin.divisions');
    Route::get('/divisionData', 'BackEnd\DivisionController@indexData')->name('admin.division.data');
    Route::get('/divisionGet/{id}', 'BackEnd\DivisionController@getData')->name('admin.division.get');
    Route::post('/divisionSave', 'BackEnd\DivisionController@save')->name('admin.division.save');
    Route::post('/divisionDelete/{id}', 'BackEnd\DivisionController@delete')->name('admin.division.delete');

    //pic
    Route::get('/pics', 'BackEnd\PicController@index')->name('admin.pics');
    Route::get('/picData', 'BackEnd\PicController@indexData')->name('admin.pic.data');
    Route::get('/picDetail/{id}', 'BackEnd\PicController@detail')->name('admin.pic.detail');
    Route::get('/picDownload', 'BackEnd\PicController@download')->name('admin.pic.download');
    Route::post('/picSave', 'BackEnd\PicController@save')->name('admin.pic.save');
    Route::post('/picDelete/{id}', 'BackEnd\PicController@delete')->name('admin.pic.delete');

    //reservation
    Route::get('/reservations', 'BackEnd\ReservationController@index')->name('admin.reservations');
    Route::get('/reservationData', 'BackEnd\ReservationController@indexData')->name('admin.reservation.data');
    Route::get('/reservationDetail/{id}', 'BackEnd\ReservationController@detail')->name('admin.reservation.detail');
    Route::get('/reservationDownload', 'BackEnd\ReservationController@download')->name('admin.reservation.download');
    Route::post('/reservationSave', 'BackEnd\ReservationController@save')->name('admin.reservation.save');
    Route::post('/reservationDelete/{id}', 'BackEnd\ReservationController@delete')->name('admin.reservation.delete');
    Route::post('/reservationApprove', 'BackEnd\ReservationController@approve')->name('admin.reservation.approve');

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
