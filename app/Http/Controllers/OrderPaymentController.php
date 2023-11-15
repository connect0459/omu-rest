<?php

namespace App\Http\Controllers;

use App\Models\OrderPayment;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class OrderPaymentController extends Controller
{
    /** @var string レコードが見つからない場合に呼び出されるメッセージ */
    private string $notfound_message = 'レコードが見つかりません';

    /**
     * @OA\Get(
     *     path="/orders_payments",
     *     tags={"orders_payments"},
     *     summary="注文支払いのリストを取得する",
     *     @OA\Response(
     *         response=200,
     *         description="成功した応答",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/OrderPayment")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $orders_payments = OrderPayment::all();
        return response()->json(
            $orders_payments,
            200
        );
    }

    /**
     * @OA\Post(
     *     path="/orders_payments",
     *     tags={"orders_payments"},
     *     summary="新しい注文支払いを作成する",
     *     @OA\RequestBody(
     *         required=true,
     *         description="OrderPaymentのデータ",
     *         @OA\JsonContent(ref="#/components/schemas/OrderPayment")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="リソースが作成されました",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/OrderPayment")
     *             }
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $orders_payments = OrderPayment::create($request->all());
        return response()->json(
            $orders_payments,
            201
        );
    }

    /**
     * @OA\Get(
     *     path="/orders_payments/{id}",
     *     tags={"orders_payments"},
     *     summary="特定のIDで注文支払いを取得する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="注文支払いのID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="成功した応答",
     *         @OA\JsonContent(ref="#/components/schemas/OrderPayment")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="リソースが見つかりません"
     *     )
     * )
     */
    public function show(string $id)
    {
        $orders_payments = OrderPayment::find($id);

        if (!$orders_payments) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        return response()->json(
            $orders_payments,
            200
        );
    }

    /**
     * @OA\Put(
     *     path="/orders_payments/{id}",
     *     tags={"orders_payments"},
     *     summary="特定のIDで注文支払いを更新する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="注文支払いのID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="OrderPaymentのデータ",
     *         @OA\JsonContent(ref="#/components/schemas/OrderPayment")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="リソースが更新されました",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/OrderPayment")
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
        $orders_payments = OrderPayment::find($id);

        if (!$orders_payments) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $orders_payments->update($request->all());
        return response()->json(
            $orders_payments,
            200
        );
    }

    /**
     * @OA\Delete(
     *     path="/orders_payments/{id}",
     *     tags={"orders_payments"},
     *     summary="特定のIDで注文支払いを削除する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="注文支払いのID",
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
        $orders_payments = OrderPayment::find($id);

        if (!$orders_payments) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $orders_payments->delete();
        return response()->json(
            null,
            204
        );
    }
}
