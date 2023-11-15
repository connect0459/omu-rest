<?php

namespace App\Http\Controllers;

use App\Models\TypeOrderState;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class TypeOrderStateController extends Controller
{
    /** @var string レコードが見つからない場合に呼び出されるメッセージ */
    private string $notfound_message = 'レコードが見つかりません';

    /**
     * @OA\Get(
     *     path="/types_orders_states",
     *     tags={"types_orders_states"},
     *     summary="types_orders_statesのリストを取得する",
     *     @OA\Response(
     *         response=200,
     *         description="成功した応答",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/TypeOrderState")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $types_orders_states = TypeOrderState::all();
        return response()->json(
            $types_orders_states,
            200
        );
    }

    /**
     * @OA\Post(
     *     path="/types_orders_states",
     *     tags={"types_orders_states"},
     *     summary="新しいtypes_orders_statesを作成する",
     *     @OA\RequestBody(
     *         required=true,
     *         description="TypeOrderStateのデータ",
     *         @OA\JsonContent(ref="#/components/schemas/TypeOrderState")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="リソースが作成されました",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/TypeOrderState")
     *             }
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $types_orders_states = TypeOrderState::create($request->all());
        return response()->json(
            $types_orders_states,
            201
        );
    }

    /**
     * @OA\Get(
     *     path="/types_orders_states/{id}",
     *     tags={"types_orders_states"},
     *     summary="特定のIDでtypes_orders_statesを取得する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="types_orders_statesのID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="成功した応答",
     *         @OA\JsonContent(ref="#/components/schemas/TypeOrderState")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="リソースが見つかりません"
     *     )
     * )
     */
    public function show(string $id)
    {
        $types_orders_states = TypeOrderState::find($id);

        if (!$types_orders_states) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        return response()->json(
            $types_orders_states,
            200
        );
    }

    /**
     * @OA\Put(
     *     path="/types_orders_states/{id}",
     *     tags={"types_orders_states"},
     *     summary="特定のIDでtypes_orders_statesを更新する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="types_orders_statesのID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="TypeOrderStateのデータ",
     *         @OA\JsonContent(ref="#/components/schemas/TypeOrderState")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="リソースが更新されました",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/TypeOrderState")
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
        $types_orders_states = TypeOrderState::find($id);

        if (!$types_orders_states) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $types_orders_states->update($request->all());
        return response()->json(
            $types_orders_states,
            200
        );
    }

    /**
     * @OA\Delete(
     *     path="/types_orders_states/{id}",
     *     tags={"types_orders_states"},
     *     summary="特定のIDでtypes_orders_statesを削除する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="types_orders_statesのID",
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
        $types_orders_states = TypeOrderState::find($id);

        if (!$types_orders_states) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $types_orders_states->delete();
        return response()->json(
            null,
            204
        );
    }
}
