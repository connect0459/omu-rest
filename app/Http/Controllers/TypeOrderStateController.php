<?php

namespace App\Http\Controllers;

use App\Models\TypeOrderState;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class TypeOrderStateController extends Controller
{
    /** @var string The message called when a record is not found  */
    private string $notfound_message = 'The record is not found';

    /**
     * @OA\Get(
     *     path="/types_orders_states",
     *     tags={"types_orders_states"},
     *     summary="Get a list of types_orders_states",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
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
     *     summary="Create a new types_orders_states",
     *     @OA\RequestBody(
     *         required=true,
     *         description="TypeOrderState data",
     *         @OA\JsonContent(ref="#/components/schemas/TypeOrderState")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Resource created",
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
     *     summary="Get a specific types_orders_states by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the types_orders_states",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(ref="#/components/schemas/TypeOrderState")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found"
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
     *     summary="Update a specific types_orders_states by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the types_orders_states",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="TypeOrderState data",
     *         @OA\JsonContent(ref="#/components/schemas/TypeOrderState")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Resource updated",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/TypeOrderState")
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
     *     summary="Delete a specific types_orders_states by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the types_orders_states",
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
