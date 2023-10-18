<?php

namespace App\Http\Controllers;

use App\Models\TypeGenre;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class TypeGenreController extends Controller
{
    /** @var string The message called when a record is not found  */
    private string $notfound_message = 'The record is not found';

    /**
     * @OA\Get(
     *     path="/types_genres",
     *     tags={"types_genres"},
     *     summary="Get a list of types_genres",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/TypeGenre")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $types_genres = TypeGenre::all();
        return response()->json(
            $types_genres,
            200
        );
    }

    /**
     * @OA\Post(
     *     path="/types_genres",
     *     tags={"types_genres"},
     *     summary="Create a new types_genres",
     *     @OA\RequestBody(
     *         required=true,
     *         description="TypeGenre data",
     *         @OA\JsonContent(ref="#/components/schemas/TypeGenre")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Resource created",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/TypeGenre")
     *             }
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $types_genres = TypeGenre::create($request->all());
        return response()->json(
            $types_genres,
            201
        );
    }

    /**
     * @OA\Get(
     *     path="/types_genres/{id}",
     *     tags={"types_genres"},
     *     summary="Get a specific types_genres by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the types_genres",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(ref="#/components/schemas/TypeGenre")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found"
     *     )
     * )
     */
    public function show(string $id)
    {
        $types_genres = TypeGenre::find($id);

        if (!$types_genres) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        return response()->json(
            $types_genres,
            200
        );
    }

    /**
     * @OA\Put(
     *     path="/types_genres/{id}",
     *     tags={"types_genres"},
     *     summary="Update a specific types_genres by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the types_genres",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="TypeGenre data",
     *         @OA\JsonContent(ref="#/components/schemas/TypeGenre")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Resource updated",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/TypeGenre")
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
        $types_genres = TypeGenre::find($id);

        if (!$types_genres) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $types_genres->update($request->all());
        return response()->json(
            $types_genres,
            200
        );
    }

    /**
     * @OA\Delete(
     *     path="/types_genres/{id}",
     *     tags={"types_genres"},
     *     summary="Delete a specific types_genres by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the types_genres",
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
        $types_genres = TypeGenre::find($id);

        if (!$types_genres) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $types_genres->delete();
        return response()->json(
            null,
            204
        );
    }
}
