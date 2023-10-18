<?php

namespace App\Http\Controllers;

use App\Models\TypePayment;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class TypePaymentController extends Controller
{
    /** @var string The message called when a record is not found  */
    private string $notfound_message = 'The record is not found';

    /**
     * @OA\Get(
     *     path="/types_payments",
     *     tags={"types_payments"},
     *     summary="Get a list of types_payments",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
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
     *     summary="Create a new types_payments",
     *     @OA\RequestBody(
     *         required=true,
     *         description="TypePayment data",
     *         @OA\JsonContent(ref="#/components/schemas/TypePayment")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Resource created",
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
     *     summary="Get a specific types_payments by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the types_payments",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(ref="#/components/schemas/TypePayment")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found"
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
     *     summary="Update a specific types_payments by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the types_payments",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="TypePayment data",
     *         @OA\JsonContent(ref="#/components/schemas/TypePayment")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Resource updated",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/TypePayment")
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
     *     summary="Delete a specific types_payments by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the types_payments",
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
