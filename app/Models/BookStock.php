<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 *  @OA\Schema(
 *      schema="BookStock",
 *      type="object",
 *      description="BookStock Model",
 *      @OA\Property(
 *          property="id",
 *          description="ID",
 *          type="integer",
 *          format="int64",
 *          example="1"
 *      ),
 *      @OA\Property(
 *          property="type_branch_id",
 *          description="外部キー制約（types_branchesテーブル）",
 *          type="integer",
 *          format="int64",
 *          example="1"
 *      ),
 *      @OA\Property(
 *          property="book_info_id",
 *          description="外部キー制約（books_infoテーブル）",
 *          type="integer",
 *          format="int64",
 *          example="1"
 *      ),
 *      @OA\Property(
 *          property="stock",
 *          description="未販売の在庫数",
 *          type="integer",
 *          format="int64",
 *          example="4"
 *      ),
 *      @OA\Property(
 *          property="order",
 *          description="未処理の予約数",
 *          type="integer",
 *          format="int64",
 *          example="1"
 *      ),
 *      @OA\Property(
 *          property="sold",
 *          description="販売済みの在庫数",
 *          type="integer",
 *          format="int64",
 *          example="1"
 *      ),
 *      @OA\Property(
 *          property="created_at",
 *          description="レコード作成日",
 *          type="string",
 *          format="date-time",
 *          example="2023-06-20T21:20:14.000000Z"
 *      ),
 *      @OA\Property(
 *          property="updated_at",
 *          description="レコード更新日",
 *          type="string",
 *          format="date-time",
 *          example="2023-06-20T21:20:14.000000Z"
 *      )
 * )
 */
class BookStock extends Model
{
    use HasFactory;

    protected $table = 'books_stocks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'type_branch_id',
        'book_info_id',
        'stock',
        'order',
        'sold'
    ];
    protected $dates = ['created_at', 'updated_at'];
}
