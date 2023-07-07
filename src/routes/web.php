<?php

Route::prefix('admin')
    ->middleware(['web', 'auth', 'role:admin'])
    ->namespace('Piboutique\SimpleCMS\Http\Controllers')
    ->group(function () {
        Route::get('dashboard', [
            'as' => 'dashboard',
            'uses' => 'Backend\DashboardController@index',
        ]);

        Route::resource('pages', 'Backend\PageController', [
            'except' => ['show'],
        ]);

        Route::resource('posts', 'Backend\PostController', [
            'except' => ['show'],
        ]);

        Route::resource('items', 'Backend\PortfolioController', [
            'except' => ['show'],
        ]);

        Route::resource('images', 'Backend\ImageController', [
            'except' => ['show'],
        ]);

        Route::delete('columns/{columnId}/images/{imageId}', 'Backend\DetachImageFromColumnController');

        Route::get('theme-options', [
            'as' => 'theme-options.index',
            'uses' => 'Backend\ThemeOptionsController@index',
        ]);

        Route::get('ajax/theme-options', [
            'as' => 'ajax.theme-options.index',
            'uses' => 'Backend\Ajax\ThemeOptionsController@index',
        ]);

        Route::put('theme-options', [
            'as' => 'theme-options',
            'uses' => 'Backend\ThemeOptionsController@update',
        ]);

        Route::get('styles', [
            'as' => 'styles',
            'uses' => 'Backend\StyleOptionsController@index',
        ]);

        Route::post('styles', [
            'as' => 'styles',
            'uses' => 'Backend\StyleOptionsController@store',
        ]);

        Route::put('styles', [
            'as' => 'styles',
            'uses' => 'Backend\StyleOptionsController@update',
        ]);

        Route::delete('styles', [
            'as' => 'styles',
            'uses' => 'Backend\StyleOptionsController@destroy',
        ]);

        Route::get('variables', [
            'as' => 'variables',
            'uses' => 'Backend\VariableOptionsController@index',
        ]);

        Route::post('variables', [
            'as' => 'variables',
            'uses' => 'Backend\VariableOptionsController@store',
        ]);

        Route::put('variables', [
            'as' => 'variables',
            'uses' => 'Backend\VariableOptionsController@update',
        ]);

        Route::delete('variables', [
            'as' => 'variables',
            'uses' => 'Backend\VariableOptionsController@destroy',
        ]);
    });

