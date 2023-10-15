<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

/**
 *  @OA\Schema(
 *      schema="Contact",
 *      type="object",
 *      description="Contact Model",
 *      @OA\Property(
 *          property="id",
 *          description="ID",
 *          type="integer",
 *          format="int64",
 *          example="1"
 *      ),
 *      @OA\Property(
 *          property="unique",
 *          description="お問い合わせ番号として相手に送信する一意な値",
 *          type="string",
 *          format="string",
 *          example="230C001"
 *      ),
 *      @OA\Property(
 *          property="name",
 *          description="名前",
 *          type="string",
 *          format="string",
 *          example="SFT太郎"
 *      ),
 *      @OA\Property(
 *          property="belong",
 *          description="所属",
 *          type="string",
 *          format="string",
 *          example="SFT大学"
 *      ),
 *      @OA\Property(
 *          property="email",
 *          description="メールアドレス",
 *          type="string",
 *          format="string",
 *          example="example@studyfortwo.org"
 *      ),
 *      @OA\Property(
 *          property="summary",
 *          description="概要",
 *          type="string",
 *          format="string",
 *          example="メンバー加入について"
 *      ),
 *      @OA\Property(
 *          property="detail",
 *          description="詳細",
 *          type="string",
 *          format="string",
 *          example="活動に興味があるのですが、この時期からでも入れますか？"
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
class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'unique',
        'name',
        'belong',
        'email',
        'summary',
        'detail'
    ];
    protected $dates = ['created_at', 'updated_at'];
}
