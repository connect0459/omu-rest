<?php

namespace App\Http\Controllers;

use App\Models\TypeBranch;
use Illuminate\Http\Request;

class TypeBranchController extends Controller
{
    /** @var string The message called when a record is not found  */
    private string $notfound_message = 'The record is not found';

    /**
     * @OA\Get(
     *     path="/types_branch",
     *     tags={"types_branch"},
     *     summary="Get a list of types_branch",
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
        $types_branch = TypeBranch::all();
        return response()->json(
            $types_branch,
            200
        );
    }

    /**
     * @OA\Post(
     *     path="/types_branch",
     *     tags={"types_branch"},
     *     summary="Create a new types_branch",
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
        $types_branch = TypeBranch::create($request->all());
        return response()->json(
            $types_branch,
            201
        );
    }

    /**
     * @OA\Get(
     *     path="/types_branch/{id}",
     *     tags={"types_branch"},
     *     summary="Get a specific types_branch by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the types_branch",
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
        $types_branch = TypeBranch::find($id);

        if (!$types_branch) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        return response()->json(
            $types_branch,
            200
        );
    }

    /**
     * @OA\Put(
     *     path="/types_branch/{id}",
     *     tags={"types_branch"},
     *     summary="Update a specific types_branch by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the types_branch",
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
        $types_branch = TypeBranch::find($id);

        if (!$types_branch) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $types_branch->update($request->all());
        return response()->json(
            $types_branch,
            200
        );
    }

    /**
     * @OA\Delete(
     *     path="/types_branch/{id}",
     *     tags={"types_branch"},
     *     summary="Delete a specific types_branch by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the types_branch",
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
        $types_branch = TypeBranch::find($id);

        if (!$types_branch) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $types_branch->delete();
        return response()->json(
            null,
            204
        );
    }
}
