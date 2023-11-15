<?php

namespace App\Http\Controllers;

use App\Models\OrderCustomer;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class OrderCustomerController extends Controller
{
    /** @var string レコードが見つからない場合に呼び出されるメッセージ */
    private string $notfound_message = 'レコードが見つかりません';

    /**
     * @OA\Get(
     *     path="/orders_customers",
     *     tags={"orders_customers"},
     *     summary="注文顧客のリストを取得する",
     *     @OA\Response(
     *         response=200,
     *         description="成功した応答",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/OrderCustomer")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $orders_customers = OrderCustomer::all();
        return response()->json(
            $orders_customers,
            200
        );
    }

    /**
     * @OA\Post(
     *     path="/orders_customers",
     *     tags={"orders_customers"},
     *     summary="新しい注文顧客を作成する",
     *     @OA\RequestBody(
     *         required=true,
     *         description="OrderCustomerのデータ",
     *         @OA\JsonContent(ref="#/components/schemas/OrderCustomer")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="リソースが作成されました",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/OrderCustomer")
     *             }
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $orders_customers = OrderCustomer::create($request->all());
        return response()->json(
            $orders_customers,
            201
        );
    }

    /**
     * @OA\Get(
     *     path="/orders_customers/{id}",
     *     tags={"orders_customers"},
     *     summary="特定のIDで注文顧客を取得する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="注文顧客のID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="成功した応答",
     *         @OA\JsonContent(ref="#/components/schemas/OrderCustomer")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="リソースが見つかりません"
     *     )
     * )
     */
    public function show(string $id)
    {
        $orders_customers = OrderCustomer::find($id);

        if (!$orders_customers) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        return response()->json(
            $orders_customers,
            200
        );
    }

    /**
     * @OA\Put(
     *     path="/orders_customers/{id}",
     *     tags={"orders_customers"},
     *     summary="特定のIDで注文顧客を更新する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="注文顧客のID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="OrderCustomerのデータ",
     *         @OA\JsonContent(ref="#/components/schemas/OrderCustomer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="リソースが更新されました",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/OrderCustomer")
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
        $orders_customers = OrderCustomer::find($id);

        if (!$orders_customers) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $orders_customers->update($request->all());
        return response()->json(
            $orders_customers,
            200
        );
    }

    /**
     * @OA\Delete(
     *     path="/orders_customers/{id}",
     *     tags={"orders_customers"},
     *     summary="特定のIDで注文顧客を削除する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="注文顧客のID",
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
        $orders_customers = OrderCustomer::find($id);

        if (!$orders_customers) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $orders_customers->delete();
        return response()->json(
            null,
            204
        );
    }
}
