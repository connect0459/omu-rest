<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 *  @OA\Schema(
 *      schema="BookInfo",
 *      type="object",
 *      description="BookInfo Model",
 *      @OA\Property(
 *          property="id",
 *          description="ID",
 *          type="integer",
 *          format="int64",
 *          example="1"
 *      ),
 *      @OA\Property(
 *          property="isbn",
 *          description="ISBN-13 or ISBN-10",
 *          type="int",
 *          format="int64",
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
 *          property="author",
 *          description="著者",
 *          type="string",
 *          format="string",
 *          example="noa出版"
 *      ),
 *      @OA\Property(
 *          property="publisher",
 *          description="出版社",
 *          type="string",
 *          format="string",
 *          example="noa出版"
 *      ),
 *      @OA\Property(
 *          property="description",
 *          description="説明",
 *          type="string",
 *          format="string",
 *          example="ハードウェア、ソフトウェア、ネットワーク、セキュリティ、情報モラルまで知っておきたい基礎知識が1冊にわかりやすくまとまっているテキストです。"
 *      ),
 *      @OA\Property(
 *          property="type_genre_id",
 *          description="外部キー制約（types_genresテーブル）",
 *          type="integer",
 *          format="int64",
 *          example="1"
 *      ),
 *      @OA\Property(
 *          property="list_price",
 *          description="定価",
 *          type="integer",
 *          format="int64",
 *          example="1000"
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
class BookInfo extends Model
{
    use HasFactory;

    protected $table = 'books_info';
    protected $primaryKey = 'id';
    protected $fillable = [
        'isbn',
        'title',
        'author',
        'publisher',
        'description',
        'type_genre_id',
        'list_price'
    ];
    protected $dates = ['created_at', 'updated_at'];
}
