<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

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


// Tutti i post con response json customizzabile
/*
Route::get('posts', function () {
    $posts = Post::all();
    return response()->json([
        'status_code' => 200,
        'status_text' => 'Success',
        'posts' => $posts,
    ]);
});
*/
// alternativa con risultati non customizzabile
/*
Route::get('posts', function () {
    $posts = Post::all();

    return $posts;
});  
*/

// con paginate
/*
Route::get('posts', function () {
    $posts = Post::paginate();

    return $posts;
});  
*/

Route::get('posts', 'API\PostController@index'); 
Route::get('categories', 'API\CategoryController@index');
Route::get('tags', 'API\TagController@index');