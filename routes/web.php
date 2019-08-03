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
Route::get('/', 'LoginController@showLoginForm')->name('login');
Route::post('login', 'LoginController@login')->name('proceed-login');

Route::middleware(['auth'])->group(function () {

    //dashboard
    Route::get('/dashboard', 'LoginController@dashboard')->name('dashboard');

    //logout
    Route::get('logout', 'LoginController@logout')->name('logout');


    //user
    Route::get('/admin/user','UserController@index')->name('user.index');
    Route::get('/admin/user/create','UserController@create')->name('user.create');
    Route::get('/admin/user/source','UserController@source')->name('user.source');
    Route::get('/admin/user/{id}/edit','UserController@edit')->name('user.edit');
    Route::get('/admin/user/{id}/show','UserController@show')->name('user.show');
    Route::get('/admin/user/{id}/destroy','UserController@destroy')->name('user.destroy');
    Route::post('/admin/user/store','UserController@store')->name('user.store');
    Route::post('/admin/user/{id}/update','UserController@update')->name('user.update');
    Route::get('/admin/user/change','UserController@change')->name('user.change');
    Route::post('/admin/user/updatePassword','UserController@updatePassword')->name('user.updatePassword');

    //role
    Route::get('/admin/role','RoleController@index')->name('role.index');
    Route::get('/admin/role/create','RoleController@create')->name('role.create');
    Route::get('/admin/role/source','RoleController@source')->name('role.source');
    Route::get('/admin/role/{id}/edit','RoleController@edit')->name('role.edit');
    Route::get('/admin/role/{id}/show','RoleController@show')->name('role.show');
    Route::get('/admin/role/{id}/destroy','RoleController@destroy')->name('role.destroy');
    Route::post('/admin/role/store','RoleController@store')->name('role.store');
    Route::post('/admin/role/{id}/update','RoleController@update')->name('role.update');

    //account
    Route::get('/admin/account','AccountController@index')->name('account.index');
    Route::get('/admin/account/create','AccountController@create')->name('account.create');
    Route::get('/admin/account/source','AccountController@source')->name('account.source');
    Route::get('/admin/account/{id}/edit','AccountController@edit')->name('account.edit');
    Route::get('/admin/account/{id}/show','AccountController@show')->name('account.show');
    Route::get('/admin/account/{id}/destroy','AccountController@destroy')->name('account.destroy');
    Route::post('/admin/account/store','AccountController@store')->name('account.store');
    Route::post('/admin/account/{id}/update','AccountController@update')->name('account.update');
    
    
    
    //transaction
    Route::get('/admin/transaction/{transaction_type}','TransactionController@index')->name('transaction.index');
    Route::get('/admin/transaction/create/{transaction_type}','TransactionController@create')->name('transaction.create');
    Route::get('/admin/transaction/source','TransactionController@source')->name('transaction.source');
    Route::get('/admin/transaction/{id}/edit','TransactionController@edit')->name('transaction.edit');
    Route::get('/admin/transaction/{id}/printJobSheet','TransactionController@printJobSheet')->name('transaction.printJobSheet');
    Route::get('/admin/transaction/{id}/printDeliveryOrder','TransactionController@printDeliveryOrder')->name('transaction.printDeliveryOrder');
    Route::get('/admin/transaction/{id}/printInvoice','TransactionController@printInvoice')->name('transaction.printInvoice');
    Route::get('/admin/transaction/{id}/show','TransactionController@show')->name('transaction.show');
    Route::get('/admin/transaction/{id}/destroy','TransactionController@destroy')->name('transaction.destroy');
    Route::get('/admin/transaction/{id}/getContainer','TransactionController@getContainer')->name('transaction.getContainer');
    Route::post('/admin/transaction/store','TransactionController@store')->name('transaction.store');
    Route::post('/admin/transaction/{id}/update','TransactionController@update')->name('transaction.update');

    Route::post('/admin/transaction/makeInvoice','TransactionController@makeInvoice')->name('transaction.makeInvoice');
    Route::get('/admin/transaction/{id}/editCharge/{charge_id}','TransactionController@editCharge')->name('transaction.editCharge');
    Route::get('/admin/transaction/{id}/destroyCharge/{charge_id}','TransactionController@destroyCharge')->name('transaction.destroyCharge');
    Route::post('/admin/transaction/{id}/updateCharge/{charge_id}','TransactionController@updateCharge')->name('transaction.updateCharge');
    
    
    // notused
    // Route::get('/admin/transaction/history','TransactionController@history')->name('transaction.history');
    // Route::get('/admin/transaction/{id}/print','TransactionController@print')->name('transaction.print');
    // Route::post('/admin/transaction/export','TransactionController@export')->name('transaction.export');
    // Route::post('/admin/transaction/{id}/complete','TransactionController@complete')->name('transaction.complete');
    // Route::get('/admin/transaction/{status}/source','TransactionController@source')->name('transaction.source');

    //setting
    Route::get('/admin/setting','SettingController@index')->name('setting.index');
    Route::get('/admin/setting/create','SettingController@create')->name('setting.create');
    Route::get('/admin/setting/source','SettingController@source')->name('setting.source');
    Route::get('/admin/setting/{id}/edit','SettingController@edit')->name('setting.edit');
    Route::get('/admin/setting/{id}/show','SettingController@show')->name('setting.show');
    Route::get('/admin/setting/{id}/destroy','SettingController@destroy')->name('setting.destroy');
    Route::post('/admin/setting/store','SettingController@store')->name('setting.store');
    Route::post('/admin/setting/change','SettingController@change')->name('setting.change');
    Route::post('/admin/setting/{id}/update','SettingController@update')->name('setting.update');

});
