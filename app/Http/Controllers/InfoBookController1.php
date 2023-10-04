<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class BookController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      */
//     public function index()
//     {
//         //
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(Request $request)
//     {
//         //
//     }

//     /**
//      * Display the specified resource.
//      */
//     public function show(string $id)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, string $id)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(string $id)
//     {
//         //
//     }
// }

namespace App\Http\Controllers;

use App\Models\InfoBook;
use Illuminate\Http\Request;

class InfoBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = InfoBook::all();
        return response()->json(
            $books, 200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = InfoBook::create($request->all());
        return response()->json(
            $book, 201
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = [
            'title' => $request->title,
            'author' => $request->author
        ];
        $book = InfoBook::where('id', $id)->update($update);
        $books = InfoBook::all();
        if ($book) {
            return response()->json(
                $books
            , 200);
        } else {
            return response()->json([
                'message' => 'InfoBook not found',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = InfoBook::where('id', $id)->delete();
        if ($book) {
            return response()->json([
                'message' => 'InfoBook deleted successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'InfoBook not found',
            ], 404);
        }
    }
}


