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


Route::get("/getArticles", "ArticleController@show");
Route::get("/getMyArticle", "ArticleController@index");
Route::get("/getArticle", "ArticleController@getArticle");



Route::post("/register", "UserController@register");
Route::post("/login", "UserController@login");
Route::post("/article", "ArticleController@create");
Route::post("/article/update", "ArticleController@update");

Route::delete("articles", "ArticleController@destroy");
Route::delete("comment", "CommentController@destroy");
Route::post("comment", "CommentController@create");

Route::get('contact','ContactController@index');
Route::post('contact','ContactController@store');






