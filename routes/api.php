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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// get all categories
Route::get('/categories', function(Request $request) {
	return Response()->json(App\Category::all(), 200);
});

// get all articles
Route::get('/articles', 'ArticleController@index');

// create (post) an article
Route::post('/articles', 'ArticleController@create');

// read (get) an article
Route::get('/articles/{id}', 'ArticleController@read');

// update (put) an article
Route::put('/articles/{id}', 'ArticleController@update');

// delete an article
Route::delete('/articles/{id}', 'ArticleController@delete');
