<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class OrderItemController extends Controller
{
    /** @var string The message called when a record is not found  */
    private string $notfound_message = 'The record is not found';

    /**
     * @OA\Get(
     *     path="/orders_items",
     *     tags={"orders_items"},
     *     summary="Get a list of orders_items",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
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
     *     summary="Create a new orders_items",
     *     @OA\RequestBody(
     *         required=true,
     *         description="OrderItem data",
     *         @OA\JsonContent(ref="#/components/schemas/OrderItem")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Resource created",
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
     *     summary="Get a specific orders_items by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the orders_items",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(ref="#/components/schemas/OrderItem")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found"
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
     *     summary="Update a specific orders_items by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the orders_items",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="OrderItem data",
     *         @OA\JsonContent(ref="#/components/schemas/OrderItem")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Resource updated",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/OrderItem")
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
     *     summary="Delete a specific orders_items by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the orders_items",
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
