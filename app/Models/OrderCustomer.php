<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 *  @OA\Schema(
 *      schema="OrderCustomer",
 *      type="object",
 *      description="OrderCustomer Model",
 *      @OA\Property(
 *          property="id",
 *          description="ID",
 *          type="integer",
 *          format="int64",
 *          example="1"
 *      ),
 *      @OA\Property(
 *          property="type_branch_id",
 *          description="支部番号（types_branchesテーブルからの外部キー制約）",
 *          type="integer",
 *          format="int64",
 *          example="1"
 *      ),
 *      @OA\Property(
 *          property="numbering",
 *          description="整理番号",
 *          type="string",
 *          format="string",
 *          example="231B001"
 *      ),
 *      @OA\Property(
 *          property="name1",
 *          description="名前",
 *          type="string",
 *          format="string",
 *          example="中岡暉"
 *      ),
 *      @OA\Property(
 *          property="name2",
 *          description="フリガナ or ローマ字",
 *          type="string",
 *          format="string",
 *          example="ナカオカアキラ"
 *      ),
 *      @OA\Property(
 *          property="university",
 *          description="大学",
 *          type="string",
 *          format="string",
 *          example="○○大学"
 *      ),
 *      @OA\Property(
 *          property="grade",
 *          description="学年",
 *          type="string",
 *          format="string",
 *          example="1年"
 *      ),
 *      @OA\Property(
 *          property="belong",
 *          description="学科など",
 *          type="string",
 *          format="string",
 *          example="工学部"
 *      ),
 *      @OA\Property(
 *          property="email",
 *          description="メールアドレス",
 *          type="string",
 *          format="string",
 *          example="example@gmail.com"
 *      ),
 *      @OA\Property(
 *          property="total",
 *          description="請求合計金額",
 *          type="integer",
 *          format="int64",
 *          example="1000"
 *      ),
 *      @OA\Property(
 *          property="type_receive_id",
 *          description="受取り方法分類id（types_receivesテーブルからの外部キー制約）",
 *          type="integer",
 *          format="int64",
 *          example="1"
 *      ),
 *      @OA\Property(
 *          property="receive_date",
 *          description="受取り日時",
 *          type="string",
 *          format="date-time",
 *          example="2023-06-20T21:20:14.000000Z"
 *      ),
 *      @OA\Property(
 *          property="type_payment_id",
 *          description="支払い方法分類id（types_paymentsテーブルからの外部キー制約）",
 *          type="integer",
 *          format="int64",
 *          example="1"
 *      ),
 *      @OA\Property(
 *          property="payment_due_date",
 *          description="支払い期限",
 *          type="string",
 *          format="date-time",
 *          example="2023-06-20T21:20:14.000000Z"
 *      ),
 *      @OA\Property(
 *          property="notes",
 *          description="備考・質問",
 *          type="string",
 *          format="string",
 *          example="受け取り日時は後から変更できますか？"
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
class OrderCustomer extends Model
{
    use HasFactory;

    protected $table = 'orders_customers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'type_branch_id',
        'numbering',
        'name1',
        'name2',
        'university',
        'grade',
        'belong',
        'email',
        'total',
        'type_receive_id',
        'receive_date',
        'type_payment_id',
        'payment_due_date',
        'notes'
    ];
    protected $dates = ['created_at', 'updated_at'];
}
