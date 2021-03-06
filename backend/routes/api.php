<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('articles', 'ArticleController');
Route::post('upload-image', 'ArticleController@uplaodImage');

Route::resource('category', 'CategoryController');
Route::get('category/{id}', 'CategoryController@category');
Route::get('category-menu', 'CategoryController@menu');
Route::resource('company', 'CompanyController');