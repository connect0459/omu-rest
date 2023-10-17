<?php

namespace App\Http\Controllers;

use App\Models\TypeReceive;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class TypeReceiveController extends Controller
{
    /** @var string The message called when a record is not found  */
    private string $notfound_message = 'The record is not found';

    /**
     * @OA\Get(
     *     path="/types_receive",
     *     tags={"types_receive"},
     *     summary="Get a list of types_receive",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/TypeReceive")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $types_receive = TypeReceive::all();
        return response()->json(
            $types_receive,
            200
        );
    }

    /**
     * @OA\Post(
     *     path="/types_receive",
     *     tags={"types_receive"},
     *     summary="Create a new types_receive",
     *     @OA\RequestBody(
     *         required=true,
     *         description="TypeReceive data",
     *         @OA\JsonContent(ref="#/components/schemas/TypeReceive")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Resource created",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/TypeReceive")
     *             }
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $types_receive = TypeReceive::create($request->all());
        return response()->json(
            $types_receive,
            201
        );
    }

    /**
     * @OA\Get(
     *     path="/types_receive/{id}",
     *     tags={"types_receive"},
     *     summary="Get a specific types_receive by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the types_receive",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(ref="#/components/schemas/TypeReceive")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found"
     *     )
     * )
     */
    public function show(string $id)
    {
        $types_receive = TypeReceive::find($id);

        if (!$types_receive) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        return response()->json(
            $types_receive,
            200
        );
    }

    /**
     * @OA\Put(
     *     path="/types_receive/{id}",
     *     tags={"types_receive"},
     *     summary="Update a specific types_receive by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the types_receive",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="TypeReceive data",
     *         @OA\JsonContent(ref="#/components/schemas/TypeReceive")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Resource updated",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/TypeReceive")
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
        $types_receive = TypeReceive::find($id);

        if (!$types_receive) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $types_receive->update($request->all());
        return response()->json(
            $types_receive,
            200
        );
    }

    /**
     * @OA\Delete(
     *     path="/types_receive/{id}",
     *     tags={"types_receive"},
     *     summary="Delete a specific types_receive by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the types_receive",
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
        $types_receive = TypeReceive::find($id);

        if (!$types_receive) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $types_receive->delete();
        return response()->json(
            null,
            204
        );
    }
}
