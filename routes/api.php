<?php

use App\Http\Controllers\BookInfoController;
use App\Http\Controllers\BookStockController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsController;
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
 * `php artisan route:list`コマンドでルーティングを確認可能
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

/*
    GET|HEAD        api/contacts ..................... contacts.index › ContactController@index  
    POST            api/contacts ..................... contacts.store › ContactController@store  
    GET|HEAD        api/contacts/{contact} ............. contacts.show › ContactController@show  
    PUT|PATCH       api/contacts/{contact} ......... contacts.update › ContactController@update  
    DELETE          api/contacts/{contact} ....... contacts.destroy › ContactController@destroy  
*/
Route::apiResource('/contacts', ContactController::class);

/*
    GET|HEAD        api/news ................................................................................. news.index › NewsController@index  
    POST            api/news ................................................................................. news.store › NewsController@store  
    GET|HEAD        api/news/{news} ............................................................................ news.show › NewsController@show  
    PUT|PATCH       api/news/{news} ........................................................................ news.update › NewsController@update  
    DELETE          api/news/{news} ...................................................................... news.destroy › NewsController@destroy  
*/
Route::apiResource('/news', NewsController::class);
