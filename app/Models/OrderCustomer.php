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
 *          property="branch",
 *          description="支部番号",
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
 *          property="receive_type",
 *          description="受取り方法",
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
 *          property="payment_type",
 *          description="支払い方法",
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
 *          property="is_paid",
 *          description="支払い済みか",
 *          type="boolean",
 *          format="boolean",
 *          example="true"
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
        'branch',
        'numbering',
        'name1',
        'name2',
        'university',
        'grade',
        'belong',
        'email',
        'receive_type',
        'receive_date',
        'payment_type',
        'payment_due_date',
        'is_paid',
        'notes'
    ];
    protected $dates = ['created_at', 'updated_at'];
}
