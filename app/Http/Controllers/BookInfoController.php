<?php

namespace App\Http\Controllers;

use App\Models\BookInfo;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class BookInfoController extends Controller
{
    /** @var string レコードが見つからない場合に呼び出されるメッセージ */
    private string $notfound_message = 'レコードが見つかりません';

    /**
     * @OA\Get(
     *      path="/books_info",
     *      tags={"books_info"},
     *      summary="書籍情報のリストを取得する",
     *      @OA\Response(
     *          response=200,
     *          description="成功した応答",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/BookInfo")
     *          )
     *      )
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
     * @OA\Post(
     *     path="/books_info",
     *     tags={"books_info"},
     *     summary="新しい書籍情報を作成する",
     *     @OA\RequestBody(
     *         required=true,
     *         description="BookInfoのデータ",
     *         @OA\JsonContent(ref="#/components/schemas/BookInfo")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="リソースが作成されました",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/BookInfo"),
     *             }
     *         )
     *     )
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
     * @OA\Get(
     *     path="/books_info/{id}",
     *     tags={"books_info"},
     *     summary="特定のIDで書籍情報を取得する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="書籍情報のID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="成功した応答",
     *         @OA\JsonContent(ref="#/components/schemas/BookInfo")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="リソースが見つかりません"
     *     )
     * )
     */
    public function show(string $id)
    {
        $books_info = BookInfo::find($id);

        if (!$books_info) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        return response()->json(
            $books_info,
            200
        );
    }

    /**
     * @OA\Put(
     *     path="/books_info/{id}",
     *     tags={"books_info"},
     *     summary="特定のIDで書籍情報を更新する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="書籍情報のID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="BookInfoのデータ",
     *         @OA\JsonContent(ref="#/components/schemas/BookInfo")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="リソースが更新されました",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/BookInfo"),
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
        $books_info = BookInfo::find($id);

        if (!$books_info) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $books_info->update($request->all());
        return response()->json(
            $books_info,
            200
        );
    }

    /**
     * @OA\Delete(
     *     path="/books_info/{id}",
     *     tags={"books_info"},
     *     summary="特定のIDで書籍情報を削除する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="書籍情報のID",
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
        $books_info = BookInfo::find($id);

        if (!$books_info) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $books_info->delete();
        return response()->json(
            null,
            204
        );
    }
}
