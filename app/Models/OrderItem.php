<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 *  @OA\Schema(
 *      schema="OrderItem",
 *      type="object",
 *      description="OrderItem Model",
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
 *          property="type_order_state_id",
 *          description="予約の処理状態を表すステータス。types_orders_statesテーブルから取得",
 *          type="integer",
 *          format="int64",
 *          example="1"
 *      ),
 *     @OA\Property(
 *          property="book_info_id",
 *          description="外部キー制約（books_info）",
 *          type="integer",
 *          format="int64",
 *          example="1"
 *      ),
 *     @OA\Property(
 *          property="isbn",
 *          description="ISBN-13 or ISBN-10",
 *          type="string",
 *          format="string",
 *          example="9784908434266"
 *      ),
 *      @OA\Property(
 *          property="title",
 *          description="タイトル",
 *          type="string",
 *          format="string",
 *          example="これだけは知っておこう!情報リテラシー"
 *      ),
 *      @OA\Property(
 *          property="sale_price",
 *          description="販売額",
 *          type="integer",
 *          format="int64",
 *          example="500"
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
class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'orders_items';
    protected $primaryKey = 'id';
    protected $fillable = [
        'numbering',
        'type_order_state_id',
        'isbn',
        'title',
        'sale_price'
    ];
    protected $dates = ['created_at', 'updated_at'];
}
