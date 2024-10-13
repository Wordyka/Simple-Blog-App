<?php

use Illuminate\Support\Facades\Route;
Use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'ArticleController@indexHome');

Route::get('/category', 'CategoryController@indexGuest');

Route::get('/article', 'ArticleController@indexGuest');

Route::get('/article/{user_id}', 'ArticleController@indexUser');

Route::get('/article-category/{category_id}', 'ArticleController@indexCategory');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/login', function() {
    return view('auth.login');
})->name('masuk');

Route::get('/register', function() {
    return view('auth.register');
})->name('daftar');

Route::get('/verify', function() {
    return view('auth.verify');
})->name('password.request');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/beranda', function () {
      return view('admin.beranda');
    });

    Route::prefix('author')->group(function () {

        Route::resource('articles', ArticleController::class);

        Route::resource('categories', CategoryController::class);

    });

});