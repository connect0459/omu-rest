<?php

namespace App\Http\Controllers;

use App\Models\TypeBranch;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class TypeBranchController extends Controller
{
    /** @var string The message called when a record is not found  */
    private string $notfound_message = 'The record is not found';

    /**
     * @OA\Get(
     *     path="/types_branches",
     *     tags={"types_branches"},
     *     summary="Get a list of types_branches",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/TypeBranch")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $types_branches = TypeBranch::all();
        return response()->json(
            $types_branches,
            200
        );
    }

    /**
     * @OA\Post(
     *     path="/types_branches",
     *     tags={"types_branches"},
     *     summary="Create a new types_branches",
     *     @OA\RequestBody(
     *         required=true,
     *         description="TypeBranch data",
     *         @OA\JsonContent(ref="#/components/schemas/TypeBranch")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Resource created",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/TypeBranch")
     *             }
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $types_branches = TypeBranch::create($request->all());
        return response()->json(
            $types_branches,
            201
        );
    }

    /**
     * @OA\Get(
     *     path="/types_branches/{id}",
     *     tags={"types_branches"},
     *     summary="Get a specific types_branches by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the types_branches",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(ref="#/components/schemas/TypeBranch")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found"
     *     )
     * )
     */
    public function show(string $id)
    {
        $types_branches = TypeBranch::find($id);

        if (!$types_branches) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        return response()->json(
            $types_branches,
            200
        );
    }

    /**
     * @OA\Put(
     *     path="/types_branches/{id}",
     *     tags={"types_branches"},
     *     summary="Update a specific types_branches by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the types_branches",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="TypeBranch data",
     *         @OA\JsonContent(ref="#/components/schemas/TypeBranch")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Resource updated",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/TypeBranch")
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
        $types_branches = TypeBranch::find($id);

        if (!$types_branches) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $types_branches->update($request->all());
        return response()->json(
            $types_branches,
            200
        );
    }

    /**
     * @OA\Delete(
     *     path="/types_branches/{id}",
     *     tags={"types_branches"},
     *     summary="Delete a specific types_branches by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the types_branches",
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
        $types_branches = TypeBranch::find($id);

        if (!$types_branches) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $types_branches->delete();
        return response()->json(
            null,
            204
        );
    }
}
