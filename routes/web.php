<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/', 'MainController@index')->name('index');

    Route::name('material.')->prefix('material')->group(function () {
        Route::get('/show/{slug}', 'MaterialController@show')->name('show');

        Route::middleware('permission:add-material')->group(function () {
            Route::get('/create', 'MaterialController@create')->name('create');
            Route::post('/store', 'MaterialController@store')->name('store');
        });

        Route::get('/edit/{slug}', 'MaterialController@edit')->name('edit');
        Route::patch('/update/{material}', 'MaterialController@update')->name('update');

        Route::middleware('permission:delete-material')->group(function () {
            Route::delete('/delete/{material}', 'MainController@destroy')->name('destroy');
        });
    });
});

Auth::routes();
