<?php

namespace App\Http\Controllers;

use App\Models\BookStock;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class BookStockController extends Controller
{
    /** @var string レコードが見つからない場合に呼び出されるメッセージ */
    private string $notfound_message = 'レコードが見つかりません';

    /**
     * @OA\Get(
     *     path="/books_stocks",
     *     tags={"books_stocks"},
     *     summary="書籍在庫のリストを取得する",
     *     @OA\Response(
     *         response=200,
     *         description="成功した応答",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/BookStock")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $books_stocks = BookStock::all();
        return response()->json(
            $books_stocks,
            200
        );
    }

    /**
     * @OA\Post(
     *     path="/books_stocks",
     *     tags={"books_stocks"},
     *     summary="新しい書籍在庫を作成する",
     *     @OA\RequestBody(
     *         required=true,
     *         description="BookStockのデータ",
     *         @OA\JsonContent(ref="#/components/schemas/BookStock")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="リソースが作成されました",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/BookStock"),
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         format="date-time"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         format="date-time"
     *                     )
     *                 )
     *             }
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $books_stocks = BookStock::create($request->all());
        return response()->json(
            $books_stocks,
            201
        );
    }

    /**
     * @OA\Get(
     *     path="/books_stocks/{id}",
     *     tags={"books_stocks"},
     *     summary="特定のIDで書籍在庫を取得する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="書籍在庫のID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="成功した応答",
     *         @OA\JsonContent(ref="#/components/schemas/BookStock")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="リソースが見つかりません"
     *     )
     * )
     */
    public function show(string $id)
    {
        $book_stock = BookStock::find($id);

        if (!$book_stock) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        return response()->json(
            $book_stock,
            200
        );
    }

    /**
     * @OA\Put(
     *     path="/books_stocks/{id}",
     *     tags={"books_stocks"},
     *     summary="特定のIDで書籍在庫を更新する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="書籍在庫のID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="BookStockのデータ",
     *         @OA\JsonContent(ref="#/components/schemas/BookStock")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="リソースが更新されました",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/BookStock"),
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         format="date-time"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         format="date-time"
     *                     )
     *                 )
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="リソースが見つかりません"
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        $book_stock = BookStock::find($id);

        if (!$book_stock) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $book_stock->update($request->all());
        return response()->json(
            $book_stock,
            200
        );
    }

    /**
     * @OA\Delete(
     *     path="/books_stocks/{id}",
     *     tags={"books_stocks"},
     *     summary="特定のIDで書籍在庫を削除する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="書籍在庫のID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="リソースが削除されました"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="リソースが見つかりません"
     *     )
     * )
     */
    public function destroy(string $id)
    {
        $book_stock = BookStock::find($id);

        if (!$book_stock) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $book_stock->delete();
        return response()->json(
            null,
            204
        );
    }
}
