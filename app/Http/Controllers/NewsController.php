<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class NewsController extends Controller
{
    /** @var string レコードが見つからない場合に呼び出されるメッセージ */
    private string $notfound_message = 'レコードが見つかりません';

    /**
     * @OA\Get(
     *     path="/news",
     *     tags={"news"},
     *     summary="ニュースのリストを取得する",
     *     @OA\Response(
     *         response=200,
     *         description="成功した応答",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/News")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $news = News::all();
        return response()->json(
            $news,
            200
        );
    }

    /**
     * @OA\Post(
     *     path="/news",
     *     tags={"news"},
     *     summary="新しいニュースを作成する",
     *     @OA\RequestBody(
     *         required=true,
     *         description="ニュースのデータ",
     *         @OA\JsonContent(ref="#/components/schemas/News")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="リソースが作成されました",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/News")
     *             }
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $news = News::create($request->all());
        return response()->json(
            $news,
            201
        );
    }

    /**
     * @OA\Get(
     *     path="/news/{id}",
     *     tags={"news"},
     *     summary="特定のIDでニュースを取得する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ニュースのID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="成功した応答",
     *         @OA\JsonContent(ref="#/components/schemas/News")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="リソースが見つかりません"
     *     )
     * )
     */
    public function show(string $id)
    {
        $news = News::find($id);

        if (!$news) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        return response()->json(
            $news,
            200
        );
    }

    /**
     * @OA\Put(
     *     path="/news/{id}",
     *     tags={"news"},
     *     summary="特定のIDでニュースを更新する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ニュースのID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="ニュースのデータ",
     *         @OA\JsonContent(ref="#/components/schemas/News")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="リソースが更新されました",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/News")
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
        $news = News::find($id);

        if (!$news) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $news->update($request->all());
        return response()->json(
            $news,
            200
        );
    }

    /**
     * @OA\Delete(
     *     path="/news/{id}",
     *     tags={"news"},
     *     summary="特定のIDでニュースを削除する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ニュースのID",
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
        $news = News::find($id);

        if (!$news) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $news->delete();
        return response()->json(
            null,
            204
        );
    }
}
