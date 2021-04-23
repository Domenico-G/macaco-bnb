<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Flat;

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

Route::get('/', 'GuestController@index');
Auth::routes();


Route::post('message', 'MessageController@store')->name('message');


Route::get('flats', 'GuestController@index')->name('public.flats.home');
Route::get('flats/{flat}', 'GuestController@show')->name('public.flats.show');
Route::get('search', 'GuestController@searchView')->name('public.flats.search');




// Route::resource('flats', ('Admin\FlatController'))->middleware("auth");
Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function(){
        Route::resource('flats', 'FlatController');
        Route::get('dashboard', 'DashboardController')->name("admin.dashboard");
        Route::get('sponsor/{flat}', 'SponsorController@create')->name("admin.sponsor.create");
        Route::post('sponsor', 'SponsorController@store')->name("admin.sponsor.store");
    });
