<?php

namespace App\Http\Controllers;

use App\Models\TypeReceive;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class TypeReceiveController extends Controller
{
    /** @var string レコードが見つからない場合に呼び出されるメッセージ */
    private string $notfound_message = 'レコードが見つかりません';

    /**
     * @OA\Get(
     *     path="/types_receives",
     *     tags={"types_receives"},
     *     summary="受取り方法のリストを取得する",
     *     @OA\Response(
     *         response=200,
     *         description="成功した応答",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/TypeReceive")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $types_receives = TypeReceive::all();
        return response()->json(
            $types_receives,
            200
        );
    }

    /**
     * @OA\Post(
     *     path="/types_receives",
     *     tags={"types_receives"},
     *     summary="新しい受取り方法を作成する",
     *     @OA\RequestBody(
     *         required=true,
     *         description="TypeReceiveのデータ",
     *         @OA\JsonContent(ref="#/components/schemas/TypeReceive")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="リソースが作成されました",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/TypeReceive")
     *             }
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $types_receives = TypeReceive::create($request->all());
        return response()->json(
            $types_receives,
            201
        );
    }

    /**
     * @OA\Get(
     *     path="/types_receives/{id}",
     *     tags={"types_receives"},
     *     summary="特定のIDで受取り方法を取得する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="types_receivesのID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="成功した応答",
     *         @OA\JsonContent(ref="#/components/schemas/TypeReceive")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="リソースが見つかりません"
     *     )
     * )
     */
    public function show(string $id)
    {
        $types_receives = TypeReceive::find($id);

        if (!$types_receives) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        return response()->json(
            $types_receives,
            200
        );
    }

    /**
     * @OA\Put(
     *     path="/types_receives/{id}",
     *     tags={"types_receives"},
     *     summary="特定のIDで受取り方法を更新する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="types_receivesのID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="TypeReceiveのデータ",
     *         @OA\JsonContent(ref="#/components/schemas/TypeReceive")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="リソースが更新されました",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/TypeReceive")
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
        $types_receives = TypeReceive::find($id);

        if (!$types_receives) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $types_receives->update($request->all());
        return response()->json(
            $types_receives,
            200
        );
    }

    /**
     * @OA\Delete(
     *     path="/types_receives/{id}",
     *     tags={"types_receives"},
     *     summary="特定のIDで受取り方法を削除する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="types_receivesのID",
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
        $types_receives = TypeReceive::find($id);

        if (!$types_receives) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $types_receives->delete();
        return response()->json(
            null,
            204
        );
    }
}
