<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class NewsController extends Controller
{
    /** @var string The message called when a record is not found  */
    private string $notfound_message = 'The record is not found';

    /**
     * @OA\Get(
     *     path="/news",
     *     tags={"news"},
     *     summary="Get a list of news",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/News")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $news = News::all();
        return response()->json(
            $news,
            200
        );
    }

    /**
     * @OA\Post(
     *     path="/news",
     *     tags={"news"},
     *     summary="Create a new news",
     *     @OA\RequestBody(
     *         required=true,
     *         description="News data",
     *         @OA\JsonContent(ref="#/components/schemas/News")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Resource created",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/News")
     *             }
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $news = News::create($request->all());
        return response()->json(
            $news,
            201
        );
    }

    /**
     * @OA\Get(
     *     path="/news/{id}",
     *     tags={"news"},
     *     summary="Get a specific news by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the news",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(ref="#/components/schemas/News")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found"
     *     )
     * )
     */
    public function show(string $id)
    {
        $news = News::find($id);

        if (!$news) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        return response()->json(
            $news,
            200
        );
    }

    /**
     * @OA\Put(
     *     path="/news/{id}",
     *     tags={"news"},
     *     summary="Update a specific news by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the news",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="News data",
     *         @OA\JsonContent(ref="#/components/schemas/News")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Resource updated",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/News")
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
        $news = News::find($id);

        if (!$news) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $news->update($request->all());
        return response()->json(
            $news,
            200
        );
    }

    /**
     * @OA\Delete(
     *     path="/news/{id}",
     *     tags={"news"},
     *     summary="Delete a specific news by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the news",
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
        $news = News::find($id);

        if (!$news) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $news->delete();
        return response()->json(
            null,
            204
        );
    }
}
