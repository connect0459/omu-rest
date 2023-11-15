<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class UserController extends Controller
{
    /** @var string The message called when a record is not found  */
    private string $notfound_message = 'User not found';

    /**
     * @OA\Get(
     *     path="/users",
     *     summary="ユーザー一覧取得",
     *     description="ユーザー一覧を取得します。",
     *     tags={"users"},
     *     security={{ "BearerAuth": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="成功した場合のレスポンス",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/User")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * @OA\Post(
     *     path="/users",
     *     summary="ユーザー作成",
     *     description="新しいユーザーを作成します。",
     *     tags={"users"},
     *     security={{ "BearerAuth": {} }},
     *     @OA\RequestBody(
     *         required=true,
     *         description="ユーザー情報",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="成功した場合のレスポンス",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    /**
     * @OA\Get(
     *     path="/users/{id}",
     *     summary="ユーザー詳細取得",
     *     description="指定したユーザーの詳細情報を取得します。",
     *     tags={"users"},
     *     security={{ "BearerAuth": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ユーザーID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="成功した場合のレスポンス",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="該当するユーザーが見つからない場合のレスポンス",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="User not found"
     *             )
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => $this->notfound_message], 404);
        }
        return response()->json($user);
    }

    /**
     * @OA\Put(
     *     path="/users/{id}",
     *     summary="ユーザー更新",
     *     description="指定したユーザーの情報を更新します。",
     *     tags={"users"},
     *     security={{ "BearerAuth": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ユーザーID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="更新するユーザー情報",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="成功した場合のレスポンス",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="該当するユーザーが見つからない場合のレスポンス",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="User not found"
     *             )
     *         )
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $user->update($request->all());
        return response()->json($user);
    }

    /**
     * @OA\Delete(
     *     path="/users/{id}",
     *     summary="ユーザー削除",
     *     description="指定したユーザーを削除します。",
     *     tags={"users"},
     *     security={{ "BearerAuth": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ユーザーID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="成功した場合のレスポンス"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="該当するユーザーが見つからない場合のレスポンス",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="User not found"
     *             )
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $user->delete();
        return response()->json(null, 204);
    }
}
