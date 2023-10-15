<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 *  @OA\Schema(
 *      schema="News",
 *      type="object",
 *      description="News Model",
 *      @OA\Property(
 *          property="id",
 *          description="ID",
 *          type="integer",
 *          format="int64",
 *          example="1"
 *      ),
 *      @OA\Property(
 *          property="title",
 *          description="ニュースのタイトル",
 *          type="string",
 *          format="string",
 *          example="サイトの稼働が開始しました。"
 *      ),
 *      @OA\Property(
 *          property="detail",
 *          description="ニュースの記事",
 *          type="string",
 *          format="string",
 *          example="2023年6月20日からサイトを稼働しております。"
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
class News extends Model
{
    use HasFactory;

    protected $table = 'news';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'content'
    ];
    protected $dates = ['created_at', 'updated_at'];
}
