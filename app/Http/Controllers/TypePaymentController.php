<?php

namespace App\Http\Controllers;

use App\Models\TypePayment;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class TypePaymentController extends Controller
{
    /** @var string レコードが見つからない場合に呼び出されるメッセージ */
    private string $notfound_message = 'レコードが見つかりません';

    /**
     * @OA\Get(
     *     path="/types_payments",
     *     tags={"types_payments"},
     *     summary="支払い方法のリストを取得する",
     *     @OA\Response(
     *         response=200,
     *         description="成功した応答",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/TypePayment")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $types_payments = TypePayment::all();
        return response()->json(
            $types_payments,
            200
        );
    }

    /**
     * @OA\Post(
     *     path="/types_payments",
     *     tags={"types_payments"},
     *     summary="新しい支払い方法を作成する",
     *     @OA\RequestBody(
     *         required=true,
     *         description="TypePaymentのデータ",
     *         @OA\JsonContent(ref="#/components/schemas/TypePayment")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="リソースが作成されました",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/TypePayment")
     *             }
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $types_payments = TypePayment::create($request->all());
        return response()->json(
            $types_payments,
            201
        );
    }

    /**
     * @OA\Get(
     *     path="/types_payments/{id}",
     *     tags={"types_payments"},
     *     summary="特定のIDで支払い方法を取得する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="types_paymentsのID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="成功した応答",
     *         @OA\JsonContent(ref="#/components/schemas/TypePayment")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="リソースが見つかりません"
     *     )
     * )
     */
    public function show(string $id)
    {
        $types_payments = TypePayment::find($id);

        if (!$types_payments) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        return response()->json(
            $types_payments,
            200
        );
    }

    /**
     * @OA\Put(
     *     path="/types_payments/{id}",
     *     tags={"types_payments"},
     *     summary="特定のIDで支払い方法を更新する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="types_paymentsのID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="TypePaymentのデータ",
     *         @OA\JsonContent(ref="#/components/schemas/TypePayment")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="リソースが更新されました",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/TypePayment")
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
        $types_payments = TypePayment::find($id);

        if (!$types_payments) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $types_payments->update($request->all());
        return response()->json(
            $types_payments,
            200
        );
    }

    /**
     * @OA\Delete(
     *     path="/types_payments/{id}",
     *     tags={"types_payments"},
     *     summary="特定のIDで支払い方法を削除する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="types_paymentsのID",
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
        $types_payments = TypePayment::find($id);

        if (!$types_payments) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $types_payments->delete();
        return response()->json(
            null,
            204
        );
    }
}
