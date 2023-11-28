<?php

namespace App\Http\Controllers;

use App\Models\BookInfo;
use App\Models\BookStock;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class BookController extends Controller
{
    /** @var string The message called when a record is not found  */
    private string $notfound_message = 'The record is not found';

    /**
     * @OA\Get(
     *     path="/books/query/{type_branch_id}",
     *     summary="検索クエリによる支部在庫の表示",
     *     description="ANDおよびOR演算子を使用して書籍を検索します。取得するレコード数を指定も可能。",
     *     tags={"books"},
     *     @OA\Parameter(
     *         name="type_branch_id",
     *         in="path",
     *         description="支部ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="q",
     *         in="query",
     *         description="検索キーワードで構成されるクエリ（ANDおよびOR演算子を使用可能）",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="取得するレコード数",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(
     *                     property="books_info",
     *                     type="object",
     *                     ref="#/components/schemas/BookInfo"
     *                 ),
     *                 @OA\Property(
     *                     property="books_stocks",
     *                     type="object",
     *                     ref="#/components/schemas/BookStock"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="該当する書籍が見つからない場合のレスポンス",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="該当する書籍が見つかりません。"
     *             )
     *         )
     *     ),
     * )
     */
    public function get_by_query(Request $request, $type_branch_id)
    {
        $query_strings = $request->query('q');
        $limit = $request->query('limit');

        $operators = ['AND', 'OR'];
        $parsed_keywords = [];

        // キーワードを半角スペースで分割
        $keywords = preg_split('/\s+/', $query_strings);

        $current_operator = 'AND'; // 初期値は AND

        foreach ($keywords as $kw) {
            if (in_array(strtoupper($kw), $operators)) {
                $current_operator = strtoupper($kw);
            } else {
                $parsed_keywords[] = [
                    'operator' => $current_operator,
                    'keyword' => $kw,
                ];
            }
        }

        // 初期化
        $booksInfo = BookInfo::query();
        $booksStocks = BookStock::where('type_branch_id', $type_branch_id)->get();
        $formatted_data = [];

        // パースされたキーワードを使用して検索条件を構築
        foreach ($parsed_keywords as $parsed_keyword) {
            $operator = $parsed_keyword['operator'];
            $kw = $parsed_keyword['keyword'];

            if ($operator === 'AND') {
                $booksInfo->where(function ($query) use ($kw) {
                    $query->orWhere('isbn', 'like', "%$kw%")
                        ->orWhere('title', 'like', "%$kw%")
                        ->orWhere('author', 'like', "%$kw%")
                        ->orWhere('publisher', 'like', "%$kw%")
                        ->orWhere('genre', 'like', "%$kw%")
                        ->orWhere('description', 'like', "%$kw%");
                });
            } elseif ($operator === 'OR') {
                $booksInfo->orWhere(function ($query) use ($kw) {
                    $query->orWhere('isbn', 'like', "%$kw%")
                        ->orWhere('title', 'like', "%$kw%")
                        ->orWhere('author', 'like', "%$kw%")
                        ->orWhere('publisher', 'like', "%$kw%")
                        ->orWhere('genre', 'like', "%$kw%")
                        ->orWhere('description', 'like', "%$kw%");
                });
            }
        }

        if ($limit) {
            $booksInfo = $booksInfo->take($limit)->get();
        } else {
            $booksInfo = $booksInfo->get();
        }

        foreach ($booksInfo as $info) {
            $infoId = $info->id;
            $matching_stock = $booksStocks->where('book_info_id', $infoId)->first();

            if ($matching_stock !== null) {
                $formatted_data[] = [
                    'books_info' => $info,
                    'books_stocks' => $matching_stock,
                ];
            }
        }

        if (empty($formatted_data)) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        return response()->json($formatted_data);
    }

    /**
     * @OA\Get(
     *     path="/books/column/{type_branch_id}",
     *     summary="カラム指定による支部在庫の表示",
     *     description="指定されたbooks_infoテーブルのカラム名と値を使用して書籍を検索",
     *     tags={"books"},
     *     @OA\Parameter(
     *         name="type_branch_id",
     *         in="path",
     *         description="支部ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="idカラム",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         description="titleカラム",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="author",
     *         in="query",
     *         description="authorカラム",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="publisher",
     *         in="query",
     *         description="publisherカラム",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="genre",
     *         in="query",
     *         description="genreカラム",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="descriptionカラム",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="成功した場合のレスポンス",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(
     *                     property="books_info",
     *                     type="object",
     *                     ref="#/components/schemas/BookInfo"
     *                 ),
     *                 @OA\Property(
     *                     property="books_stocks",
     *                     type="object",
     *                     ref="#/components/schemas/BookStock"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="該当する書籍が見つからない場合のレスポンス",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="該当する書籍が見つかりません。"
     *             )
     *         )
     *     ),
     * )
     */
    public function get_by_column(Request $request, $type_branch_id)
    {
        // クエリパラメータをパースして検索条件を作成
        $conditions = [];
        $columns = array_keys($request->query());
        foreach ($columns as $column) {
            $value = $request->query($column);
            $conditions[] = [$column, 'like', '%' . $value . '%'];
        }

        $booksInfo = BookInfo::where(function ($query) use ($conditions) {
            foreach ($conditions as $condition) {
                $query->orWhere($condition[0], $condition[1], $condition[2]);
            }
        })->get();

        if ($booksInfo->isEmpty()) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        // 書籍の在庫情報を取得 (type_branch_id が一致するレコードを取得)
        $bookStocks = BookStock::where('type_branch_id', $type_branch_id)
            ->whereIn('book_info_id', $booksInfo->pluck('id')->all())
            ->get();

        // 書籍情報と在庫情報を結合
        $formattedData = [];
        foreach ($booksInfo as $info) {
            $matchingStock = $bookStocks->where('book_info_id', $info->id)->first();
            if ($matchingStock !== null) {
                $formattedData[] = [
                    'books_info' => $info,
                    'books_stocks' => $matchingStock,
                ];
            }
        }

        if (empty($formattedData)) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        return response()->json($formattedData);
    }
}
