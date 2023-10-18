<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 *  @OA\Schema(
 *      schema="OrderPayment",
 *      type="object",
 *      description="OrderPayment Model",
 *      @OA\Property(
 *          property="id",
 *          description="ID",
 *          type="integer",
 *          format="int64",
 *          example="1"
 *      ),
 *      @OA\Property(
 *          property="order_customer_id",
 *          description="外部キー制約（orders_customersテーブル）",
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
 *          property="subtotal",
 *          description="教科書代の小計",
 *          type="integer",
 *          format="int64",
 *          example="1000"
 *      ),
 *      @OA\Property(
 *          property="postage",
 *          description="送料",
 *          type="integer",
 *          format="int64",
 *          example="400"
 *      ),
 *      @OA\Property(
 *          property="fee",
 *          description="手数料",
 *          type="integer",
 *          format="int64",
 *          example="100"
 *      ),
 *      @OA\Property(
 *          property="is_paid",
 *          description="支払い済みか",
 *          type="boolean",
 *          format="boolean",
 *          example="true"
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
class OrderPayment extends Model
{
    use HasFactory;

    protected $table = 'orders_payments';
    protected $primaryKey = 'id';
    protected $fillable = [
        'numbering',
        'subtotal',
        'postage',
        'fee',
        'is_paid'
    ];
    protected $dates = ['created_at', 'updated_at'];
}
