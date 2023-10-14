<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /** @var string The message called when a record is not found  */
    private string $notfound_message = 'The record is not found';

    /**
     * GET
     * Display a listing of the resource.
     */
    /**
     * @SWG\Get(
     *     path="/contacts",
     *     description="contactsテーブルからレコードをすべて取得する",
     *     produces={"application/json"},
     *     tags={"contacts"},
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
        $contacts = Contact::all();
        return response()->json(
            $contacts,
            200
        );
    }

    /**
     * POST
     * Store a newly created resource in storage.
     */
    /**
     * @SWG\POST(
     *     path="/contacts",
     *     description="contactsテーブルにレコードを新規に挿入する",
     *     produces={"application/json"},
     *     tags={"contacts"},
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
        $contacts = Contact::create($request->all());
        return response()->json(
            $contacts,
            201
        );
    }

    /**
     * GET
     * Display the specified resource.
     */
    /**
     * @SWG\Get(
     *     path="/contacts/{contacts}",
     *     description="contactsテーブルから指定のIDに一致するレコードを取得する",
     *     produces={"application/json"},
     *     tags={"contacts"},
     *     @SWG\Parameter(
     *         name="contacts",
     *         description="contactsのPRIMARYキー",
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
        $book_info = Contact::find($id);

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
     *     path="/contacts/{contacts}",
     *     description="contactsテーブルから指定のIDに一致するレコードを更新する",
     *     produces={"application/json"},
     *     tags={"contacts"},
     *     @SWG\Parameter(
     *         name="contacts",
     *         description="contactsのPRIMARYキー",
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
        $book_info = Contact::find($id);

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
     *     path="/contacts/{contacts}",
     *     description="contactsテーブルから指定のIDに一致するレコードを削除する",
     *     produces={"application/json"},
     *     tags={"contacts"},
     *     @SWG\Parameter(
     *         name="contacts",
     *         description="contactsのPRIMARYキー",
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
        $book_info = Contact::find($id);

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
