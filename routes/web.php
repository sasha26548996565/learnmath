<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/', 'MainController@index')->name('index');
    Route::get('/search', 'SearchController@search')->name('search');

    Route::name('material.')->prefix('material')->group(function () {
        Route::get('/show/{slug}', 'MaterialController@show')->name('show');

        Route::middleware('permission:add-material')->group(function () {
            Route::get('/create', 'MaterialController@create')->name('create');
            Route::post('/store', 'MaterialController@store')->name('store');
        });

        Route::get('/edit/{slug}', 'MaterialController@edit')->name('edit');
        Route::patch('/update/{material}', 'MaterialController@update')->name('update');

        Route::middleware('permission:delete-material')->group(function () {
            Route::delete('/delete/{material}', 'MaterialController@destroy')->name('destroy');
        });
    });

    Route::resource('category', 'CategoryController');
    Route::post('category/{category}/subscription', 'CategoryController@subscription')->name('category.subscription');

    Route::namespace('Author')->prefix('author/{author}')->name('author.')->group(function () {
        Route::get('/', 'IndexController')->name('show');
        Route::get('/subscription/', 'SubscriptionController@subscription')->name('subscription');
    });
});

Auth::routes();
