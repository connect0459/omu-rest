<?php

namespace App\Http\Controllers;

use App\Models\OrderCustomer;
use Illuminate\Http\Request;

class OrderCustomerController extends Controller
{
    /** @var string The message called when a record is not found  */
    private string $notfound_message = 'The record is not found';

    /**
     * GET
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $orders_customers = OrderCustomer::all();
        return response()->json(
            $orders_customers,
            200
        );
    }

    /**
     * POST
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        $orders_customers = OrderCustomer::create($request->all());
        return response()->json(
            $orders_customers,
            201
        );
    }

    /**
     * GET
     * Display the specified resource.
     */
    
    public function show(string $id)
    {
        $book_info = OrderCustomer::find($id);

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
        $book_info = OrderCustomer::find($id);

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
        $book_info = OrderCustomer::find($id);

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
