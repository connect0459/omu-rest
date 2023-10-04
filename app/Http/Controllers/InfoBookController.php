<?php

namespace App\Http\Controllers;

use App\Models\InfoBook;
use Illuminate\Http\Request;

class InfoBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = InfoBook::all();
        return response()->json(
            $books,
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * 以下、自作メソッド
     */
    /**
     * Search for books by ISBN or keyword.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        if (empty($query)) {
            return response()->json(['error' => 'Query parameter is required'], 400);
        }

        $books = InfoBook::where('isbn', 'like', '%' . $query . '%')
            ->orWhere('title', 'like', '%' . $query . '%')
            ->orWhere('author', 'like', '%' . $query . '%')
            ->get();

        return response()->json($books, 200);
    }
}
