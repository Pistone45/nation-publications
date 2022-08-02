<?php

use Illuminate\Support\Facades\Route;

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

//Display welcome page
Route::get('/', function () {
    return view('welcome');
});

//Login and Register links
Auth::routes();

//Home routes
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');

//Roles routes
Route::get('/roles', 'RoleController@index')->name('roles.home');
Route::post('roles', 'RolesController@store')->name('roles.store')->middleware(['admin']);
Route::patch('role/{role}', 'RolesController@update')->name('roles.update')->middleware(['admin']);
Route::delete('roles/{role}', 'RolesController@destroy')->name('roles.destroy')->middleware(['admin']);

//Users routes
Route::get('/users', 'UserController@index')->name('users.home');
Route::get('/users/get', 'UserController@get')->name('users.datatable');
Route::post('/users/regions', 'UserController@regions')->name('users.regions');
Route::get('/regions/get', 'UserController@getregions')->name('regions.datatable');

//Subscriptions routes
Route::get('/subscriptions', 'SubscriptionController@index')->name('subscriptions.home');
Route::get('get', 'SubscriptionController@get')->name('subscriptions.datatable');
Route::post('subscriptions', 'SubscriptionController@subscribe')->name('subscriptions.subscribe');
Route::get('subscriptions/cancel/{subscription}', 'SubscriptionController@cancel')->name('subscriptions.cancel');
Route::get('/subscribers', 'SubscriptionController@subscribers')->name('subscriptions.subscribers');
Route::get('/subscriptions/get', 'SubscriptionController@get')->name('subscriptions.datatable');
Route::post('subscriptions/unsubscribe', 'SubscriptionController@unsubscribe')->name('subscriptions.unsubscribe');
Route::get('subscriptions/view', 'SubscriptionController@subscriptions')->name('subscriptions.subscriptions');
Route::get('user/subscriptions/{user}', 'SubscriptionController@users')->name('subscriptions.users');
Route::get('/subscriptions/regions', 'SubscriptionController@regions')->name('subscriptions.regions');
Route::get('/subscriptions/publications', 'SubscriptionController@publications')->name('subscriptions.publications');
Route::get('/subscriptions/newspaper/{subscription}', 'SubscriptionController@newspaper')->name('subscriptions.newspaper');
Route::get('/subscriptions/history', 'SubscriptionController@history')->name('subscriptions.history');
Route::get('/history/get', 'SubscriptionController@gethistory')->name('history.datatable');
Route::get('/subscribers/history', 'SubscriptionController@subscriber_history')->name('subscribers.history');
Route::get('/admin-history/get', 'SubscriptionController@getsubscriberhistory')->name('subscribers.datatable');

//PDF and Receipt routes
Route::get('receipt/{subscription}', array('as'=> 'generate.receipt.pdf', 'uses' => 'SubscriptionController@generatereceiptPDF'));
Route::get('/receipt/view/{id}', 'SubscriptionController@viewreceipt')->name('subscriptions.viewreceipt');
