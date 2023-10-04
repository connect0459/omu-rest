<?php

use App\Http\Controllers\InfoBookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * 以下、追加したコントローラーに対するルーティング設定
 * 使用するクラスを最上部でuse宣言することを忘れずに行う
 */
/**
 *GET|HEAD        api/books ............................................................. books.index › InfoBookController@index  
 *POST            api/books ............................................................. books.store › InfoBookController@store  
 *GET|HEAD        api/books/{book} ........................................................ books.show › InfoBookController@show  
 *PUT|PATCH       api/books/{book} .................................................... books.update › InfoBookController@update  
 *DELETE          api/books/{book} .................................................. books.destroy › InfoBookController@destroy  
 */
Route::apiResource('/books', InfoBookController::class);

