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
// wysiwyg (used CKEDITOR instead) ---DONE
// comment log 
// ticket format --DONE

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index');

// admin only
Route::group(["middleware" => "App\Http\Middleware\AdminCheck"], function(){
    Route::get('/admin', 'AdminController@index')->name('admin');
    Route::get('/pickup/{post}', 'TicketController@pickup');
    Route::get('/return/{post}', 'TicketController@return');
});

// client only
Route::group(["middleware" => "App\Http\Middleware\ClientCheck"], function(){
    Route::get('/client', 'ClientController@index')->name('client');
    Route::get('/create-ticket', 'TicketController@index')->name('create-ticket');
    Route::post('/addtickets', 'TicketController@store')->name('addtickets');
    Route::get('/solved/{tid}/{cid}', 'TicketController@solved');
    Route::get('/deletepost/{id}', 'ThreadController@deletepost');
});

// both accesses
Route::group(["middleware" => "App\Http\Middleware\AuthCheck"], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/submit-edit/{id}', 'TicketController@editstore');
    Route::get('/editpost/{id}', 'ThreadController@editpost');
    Route::post('/add-thread', 'ThreadController@store');
    Route::get('/thread/{post}', 'ThreadController@index');
});

Auth::routes();
