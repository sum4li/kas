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
    
    //customer
    Route::get('/admin/customer','CustomerController@index')->name('customer.index');
    Route::get('/admin/customer/create','CustomerController@create')->name('customer.create');
    Route::get('/admin/customer/source','CustomerController@source')->name('customer.source');
    Route::get('/admin/customer/{id}/edit','CustomerController@edit')->name('customer.edit');
    Route::get('/admin/customer/{id}/show','CustomerController@show')->name('customer.show');
    Route::get('/admin/customer/{id}/destroy','CustomerController@destroy')->name('customer.destroy');
    Route::post('/admin/customer/store','CustomerController@store')->name('customer.store');
    Route::post('/admin/customer/{id}/update','CustomerController@update')->name('customer.update');
    Route::get('/admin/customer/{id}/get','CustomerController@get')->name('customer.get');
    Route::get('/admin/customer/getCustomer','CustomerController@getCustomer')->name('customer.getCustomer');
    // Route::get('/admin/customer/{search}/getCustomer','CustomerController@getCustomer')->name('customer.getCustomer');
    
    //unit
    Route::get('/admin/unit','UnitController@index')->name('unit.index');
    Route::get('/admin/unit/create','UnitController@create')->name('unit.create');
    Route::get('/admin/unit/source','UnitController@source')->name('unit.source');
    Route::get('/admin/unit/{id}/edit','UnitController@edit')->name('unit.edit');
    Route::get('/admin/unit/{id}/show','UnitController@show')->name('unit.show');
    Route::get('/admin/unit/{id}/destroy','UnitController@destroy')->name('unit.destroy');
    Route::post('/admin/unit/store','UnitController@store')->name('unit.store');
    Route::post('/admin/unit/{id}/update','UnitController@update')->name('unit.update');
    Route::get('/admin/unit/{id}/get','UnitController@get')->name('unit.get');
    Route::get('/admin/unit/getUnit','UnitController@getUnit')->name('unit.getUnit');
    // Route::get('/admin/unit/{search}/getUnit','UnitController@getUnit')->name('unit.getUnit');
    
    //exchangeRate
    Route::get('/admin/exchangeRate','ExchangeRateController@index')->name('exchangeRate.index');
    Route::get('/admin/exchangeRate/create','ExchangeRateController@create')->name('exchangeRate.create');
    Route::get('/admin/exchangeRate/source','ExchangeRateController@source')->name('exchangeRate.source');
    Route::get('/admin/exchangeRate/{id}/edit','ExchangeRateController@edit')->name('exchangeRate.edit');
    Route::get('/admin/exchangeRate/{id}/show','ExchangeRateController@show')->name('exchangeRate.show');
    Route::get('/admin/exchangeRate/{id}/destroy','ExchangeRateController@destroy')->name('exchangeRate.destroy');
    Route::post('/admin/exchangeRate/store','ExchangeRateController@store')->name('exchangeRate.store');
    Route::post('/admin/exchangeRate/{id}/update','ExchangeRateController@update')->name('exchangeRate.update');
    Route::get('/admin/exchangeRate/{id}/get','ExchangeRateController@get')->name('exchangeRate.get');
    Route::get('/admin/exchangeRate/getExchangeRate','ExchangeRateController@getExchangeRate')->name('exchangeRate.getExchangeRate');
    // Route::get('/admin/exchangeRate/{search}/getExchangeRate','ExchangeRateController@getExchangeRate')->name('exchangeRate.getExchangeRate');
    
    //currency
    Route::get('/admin/currency','CurrencyController@index')->name('currency.index');
    Route::get('/admin/currency/create','CurrencyController@create')->name('currency.create');
    Route::get('/admin/currency/source','CurrencyController@source')->name('currency.source');
    Route::get('/admin/currency/{id}/edit','CurrencyController@edit')->name('currency.edit');
    Route::get('/admin/currency/{id}/show','CurrencyController@show')->name('currency.show');
    Route::get('/admin/currency/{id}/destroy','CurrencyController@destroy')->name('currency.destroy');
    Route::post('/admin/currency/store','CurrencyController@store')->name('currency.store');
    Route::post('/admin/currency/{id}/update','CurrencyController@update')->name('currency.update');
    Route::get('/admin/currency/{id}/get','CurrencyController@get')->name('currency.get');
    Route::get('/admin/currency/getCurrency','CurrencyController@getCurrency')->name('currency.getCurrency');
    // Route::get('/admin/currency/{search}/getCurrency','CurrencyController@getCurrency')->name('currency.getCurrency');
    
    //transaction
    Route::get('/admin/transaction','TransactionController@index')->name('transaction.index');
    Route::get('/admin/transaction/create','TransactionController@create')->name('transaction.create');
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
    Route::post('/admin/transaction/{id}/storeCharge','TransactionController@storeCharge')->name('transaction.storeCharge');
    Route::post('/admin/transaction/makeInvoice','TransactionController@makeInvoice')->name('transaction.makeInvoice');
    Route::get('/admin/transaction/{id}/editCharge/{charge_id}','TransactionController@editCharge')->name('transaction.editCharge');
    Route::get('/admin/transaction/{id}/destroyCharge/{charge_id}','TransactionController@destroyCharge')->name('transaction.destroyCharge');
    Route::post('/admin/transaction/{id}/updateCharge/{charge_id}','TransactionController@updateCharge')->name('transaction.updateCharge');
    
    //invoice
    Route::get('/admin/invoice','InvoiceController@index')->name('invoice.index');
    Route::get('/admin/invoice/{where}','InvoiceController@where')->name('invoice.where');
    Route::get('/admin/invoice/source/{status}','InvoiceController@source')->name('invoice.source');
    
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
