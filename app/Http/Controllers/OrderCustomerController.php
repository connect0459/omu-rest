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
    /**
     * @SWG\Get(
     *     path="/orders_customers",
     *     description="orders_customersテーブルからレコードをすべて取得する",
     *     produces={"application/json"},
     *     tags={"orders"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Parameter error"
     *     ),
     *     @SWG\Response(
     *         response=403,
     *         description="Auth error",
     *     ),
     * )
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
    /**
     * @SWG\POST(
     *     path="/orders_customers",
     *     description="orders_customersテーブルにレコードを新規に挿入する",
     *     produces={"application/json"},
     *     tags={"orders"},
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Parameter error"
     *     ),
     *     @SWG\Response(
     *         response=403,
     *         description="Auth error",
     *     ),
     * )
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
    /**
     * @SWG\Get(
     *     path="/orders_customers/{orders_customers}",
     *     description="orders_customersテーブルから指定のIDに一致するレコードを取得する",
     *     produces={"application/json"},
     *     tags={"orders"},
     *     @SWG\Parameter(
     *         name="orders_customers",
     *         description="orders_customersのPRIMARYキー",
     *         in="path",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Parameter error"
     *     ),
     *     @SWG\Response(
     *         response=403,
     *         description="Auth error",
     *     ),
     * )
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
    /**
     * @SWG\PUT|PATCH(
     *     path="/orders_customers/{orders_customers}",
     *     description="orders_customersテーブルから指定のIDに一致するレコードを更新する",
     *     produces={"application/json"},
     *     tags={"orders"},
     *     @SWG\Parameter(
     *         name="orders_customers",
     *         description="orders_customersのPRIMARYキー",
     *         in="path",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Parameter error"
     *     ),
     *     @SWG\Response(
     *         response=403,
     *         description="Auth error",
     *     ),
     * )
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
    /**
     * @SWG\DELETE(
     *     path="/orders_customers/{orders_customers}",
     *     description="orders_customersテーブルから指定のIDに一致するレコードを削除する",
     *     produces={"application/json"},
     *     tags={"orders"},
     *     @SWG\Parameter(
     *         name="orders_customers",
     *         description="orders_customersのPRIMARYキー",
     *         in="path",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Parameter error"
     *     ),
     *     @SWG\Response(
     *         response=403,
     *         description="Auth error",
     *     ),
     * )
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
