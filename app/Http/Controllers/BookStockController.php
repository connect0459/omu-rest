<?php

namespace App\Http\Controllers;

use App\Models\BookStock;
use Illuminate\Http\Request;

class BookStockController extends Controller
{
    /** @var string The message called when a record is not found  */
    private string $notfound_message = 'The record is not found';

    /**
     * GET
     * Display a listing of the resource.
     */
    /**
     * @SWG\Get(
     *     path="/books_stock",
     *     description="books_stockテーブルからレコードをすべて取得する",
     *     produces={"application/json"},
     *     tags={"books"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Parameter error"
     *     ),
     *     @SWG\Response(
     *         response=403,
     *         description="Auth error",
     *     ),
     * )
     */
    public function index()
    {
        $books_stock = BookStock::all();
        return response()->json(
            $books_stock,
            200
        );
    }

    /**
     * POST
     * Store a newly created resource in storage.
     */
    /**
     * @SWG\POST(
     *     path="/books_stock",
     *     description="books_stockテーブルにレコードを新規に挿入する",
     *     produces={"application/json"},
     *     tags={"books"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Parameter error"
     *     ),
     *     @SWG\Response(
     *         response=403,
     *         description="Auth error",
     *     ),
     * )
     */
    public function store(Request $request)
    {
        $books_stock = BookStock::create($request->all());
        return response()->json(
            $books_stock,
            201
        );
    }

    /**
     * GET
     * Display the specified resource.
     */
    /**
     * @SWG\Get(
     *     path="/books_stock/{books_stock}",
     *     description="books_stockテーブルから指定のIDに一致するレコードを取得する",
     *     produces={"application/json"},
     *     tags={"books"},
     *     @SWG\Parameter(
     *         name="books_stock",
     *         description="books_stockのPRIMARYキー",
     *         in="path",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Parameter error"
     *     ),
     *     @SWG\Response(
     *         response=403,
     *         description="Auth error",
     *     ),
     * )
     */
    public function show(string $id)
    {
        $book_info = BookStock::find($id);

        if (!$book_info) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        return response()->json(
            $book_info,
            200
        );
    }

    /**
     * PUT
     * Update the specified resource in storage.
     */
    /**
     * @SWG\PUT|PATCH(
     *     path="/books_stock/{books_stock}",
     *     description="books_stockテーブルから指定のIDに一致するレコードを更新する",
     *     produces={"application/json"},
     *     tags={"books"},
     *     @SWG\Parameter(
     *         name="books_stock",
     *         description="books_stockのPRIMARYキー",
     *         in="path",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Parameter error"
     *     ),
     *     @SWG\Response(
     *         response=403,
     *         description="Auth error",
     *     ),
     * )
     */
    public function update(Request $request, string $id)
    {
        $book_info = BookStock::find($id);

        if (!$book_info) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $book_info->update($request->all());
        return response()->json(
            $book_info,
            200
        );
    }

    /**
     * DELETE
     * Remove the specified resource from storage.
     */
    /**
     * @SWG\DELETE(
     *     path="/books_stock/{books_stock}",
     *     description="books_stockテーブルから指定のIDに一致するレコードを削除する",
     *     produces={"application/json"},
     *     tags={"books"},
     *     @SWG\Parameter(
     *         name="books_stock",
     *         description="books_stockのPRIMARYキー",
     *         in="path",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Parameter error"
     *     ),
     *     @SWG\Response(
     *         response=403,
     *         description="Auth error",
     *     ),
     * )
     */
    public function destroy(string $id)
    {
        $book_info = BookStock::find($id);

        if (!$book_info) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $book_info->delete();
        return response()->json(
            null,
            204
        );
    }
}
