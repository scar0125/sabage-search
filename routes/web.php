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

//トップページ
Route::get('/', 'PostController@index');

//検索結果
Route::get('/result', 'PostController@search');

//投稿詳細画面
Route::get('/posts/{post}', 'PostController@show');

//レビュー
Route::post('/posts/{post}/review', 'ReviewController@store');
Route::delete('/posts/{post}/review', 'ReviewController@delete')->name('review.delete');

//お気に入り
Route::get('/posts/{id}/favorite', 'PostController@favorite')->name('post.favorite');
Route::get('/posts/{id}/not-favorite', 'PostController@notFavorite')->name('post.not-favorite');

//投稿管理(管理者ログイン必須)
Route::get('/create', 'PostController@create')->middleware('auth:admin');
Route::get('/posts/{post}/edit', 'PostController@edit')->middleware('auth:admin');
Route::put('/posts/{post}', 'PostController@update')->middleware('auth:admin');
Route::delete('/posts/{post}', 'PostController@delete')->middleware('auth:admin');
Route::post('/', 'PostController@store')->middleware('auth:admin');


//ログイン
Auth::routes(['verify' => true]);
Route::middleware('verified')->group(function() {
    //メール認証が完了した場合のみ、実行できるRoute
    Route::get('/home', 'HomeController@index')->name('home');
});


//グーグルログイン
Route::get('login/google', 'Auth\LoginController@redirectToGoogle');
Route::get('login/google/callback', 'Auth\LoginController@handleGoogleCallback');

//管理者ログイン
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
//Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm'); //管理者登録画面非表示
Route::post('/login/admin', 'Auth\LoginController@adminLogin');
//Route::post('/register/admin', 'Auth\RegisterController@createAdmin')->name('admin-register');
Route::view('/admin', 'admin')->middleware('auth:admin')->name('admin-home');


//管理者ログインパスワードのリセット
Route::get('password/admin/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('password/admin/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('password/admin/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('password/admin/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');
