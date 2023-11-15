<?php

namespace App\Http\Controllers;

use App\Models\TypeGenre;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class TypeGenreController extends Controller
{
    /** @var string レコードが見つからない場合に呼び出されるメッセージ */
    private string $notfound_message = 'レコードが見つかりません';

    /**
     * @OA\Get(
     *     path="/types_genres",
     *     tags={"types_genres"},
     *     summary="書籍のジャンルのリストを取得する",
     *     @OA\Response(
     *         response=200,
     *         description="成功した応答",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/TypeGenre")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $types_genres = TypeGenre::all();
        return response()->json(
            $types_genres,
            200
        );
    }

    /**
     * @OA\Post(
     *     path="/types_genres",
     *     tags={"types_genres"},
     *     summary="新しい書籍のジャンルを作成する",
     *     @OA\RequestBody(
     *         required=true,
     *         description="TypeGenreのデータ",
     *         @OA\JsonContent(ref="#/components/schemas/TypeGenre")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="リソースが作成されました",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/TypeGenre")
     *             }
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $types_genres = TypeGenre::create($request->all());
        return response()->json(
            $types_genres,
            201
        );
    }

    /**
     * @OA\Get(
     *     path="/types_genres/{id}",
     *     tags={"types_genres"},
     *     summary="特定のIDで書籍のジャンルを取得する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="書籍のジャンルのID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="成功した応答",
     *         @OA\JsonContent(ref="#/components/schemas/TypeGenre")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="リソースが見つかりません"
     *     )
     * )
     */
    public function show(string $id)
    {
        $types_genres = TypeGenre::find($id);

        if (!$types_genres) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        return response()->json(
            $types_genres,
            200
        );
    }

    /**
     * @OA\Put(
     *     path="/types_genres/{id}",
     *     tags={"types_genres"},
     *     summary="特定のIDで書籍のジャンルを更新する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="書籍のジャンルのID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="TypeGenreのデータ",
     *         @OA\JsonContent(ref="#/components/schemas/TypeGenre")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="リソースが更新されました",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/TypeGenre")
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
        $types_genres = TypeGenre::find($id);

        if (!$types_genres) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $types_genres->update($request->all());
        return response()->json(
            $types_genres,
            200
        );
    }

    /**
     * @OA\Delete(
     *     path="/types_genres/{id}",
     *     tags={"types_genres"},
     *     summary="特定のIDで書籍のジャンルを削除する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="書籍のジャンルのID",
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
        $types_genres = TypeGenre::find($id);

        if (!$types_genres) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $types_genres->delete();
        return response()->json(
            null,
            204
        );
    }
}
