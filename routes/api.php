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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//版本号控制
Route::prefix('v1')->group(function () {
    Route::get('/banner/{id}', 'V1\BannerController@getBanner');
    Route::get('/theme', 'V1\ThemeController@getSimpleList');
    Route::get('/theme/{id}', 'V1\ThemeController@getComplexOne');
    Route::get('/product/recent', 'V1\ProductController@getRecent');
    Route::get('/product/by_category', 'V1\ProductController@getAllByCategoryId');
    Route::get('/category/all', 'V1\CategoryController@getAllCat');
});
