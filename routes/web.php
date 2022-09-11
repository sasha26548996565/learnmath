<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/', 'MainController@index')->name('index');

    Route::name('material.')->prefix('material')->group(function () {
        Route::get('/show/{slug}', 'MaterialController@show')->name('show');
        Route::get('/create', 'MaterialController@create')->name('create');
        Route::post('/store', 'MaterialController@store')->name('store');
    });
});

Auth::routes();
