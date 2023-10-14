<?php

namespace App\Http\Controllers;

use App\Models\BookStock;
use Illuminate\Http\Request;

class BookStockController extends Controller
{
    /** @var string The message called when a record is not found  */
    private string $notfound_message = 'The record is not found.';

    /**
     * GET
     * Display a listing of the resource.
     */
    public function index()
    {
        $books_stock = BookStock::all();
        return response()->json(
            $books_stock,
            200
        );
    }

    /**
     * POST
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $book_stock = BookStock::create($request->all());
        return response()->json(
            $book_stock,
            201
        );
    }

    /**
     * GET
     * Display the specified resource.
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
     * PUT
     * Update the specified resource in storage.
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
     * DELETE
     * Remove the specified resource from storage.
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
