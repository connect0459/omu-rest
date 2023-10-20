<?php

namespace App\Http\Controllers;

use App\Models\BookStock;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class BookStockController extends Controller
{
    /** @var string The message called when a record is not found  */
    private string $notfound_message = 'The record is not found';

    /**
     * @OA\Get(
     *     path="/books_stocks",
     *     tags={"books_stocks"},
     *     summary="Get a list of books_stocks",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/BookStock")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $books_stocks = BookStock::all();
        return response()->json(
            $books_stocks,
            200
        );
    }

    /**
     * @OA\Post(
     *     path="/books_stocks",
     *     tags={"books_stocks"},
     *     summary="Create a new books_stocks",
     *     @OA\RequestBody(
     *         required=true,
     *         description="BookStock data",
     *         @OA\JsonContent(ref="#/components/schemas/BookStock")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Resource created",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/BookStock"),
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
        $books_stocks = BookStock::create($request->all());
        return response()->json(
            $books_stocks,
            201
        );
    }

    /**
     * @OA\Get(
     *     path="/books_stocks/{id}",
     *     tags={"books_stocks"},
     *     summary="Get a specific books_stocks by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the books_stocks",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(ref="#/components/schemas/BookStock")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found"
     *     )
     * )
     */
    public function show(string $id)
    {
        $book_stock = BookStock::find($id);

        if (!$book_stock) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        return response()->json(
            $book_stock,
            200
        );
    }

    /**
     * @OA\Put(
     *     path="/books_stocks/{id}",
     *     tags={"books_stocks"},
     *     summary="Update a specific books_stocks by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the books_stocks",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="BookStock data",
     *         @OA\JsonContent(ref="#/components/schemas/BookStock")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Resource updated",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/BookStock"),
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
        $book_stock = BookStock::find($id);

        if (!$book_stock) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $book_stock->update($request->all());
        return response()->json(
            $book_stock,
            200
        );
    }

    /**
     * @OA\Delete(
     *     path="/books_stocks/{id}",
     *     tags={"books_stocks"},
     *     summary="Delete a specific books_stocks by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the books_stocks",
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
        $book_stock = BookStock::find($id);

        if (!$book_stock) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $book_stock->delete();
        return response()->json(
            null,
            204
        );
    }
}
