<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class ContactController extends Controller
{
    /** @var string レコードが見つからない場合に呼び出されるメッセージ */
    private string $notfound_message = 'レコードが見つかりません';

    /**
     * @OA\Get(
     *     path="/contacts",
     *     tags={"contacts"},
     *     summary="連絡先のリストを取得する",
     *     @OA\Response(
     *         response=200,
     *         description="成功した応答",
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
     *     summary="新しい連絡先を作成する",
     *     @OA\RequestBody(
     *         required=true,
     *         description="連絡先のデータ",
     *         @OA\JsonContent(ref="#/components/schemas/Contact")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="リソースが作成されました",
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
     *     summary="特定のIDで連絡先を取得する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="連絡先のID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="成功した応答",
     *         @OA\JsonContent(ref="#/components/schemas/Contact")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="リソースが見つかりません"
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
     *     summary="特定のIDで連絡先を更新する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="連絡先のID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="連絡先のデータ",
     *         @OA\JsonContent(ref="#/components/schemas/Contact")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="リソースが更新されました",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/Contact")
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="リソースが見つかりません"
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
     *     summary="特定のIDで連絡先を削除する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="連絡先のID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="リソースが削除されました"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="リソースが見つかりません"
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
