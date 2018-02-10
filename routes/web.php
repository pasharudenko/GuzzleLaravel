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

Route::get('/', 'WebScrapingController@index');


Route::post('/StartScraping', 'WebScrapingController@StartScraping');

Route::post('/save', 'WebScrapingController@save');


Route::get('csv', 'WebScrapingController@ExportCsvFile');

Route::get('export','WebScrapingController@Export');