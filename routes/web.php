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

use Illuminate\Support\Facades\Artisan;

;

//Route::any('{admin}', function ($any = null) {
//        return view('under_constraction');
//})->where('admin', '.*');

Route::get('/clear_cache', function() {
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

//frontend route
Route::get('blank','Admin\AdminDashboardController@blank')->name('blank');
Route::get('contact','HomeController2@contact')->name('contact');
Route::get('user_registration','HomeController2@user_registration')->name('user_registration');
Route::post('user_registration_store','HomeController2@user_registration_store')->name('user_registration_store');
Route::get('user_login','HomeController2@user_login')->name('user_login');
Route::get('user_dashboard','HomeController2@user_dashboard')->name('user_dashboard');
Route::post('update_user_info/{id}','HomeController2@update_user_info')->name('update_user_info');
Route::get('price_list','HomeController2@price_list')->name('price_list');
//bill_pay
Route::get('Pay_bill','HomeController2@Pay_bill')->name('Pay_bill');
Route::post('phone_number_search','HomeController2@phone_number_search')->name('phone_number_search');
Route::get('online_payment/{id}','HomeController2@online_payment')->name('online_payment');

//guest customer add
Route::get('guest_customer_order/{id}','HomeController_3@guest_customer_order')->name('guest_customer_order');
Route::post('guest_customer_order_with_package_id/{id}','HomeController_3@guest_customer_order_with_package_id')->name('guest_customer_order_with_package_id');
Route::post('guest_user_registration','HomeController_3@guest_user_registration')->name('guest_user_registration');




//feature
Route::get('feature','HomeController2@feature')->name('feature');
Route::get('map','HomeController2@map')->name('map');
Route::get('our_devices','HomeController2@our_devices')->name('our_devices');
Route::get('/','HomeController2@index')->name('home');

Auth::routes();

//Route::get('/home', 'HomeControllerNew@index')->name('home');

//Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

//all admin route
Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']],function()
{
    Route::get('adminDashboard','AdminDashboardController@index')->name('adminDashboard');
    Route::get('sub_admins','AdminDashboardController@sub_admins')->name('sub_admins');
    Route::get('sub_admins_approve/{id}','AdminDashboardController@sub_admins_approve')->name('sub_admins_approve');
    //home page Banner
    Route::get('home_page_banner','AdminDashboardController@home_page_banner')->name('home_page_banner');
    Route::post('home_page_banner_save','AdminDashboardController@home_page_banner_save')->name('home_page_banner_save');
    Route::get('home_page_banner_delete/{id}','AdminDashboardController@home_page_banner_delete')->name('home_page_banner_delete');

//    Happy client add
    Route::get('happy_client','AdminDashboardController@happy_client')->name('happy_client');
    Route::post('happy_client_save','AdminDashboardController@happy_client_save')->name('happy_client_save');
    Route::get('happy_client_delete/{id}','AdminDashboardController@happy_client_delete')->name('happy_client_delete');

//    service
    Route::get('add_services','AdminDashboardController@add_services')->name('add_services');
    Route::post('add_services_save','AdminDashboardController@add_services_save')->name('add_services_save');
    Route::get('service_delete/{id}','AdminDashboardController@service_delete')->name('service_delete');

//    demo
    Route::get('add_demo','AdminDashboardController@add_demo')->name('add_demo');
    Route::post('demo_save','AdminDashboardController@demo_save')->name('demo_save');
    Route::get('demo_delete/{id}','AdminDashboardController@demo_delete')->name('demo_delete');

//    team
    Route::get('team','AdminDashboardController@team')->name('team');
    Route::post('team_save','AdminDashboardController@team_save')->name('team_save');
    Route::get('team_delete/{id}','AdminDashboardController@team_delete')->name('team_delete');

    //    contact information
    Route::get('contact','AdminDashboardController@contact')->name('contact');
    Route::post('contact_save','AdminDashboardController@contact_save')->name('contact_save');
    Route::get('contact_delete/{id}','AdminDashboardController@contact_delete')->name('contact_delete');

    //bill_schedule
    Route::get('bill_schedule/calendar','BillScheduleController@calendar')->name('calendar');
    Route::post('bill_schedule/calendar_search','BillScheduleController@calendar_search')->name('calendar_search');
    Route::get('bill_schedule/bill_schedule','BillScheduleController@bill_schedule')->name('bill_schedule');
    Route::get('bill_schedule/all_bill_schedule','BillScheduleController@all_bill_schedule')->name('all_bill_schedule');
    Route::post('bill_schedule/rebill_schedule','BillScheduleController@rebill_schedule')->name('rebill_schedule');

    //all user
    Route::resource('all_user', 'All_usercontroller');
    Route::get('user_delete/{id}', 'All_usercontroller@user_delete')->name('user_delete');
    Route::post('monthly_bill_update/{id}', 'All_usercontroller@monthly_bill_update')->name('monthly_bill_update');
    Route::get('full_order_history/{id}', 'All_usercontroller@full_order_history')->name('full_order_history');
    Route::post('bill_schedule', 'All_usercontroller@bill_schedule')->name('bill_schedule');
    Route::post('user_note_save/{id}', 'All_usercontroller@user_note_save')->name('user_note_save');

    Route::get('expire_user', 'All_usercontroller@expire_user')->name('expire_user');
    Route::get('active_user/{id}', 'All_usercontroller@active_user')->name('active_user');

    Route::get('corporate_user', 'All_usercontroller@corporate_user')->name('corporate_user');
    Route::get('individual_user', 'All_usercontroller@individual_user')->name('individual_user');
    Route::get('paid_user', 'All_usercontroller@paid_user')->name('paid_user');
    Route::get('due_user', 'All_usercontroller@due_user')->name('due_user');

    Route::get('export', 'All_usercontroller@export')->name('export');
    Route::post('update_user_after_mistake', 'All_usercontroller@update_user_after_mistake')->name('update_user_after_mistake');

    //    payment
    Route::post('update_payment/{id}','paymentControlller@update_payment')->name('update_payment');
    Route::get('delete_payment_history/{id}','paymentControlller@delete_payment_history')->name('delete_payment_history');

    //all Technician
    Route::resource('technician', 'TechnicianController');
    Route::get('technician_delete/{id}', 'TechnicianController@technician_delete')->name('technician_delete');
    Route::post('technician_assign', 'TechnicianController@technician_assign')->name('technician_assign');
    Route::post('conpletation', 'TechnicianController@conpletation')->name('conpletation');
    Route::post('order_cancel', 'TechnicianController@order_cancel')->name('order_cancel');
    Route::get('ajax_assign_devices/{id}', 'TechnicianController@ajax_assign_devices')->name('ajax_assign_devices');

    //device
    Route::resource('device', 'DeviceController');
    Route::get('device_delete/{id}', 'DeviceController@device_delete')->name('device_delete');
    Route::post('assign_technician/{id}', 'DeviceController@assign_technician')->name('assign_technician');
    Route::post('assign_technician_from_device_stock', 'DeviceController@assign_technician_from_device_stock')->name('assign_technician_from_device_stock');
    Route::get('device_transaction_history', 'DeviceController@device_transaction_history')->name('device_transaction_history');
    Route::post('device_transaction_history_date', 'DeviceController@device_transaction_history_date')->name('device_transaction_history_date');
    Route::post('device_transaction_history_date_single', 'DeviceController@device_transaction_history_date_single')->name('device_transaction_history_date_single');
    Route::post('device_transaction_history_date_single', 'DeviceController@device_transaction_history_date_single')->name('device_transaction_history_date_single');
    Route::post('technician_stock', 'DeviceController@technician_stock')->name('technician_stock');
    Route::get('ajax_search_for_assign_tech/{id}', 'DeviceController@ajax_search_for_assign_tech')->name('ajax_search_for_assign_tech');


//    price list
    Route::resource('price_list', 'priceListController');
    Route::get('price_cat_delete/{id}', 'priceListController@price_cat_delete')->name('price_cat_delete');
    Route::get('add_price_subcategory/{id}', 'priceListController@add_price_subcategory')->name('add_price_subcategory');
    Route::post('sub_cat_save', 'priceListController@sub_cat_save')->name('sub_cat_save');
    Route::get('delete_sub/{id}', 'priceListController@delete_sub')->name('delete_sub');
    Route::get('sub_edit/{id}', 'priceListController@sub_edit')->name('sub_edit');
    Route::post('sub_update/{id}', 'priceListController@sub_update')->name('sub_update');



    //feature
    Route::get('feature/add_feature', 'FeatureController@add_feature')->name('add_feature');
    Route::get('feature/feature_edit/{id}', 'FeatureController@feature_edit')->name('feature_edit');
    Route::post('feature/update_feature/{id}', 'FeatureController@update_feature')->name('update_feature');
    Route::post('feature/feature_save', 'FeatureController@feature_save')->name('feature_save');
    Route::get('feature/feature_delete/{id}', 'FeatureController@feature_delete')->name('feature_delete');


    //order
    Route::resource('order', 'OrderController');
    Route::get('assigned_order', 'OrderController@assigned_order')->name('assigned_order');
    Route::get('custom_order', 'OrderController@custom_order')->name('custom_order');


//    history
    Route::get('history/device_sell_history', 'HistoryController@device_sell_history')->name('device_sell_history');
    Route::get('history/billing_history', 'HistoryController@billing_history')->name('billing_history');
    Route::post('history/billing_history_search_date', 'HistoryController@billing_history_search_date')->name('billing_history_search_date');
    Route::get('history/payment_by_online', 'HistoryController@payment_by_online')->name('payment_by_online');


    //sms
    Route::get('sms/send_personal_sms/{id}', 'SmsController@send_personal_sms')->name('send_personal_sms');
    Route::get('sms/send_sms_to_due_user', 'SmsController@send_sms_to_due_user')->name('send_sms_to_due_user');
    Route::get('sms/over_due_sms', 'SmsController@over_due_sms')->name('over_due_sms');
    Route::get('sms/single_sms/{id}', 'SmsController@single_sms')->name('single_sms');

    //all_complain
    Route::get('all_complain', 'ComplainController@all_complain')->name('all_complain');
    Route::get('solve_complain/{id}', 'ComplainController@solve_complain')->name('solve_complain');

    //WhatClientSaysController
    Route::get('client_says/client_says', 'WhatClientSaysController@client_says')->name('client_says');


    //Tracking Device
    Route::get('tracking_device/tracking_device', 'TrackingDeviceController@tracking_device')->name('tracking_device');
    Route::get('tracking_device/tracking_device_delete/{id}', 'TrackingDeviceController@tracking_device_delete')->name('tracking_device_delete');
    Route::post('tracking_device/tracking_device_save', 'TrackingDeviceController@tracking_device_save')->name('tracking_device_save');





});





//all author route
Route::group(['as'=>'author.','prefix'=>'author','namespace'=>'Author','middleware'=>['auth','author']],function()
{
    Route::get('authorDashboard','AuthorDashboardController@index')->name('authorDashboard');
});

//all user route
Route::group(['as'=>'user.','prefix'=>'user','namespace'=>'User','middleware'=>['auth','user']],function()
{
    Route::get('user_dashboard','UserController@user_dashboard')->name('user_dashboard');
    Route::get('payment/{id}','UserController@payment')->name('payment');
    Route::post('post_complain/{id}','UserController@post_complain')->name('post_complain');
    Route::post('cash_on_delevery', 'UserController@cash_on_delevery')->name('cash_on_delevery');
});



// SSLCOMMERZ Start
Route::get('/example1', 'SslCommerzPaymentController@exampleEasyCheckout')->name('cash_out_page');
Route::get('/example2', 'SslCommerzPaymentController@exampleHostedCheckout');

Route::post('/pay', 'SslCommerzPaymentController@index')->name('ssl_pay');
Route::post('/guest_user_register_order/{id}', 'SslCommerzPaymentController@guest_user_register_order')->name('guest_user_register_order');
Route::post('/bill_payment_pay/{id}', 'SslCommerzPaymentController@bill_payment_pay')->name('bill_payment_pay');
Route::post('/pay-via-ajax', 'SslCommerzPaymentController@payViaAjax')->name('pay_with_ajax');

Route::post('/success', 'SslCommerzPaymentController@success');
Route::post('/bill_payment_pay_success', 'SslCommerzPaymentController@bill_payment_pay_success')->name('bill_payment_pay_success');
Route::post('/fail', 'SslCommerzPaymentController@fail');
Route::post('/cancel', 'SslCommerzPaymentController@cancel');

Route::post('/ipn', 'SslCommerzPaymentController@ipn');


Route::get('/by_me', 'SslCommerzPaymentController@by_me')->name('by_me');
//SSLCOMMERZ END
