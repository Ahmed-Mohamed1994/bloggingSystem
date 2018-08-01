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



Route::get('/', 'MainController@index')->name('home');
Route::get('/dashboard', 'MainController@dashboard')->name('dashboard');
Route::get('/login', 'MainController@loginPage')->name('login');
Route::get('/logout', 'MainController@logout')->name('logout');
Route::post('/login', 'MainController@login')->name('userLogin');

// user routes
Route::group(['prefix' => 'users'], function () {

    Route::get('/', 'userController@index')->name('listUsers');
    Route::get('/create', 'userController@create')->name('createUser');
    Route::post('/store', 'userController@store')->name('storeUser');

    Route::group(['prefix' => '{user}'], function () {
        Route::get('/edit', 'userController@edit')->name('editUser');
        Route::post('/update', 'userController@update')->name('updateUser');
        Route::get('/delete', 'userController@destroy')->name('deleteUser');
    });

});

// category routes
Route::group(['prefix' => 'categories'], function () {

    Route::get('/', 'CategoryController@index')->name('listCategories');
    Route::get('/create', 'CategoryController@create')->name('createCategory');
    Route::post('/store', 'CategoryController@store')->name('storeCategory');

    Route::group(['prefix' => '{category}'], function () {
        Route::get('/edit', 'CategoryController@edit')->name('editCategory');
        Route::post('/update', 'CategoryController@update')->name('updateCategory');
        Route::get('/delete', 'CategoryController@destroy')->name('deleteCategory');
    });

});