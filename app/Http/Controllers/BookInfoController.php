<?php

namespace App\Http\Controllers;

use App\Models\BookInfo;
use Illuminate\Http\Request;

class BookInfoController extends Controller
{
    /** @var string The message called when a record is not found  */
    private string $notfound_message = 'The record is not found';

    /**
     * GET
     * Display a listing of the resource.
     */
    /**
     * @SWG\Get(
     *     path="/books_info",
     *     description="books_infoテーブルからレコードをすべて取得する",
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
        $books_info = BookInfo::all();
        return response()->json(
            $books_info,
            200
        );
    }

    /**
     * POST
     * Store a newly created resource in storage.
     */
    /**
     * @SWG\POST(
     *     path="/books_info",
     *     description="books_infoテーブルにレコードを新規に挿入する",
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
        $books_info = BookInfo::create($request->all());
        return response()->json(
            $books_info,
            201
        );
    }

    /**
     * GET
     * Display the specified resource.
     */
    /**
     * @SWG\Get(
     *     path="/books_info/{books_info}",
     *     description="books_infoテーブルから指定のIDに一致するレコードを取得する",
     *     produces={"application/json"},
     *     tags={"books"},
     *     @SWG\Parameter(
     *         name="books_info",
     *         description="books_infoのPRIMARYキー",
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
        $book_info = BookInfo::find($id);

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
     *     path="/books_info/{books_info}",
     *     description="books_infoテーブルから指定のIDに一致するレコードを更新する",
     *     produces={"application/json"},
     *     tags={"books"},
     *     @SWG\Parameter(
     *         name="books_info",
     *         description="books_infoのPRIMARYキー",
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
        $book_info = BookInfo::find($id);

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
     *     path="/books_info/{books_info}",
     *     description="books_infoテーブルから指定のIDに一致するレコードを削除する",
     *     produces={"application/json"},
     *     tags={"books"},
     *     @SWG\Parameter(
     *         name="books_info",
     *         description="books_infoのPRIMARYキー",
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
        $book_info = BookInfo::find($id);

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
