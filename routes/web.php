<?php

use Illuminate\Support\Facades\Auth;
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


Route::middleware('auth')
    ->namespace('admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::resource('posts','PostsController');
        Route::get('/user/{user}/posts','UserPostController@index')->name('user.posts');
        Route::get('/trash','TrashController@index')->name('trash');
        Route::any('/post/{post}/restore',[
            'uses' => 'RestoreController@restore',
            'as' => 'restore'
        ]);
        Route::any('/post/{post}/forcedelete',[
            'uses' => 'ForceDeleteController@destroy',
            'as' => 'forceDelete'
        ]);
    });
