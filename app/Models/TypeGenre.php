<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 *  @OA\Schema(
 *      schema="TypeGenre",
 *      type="object",
 *      description="TypeGenre Model",
 *      @OA\Property(
 *          property="id",
 *          description="ID",
 *          type="integer",
 *          format="int64",
 *          example="1"
 *      ),
 *      @OA\Property(
 *          property="type",
 *          description="ジャンル名",
 *          type="string",
 *          format="string",
 *          example="○○大学"
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
class TypeGenre extends Model
{
    use HasFactory;

    protected $table = 'types_genres';
    protected $primaryKey = 'id';
    protected $fillable = [
        'type'
    ];
    protected $dates = ['created_at', 'updated_at'];
}
