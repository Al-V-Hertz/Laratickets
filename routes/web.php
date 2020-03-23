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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/client', 'ClientController@index')->name('client');
Route::get('/create-ticket', 'TicketController@index')->name('create-ticket');
Route::get('/pickup/{post}', 'TicketController@pickup');
Route::get('/return/{post}', 'TicketController@return');
Route::get('solved/{id}', 'TicketController@solved');
Route::post('/addtickets', 'TicketController@store');
Route::post('/add-thread', 'ThreadController@store');
Route::get('/thread/{post}', 'ThreadController@index');
// Route::post('editpost/{id}', '');
// Route::post('deletepost/{id}', '');