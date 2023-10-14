<?php

use App\Http\Controllers\BookInfoController;
use App\Http\Controllers\BookStockController;
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
/*
    GET|HEAD        api/books_info ................................................... books_info.index › BookInfoController@index  
    POST            api/books_info ................................................... books_info.store › BookInfoController@store  
    GET|HEAD        api/books_info/{books_info} ........................................ books_info.show › BookInfoController@show  
    PUT|PATCH       api/books_info/{books_info} .................................... books_info.update › BookInfoController@update  
    DELETE          api/books_info/{books_info} .................................. books_info.destroy › BookInfoController@destroy  
*/
Route::apiResource('/books_info', BookInfoController::class);

/*
    GET|HEAD        api/books_stock ................................................ books_stock.index › BookStockController@index  
    POST            api/books_stock ................................................ books_stock.store › BookStockController@store  
    GET|HEAD        api/books_stock/{books_stock} .................................... books_stock.show › BookStockController@show  
    PUT|PATCH       api/books_stock/{books_stock} ................................ books_stock.update › BookStockController@update  
    DELETE          api/books_stock/{books_stock} .............................. books_stock.destroy › BookStockController@destroy  
*/
Route::apiResource('/books_stock', BookStockController::class);
