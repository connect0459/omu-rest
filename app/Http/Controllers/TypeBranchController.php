<?php

namespace App\Http\Controllers;

use App\Models\TypeBranch;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class TypeBranchController extends Controller
{
    /** @var string レコードが見つからない場合に呼び出されるメッセージ */
    private string $notfound_message = 'レコードが見つかりません';

    /**
     * @OA\Get(
     *     path="/types_branches",
     *     tags={"types_branches"},
     *     summary="支部のリストを取得する",
     *     @OA\Response(
     *         response=200,
     *         description="成功した応答",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/TypeBranch")
     *         )
     *     )
     * )
     */
    public function index()
    {
        $types_branches = TypeBranch::all();
        return response()->json(
            $types_branches,
            200
        );
    }

    /**
     * @OA\Post(
     *     path="/types_branches",
     *     tags={"types_branches"},
     *     summary="新しい支部を作成する",
     *     @OA\RequestBody(
     *         required=true,
     *         description="TypeBranchのデータ",
     *         @OA\JsonContent(ref="#/components/schemas/TypeBranch")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="リソースが作成されました",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/TypeBranch")
     *             }
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $types_branches = TypeBranch::create($request->all());
        return response()->json(
            $types_branches,
            201
        );
    }

    /**
     * @OA\Get(
     *     path="/types_branches/{id}",
     *     tags={"types_branches"},
     *     summary="特定のIDで支部を取得する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="支部のID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="成功した応答",
     *         @OA\JsonContent(ref="#/components/schemas/TypeBranch")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="リソースが見つかりません"
     *     )
     * )
     */
    public function show(string $id)
    {
        $types_branches = TypeBranch::find($id);

        if (!$types_branches) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        return response()->json(
            $types_branches,
            200
        );
    }

    /**
     * @OA\Put(
     *     path="/types_branches/{id}",
     *     tags={"types_branches"},
     *     summary="特定のIDで支部を更新する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="支部のID",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="TypeBranchのデータ",
     *         @OA\JsonContent(ref="#/components/schemas/TypeBranch")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="リソースが更新されました",
     *         @OA\JsonContent(
     *             type="object",
     *             allOf={
     *                 @OA\Schema(ref="#/components/schemas/TypeBranch")
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
        $types_branches = TypeBranch::find($id);

        if (!$types_branches) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $types_branches->update($request->all());
        return response()->json(
            $types_branches,
            200
        );
    }

    /**
     * @OA\Delete(
     *     path="/types_branches/{id}",
     *     tags={"types_branches"},
     *     summary="特定のIDで支部を削除する",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="支部のID",
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
        $types_branches = TypeBranch::find($id);

        if (!$types_branches) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $types_branches->delete();
        return response()->json(
            null,
            204
        );
    }
}
