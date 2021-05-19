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
Route::get('generate-shorten-link', 'ShortLinkController@index');
Route::post('generate-shorten-link', 'ShortLinkController@store')->name('generate.shorten.link.post');
   
Route::get('{code}', 'ShortLinkController@shortenLink')->name('shorten.link');
//Route::get('/list', 'ShortLinkController@analyticdata')->name('a;
//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('analyticdata','ShortLinkController@analyticdata')->name('analyticdata');
Route::get('/shortLink/analyticdatarecords/', 'ShortLinkController@analyticdatarecords')->name('shortLink.analyticdatarecords');;
Route::get('/shortLink/getAnalyticdata/','ShortLinkController@getAnalyticdata')->name('shortLink.getAnalyticdata');
