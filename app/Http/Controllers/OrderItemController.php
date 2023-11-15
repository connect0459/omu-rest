<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class OrderItemController extends Controller
{
    /** @var string レコードが見つからない場合に呼び出されるメッセージ */
    private string $notfound_message = 'レコードが見つかりません';

    /**
     * @OA\Get(
     *     path="/orders_items",
     *     tags={"orders_items"},
     *     summary="注文商品のリストを取得する",
     *     @OA\Response(
     *         response=200,
     *         description="成功した応答",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/OrderItem")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $orders_items = OrderItem::all();
        return response()->json(
            $orders_items,
            200
        );
    }

    /**
     * @OA\Post(
     *     path="/orders_items",
     *     tags={"orders_items"},
     *     summary="新しい注文商品を作成する",
     *     @OA\RequestBody(
     *         required=true,
     *         description="OrderItemのデータ",
     *         @OA\JsonContent(ref="#/components/schemas/OrderItem")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="リソースが作成されました",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/OrderItem")
     *             }
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $orders_items = OrderItem::create($request->all());
        return response()->json(
            $orders_items,
            201
        );
    }

    /**
     * @OA\Get(
     *     path="/orders_items/{id}",
     *     tags={"orders_items"},
     *     summary="特定のIDで注文商品を取得する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="注文商品のID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="成功した応答",
     *         @OA\JsonContent(ref="#/components/schemas/OrderItem")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="リソースが見つかりません"
     *     )
     * )
     */
    public function show(string $id)
    {
        $orders_items = OrderItem::find($id);

        if (!$orders_items) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        return response()->json(
            $orders_items,
            200
        );
    }

    /**
     * @OA\Put(
     *     path="/orders_items/{id}",
     *     tags={"orders_items"},
     *     summary="特定のIDで注文商品を更新する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="注文商品のID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="OrderItemのデータ",
     *         @OA\JsonContent(ref="#/components/schemas/OrderItem")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="リソースが更新されました",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/OrderItem")
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
        $orders_items = OrderItem::find($id);

        if (!$orders_items) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $orders_items->update($request->all());
        return response()->json(
            $orders_items,
            200
        );
    }

    /**
     * @OA\Delete(
     *     path="/orders_items/{id}",
     *     tags={"orders_items"},
     *     summary="特定のIDで注文商品を削除する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="注文商品のID",
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
        $orders_items = OrderItem::find($id);

        if (!$orders_items) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $orders_items->delete();
        return response()->json(
            null,
            204
        );
    }
}
