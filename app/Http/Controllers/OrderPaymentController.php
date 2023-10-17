<?php

namespace App\Http\Controllers;

use App\Models\OrderPayment;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class OrderPaymentController extends Controller
{
    /** @var string The message called when a record is not found  */
    private string $notfound_message = 'The record is not found';

    /**
     * @OA\Get(
     *     path="/orders_payments",
     *     tags={"orders_payments"},
     *     summary="Get a list of orders_payments",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
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
     *     summary="Create a new orders_payments",
     *     @OA\RequestBody(
     *         required=true,
     *         description="OrderPayment data",
     *         @OA\JsonContent(ref="#/components/schemas/OrderPayment")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Resource created",
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
     *     summary="Get a specific orders_payments by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the orders_payments",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(ref="#/components/schemas/OrderPayment")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found"
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
     *     summary="Update a specific orders_payments by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the orders_payments",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="OrderPayment data",
     *         @OA\JsonContent(ref="#/components/schemas/OrderPayment")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Resource updated",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/OrderPayment")
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found"
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
     *     summary="Delete a specific orders_payments by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the orders_payments",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Resource deleted"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found"
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
