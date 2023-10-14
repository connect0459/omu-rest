<?php

namespace App\Http\Controllers;

use App\Models\BookInfo;
use Illuminate\Http\Request;

class BookInfoController extends Controller
{
    /** @var string The message called when a record is not found  */
    private string $notfound_message = 'The record is not found.';

    /**
     * GET
     * Display a listing of the resource.
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
     * POST
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        var_dump($request->all());
        $books_info = BookInfo::create($request->all());
        return response()->json(
            $books_info,
            201
        );
    }

    /**
     * GET
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book_info = BookInfo::find($id);

        if (!$book_info) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        return response()->json(
            $book_info,
            200
        );
    }

    /**
     * PUT
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book_info = BookInfo::find($id);

        if (!$book_info) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $book_info->update($request->all());
        return response()->json(
            $book_info,
            200
        );
    }

    /**
     * DELETE
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book_info = BookInfo::find($id);

        if (!$book_info) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $book_info->delete();
        return response()->json(
            null,
            204
        );
    }
}
