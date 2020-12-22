<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::get('/home/create', 'PostController@create')->name('posts.create');
Route::post('/home', 'PostController@store')->name('posts.store');
Route::get('/comment/{post}', 'CommentController@create')->name('comments.create');
Route::get('/home/{post}', 'PostController@show')->name('posts.show');
Route::delete('home/{post}', 'PostController@destroy')->name('posts.destroy');
Route::get('/edit/{post}', 'PostController@edit')->name('posts.edit');
Route::post('/edit', 'PostController@update')->name('posts.update');
