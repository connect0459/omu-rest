<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class ContactController extends Controller
{
    /** @var string The message called when a record is not found  */
    private string $notfound_message = 'The record is not found';

    /**
     * @OA\Get(
     *     path="/contacts",
     *     tags={"contacts"},
     *     summary="Get a list of contacts",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Contact")
     *         )
     *     )
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
     * @OA\Post(
     *     path="/contacts",
     *     tags={"contacts"},
     *     summary="Create a new contact",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Contact data",
     *         @OA\JsonContent(ref="#/components/schemas/Contact")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Resource created",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/Contact")
     *             }
     *         )
     *     )
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
     * @OA\Get(
     *     path="/contacts/{id}",
     *     tags={"contacts"},
     *     summary="Get a specific contact by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the contact",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(ref="#/components/schemas/Contact")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource not found"
     *     )
     * )
     */
    public function show(string $id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        return response()->json(
            $contact,
            200
        );
    }

    /**
     * @OA\Put(
     *     path="/contacts/{id}",
     *     tags={"contacts"},
     *     summary="Update a specific contact by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the contact",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Contact data",
     *         @OA\JsonContent(ref="#/components/schemas/Contact")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Resource updated",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/Contact")
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
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $contact->update($request->all());
        return response()->json(
            $contact,
            200
        );
    }

    /**
     * @OA\Delete(
     *     path="/contacts/{id}",
     *     tags={"contacts"},
     *     summary="Delete a specific contact by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the contact",
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
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $contact->delete();
        return response()->json(
            null,
            204
        );
    }
}
