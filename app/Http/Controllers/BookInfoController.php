<?php

namespace App\Http\Controllers;

use App\Models\BookInfo;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class BookInfoController extends Controller
{
    /** @var string The message called when a record is not found  */
    private string $notfound_message = 'The record is not found';

    /**
     * @OA\Get(
     *      path="/api/books_info",
     *      tags={"books_info"},
     *      summary="Get a list of books_info",
     *      @OA\Response(
     *          response=200,
     *          description="Successful response",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/BookInfo")
     *          )
     *      )
     * )
     */
    public function index()
    {
        $books_info = BookInfo::all();
        return response()->json(
            $books_info,
            200
        );
    }

    /**
     * @OA\Post(
     *     path="/api/books_info",
     *     tags={"books_info"},
     *     summary="Create a new books_info",
     *     @OA\RequestBody(
     *         required=true,
     *         description="BookInfo data",
     *         @OA\JsonContent(ref="#/components/schemas/BookInfo")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Resource created",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/BookInfo"),
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         format="date-time"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         format="date-time"
     *                     )
     *                 )
     *             }
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $books_info = BookInfo::create($request->all());
        return response()->json(
            $books_info,
            201
        );
    }

    /**
     * @OA\Get(
     *     path="/api/books_info/{id}",
     *     tags={"books_info"},
     *     summary="Get a specific books_info by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the books_info",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(ref="#/components/schemas/BookInfo")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found"
     *     )
     * )
     */
    public function show(string $id)
    {
        $books_info = BookInfo::find($id);

        if (!$books_info) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        return response()->json(
            $books_info,
            200
        );
    }

    /**
     * @OA\Put(
     *     path="/api/books_info/{id}",
     *     tags={"books_info"},
     *     summary="Update a specific books_info by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the books_info",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="BookInfo data",
     *         @OA\JsonContent(ref="#/components/schemas/BookInfo")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Resource updated",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/BookInfo"),
     *                 @OA\Schema(
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         format="date-time"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         format="date-time"
     *                     )
     *                 )
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
        $books_info = BookInfo::find($id);

        if (!$books_info) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $books_info->update($request->all());
        return response()->json(
            $books_info,
            200
        );
    }

    /**
     * @OA\Delete(
     *     path="/api/books_info/{id}",
     *     tags={"books_info"},
     *     summary="Delete a specific books_info by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the books_info",
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
        $books_info = BookInfo::find($id);

        if (!$books_info) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $books_info->delete();
        return response()->json(
            null,
            204
        );
    }
}
