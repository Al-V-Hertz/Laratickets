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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/home', 'HomeController@index');
Auth::routes();

// admin only
Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/pickup/{post}', 'TicketController@pickup');
Route::get('/return/{post}', 'TicketController@return');

// client only
Route::get('/client', 'ClientController@index')->name('client');
Route::get('/create-ticket', 'TicketController@index')->name('create-ticket');
Route::post('/addtickets', 'TicketController@store');
Route::get('/solved/{id}', 'TicketController@solved');
Route::get('/deletepost/{id}', 'ThreadController@deletepost');

// both accesses
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/submit-edit/{id}', 'ThreadController@editstore');
Route::get('/editpost/{id}', 'ThreadController@editpost');
Route::post('/add-thread', 'ThreadController@store');
Route::get('/thread/{post}', 'ThreadController@index');