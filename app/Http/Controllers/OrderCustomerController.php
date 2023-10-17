<?php

namespace App\Http\Controllers;

use App\Models\OrderCustomer;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class OrderCustomerController extends Controller
{
    /** @var string The message called when a record is not found  */
    private string $notfound_message = 'The record is not found';

    /**
     * @OA\Get(
     *     path="/orders_customers",
     *     tags={"orders_customers"},
     *     summary="Get a list of orders_customers",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
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
     *     summary="Create a new orders_customers",
     *     @OA\RequestBody(
     *         required=true,
     *         description="OrderCustomer data",
     *         @OA\JsonContent(ref="#/components/schemas/OrderCustomer")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Resource created",
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
     *     summary="Get a specific orders_customers by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the orders_customers",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(ref="#/components/schemas/OrderCustomer")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found"
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
     *     summary="Update a specific orders_customers by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the orders_customers",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="OrderCustomer data",
     *         @OA\JsonContent(ref="#/components/schemas/OrderCustomer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Resource updated",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/OrderCustomer")
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
     *     summary="Delete a specific orders_customers by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the orders_customers",
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
