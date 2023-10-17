<?php

namespace App\Http\Controllers;

use App\Models\TypeOrderState;
use Illuminate\Http\Request;

class TypeOrderStateController extends Controller
{
    /** @var string The message called when a record is not found  */
    private string $notfound_message = 'The record is not found';

    /**
     * @OA\Get(
     *     path="/types_order_state",
     *     tags={"types_order_state"},
     *     summary="Get a list of types_order_state",
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
        $types_order_state = TypeOrderState::all();
        return response()->json(
            $types_order_state,
            200
        );
    }

    /**
     * @OA\Post(
     *     path="/types_order_state",
     *     tags={"types_order_state"},
     *     summary="Create a new types_order_state",
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
        $types_order_state = TypeOrderState::create($request->all());
        return response()->json(
            $types_order_state,
            201
        );
    }

    /**
     * @OA\Get(
     *     path="/types_order_state/{id}",
     *     tags={"types_order_state"},
     *     summary="Get a specific types_order_state by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the types_order_state",
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
        $types_order_state = TypeOrderState::find($id);

        if (!$types_order_state) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        return response()->json(
            $types_order_state,
            200
        );
    }

    /**
     * @OA\Put(
     *     path="/types_order_state/{id}",
     *     tags={"types_order_state"},
     *     summary="Update a specific types_order_state by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the types_order_state",
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
        $types_order_state = TypeOrderState::find($id);

        if (!$types_order_state) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $types_order_state->update($request->all());
        return response()->json(
            $types_order_state,
            200
        );
    }

    /**
     * @OA\Delete(
     *     path="/types_order_state/{id}",
     *     tags={"types_order_state"},
     *     summary="Delete a specific types_order_state by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the types_order_state",
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
        $types_order_state = TypeOrderState::find($id);

        if (!$types_order_state) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $types_order_state->delete();
        return response()->json(
            null,
            204
        );
    }
}
