<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {

    // Public routes (no authentication required)
    Route::post('register', 'API\UserController@register');
    Route::post('login', 'API\UserController@login');

    // Publicly accessible article and category endpoints
    Route::get('categories', 'API\CategoryAPIController@index');
    Route::get('categories/{category}', 'API\CategoryAPIController@show');
    Route::get('articles', 'API\ArticleAPIController@index');
    Route::get('articles/{article}', 'API\ArticleAPIController@show');

    // Protected routes (require authentication)
    Route::middleware('auth:api', 'admin')->group(function () {
        Route::get('profile', 'API\UserController@profile');
        Route::get('logout', 'API\UserController@logout');

        // Routes for creating, updating, and deleting categories and articles
        Route::post('categories', 'API\CategoryAPIController@store');
        Route::put('categories/{category}', 'API\CategoryAPIController@update');
        Route::delete('categories/{category}', 'API\CategoryAPIController@destroy');

        Route::post('articles', 'API\ArticleAPIController@store');
        Route::put('articles/{article}', 'API\ArticleAPIController@update');
        Route::delete('articles/{article}', 'API\ArticleAPIController@destroy');
    });
});
