<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 *  @OA\Schema(
 *      schema="TypeOrderState",
 *      type="object",
 *      description="TypeOrderState Model",
 *      @OA\Property(
 *          property="id",
 *          description="ID",
 *          type="integer",
 *          format="int64",
 *          example="1"
 *      ),
 *      @OA\Property(
 *          property="type",
 *          description="予約、販売済み、キャンセル、返品などのステータス",
 *          type="string",
 *          format="string",
 *          example="予約"
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
class TypeOrderState extends Model
{
    use HasFactory;

    protected $table = 'types_orders_states';
    protected $primaryKey = 'id';
    protected $fillable = [
        'type'
    ];
    protected $dates = ['created_at', 'updated_at'];
}
