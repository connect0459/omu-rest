<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     description="User Model",
 *     @OA\Property(
 *         property="id",
 *         description="ユーザーID",
 *         type="integer",
 *         format="int64",
 *         example="1"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         description="ユーザー名",
 *         type="string",
 *         format="string",
 *         example="John Doe"
 *     ),
 *     @OA\Property(
 *         property="auth_scope",
 *         description="認証スコープ",
 *         type="string",
 *         format="string",
 *         example="admin"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         description="メールアドレス",
 *         type="string",
 *         format="email",
 *         example="john.doe@example.com"
 *     ),
 *     @OA\Property(
 *         property="password",
 *         description="パスワード",
 *         type="string",
 *         format="password",
 *         example="password123"
 *     ),
 *     @OA\Property(
 *         property="email_verified_at",
 *         description="メール認証済み日時",
 *         type="string",
 *         format="date-time",
 *         example="2023-06-20T21:20:14.000000Z"
 *     ),
 *     @OA\Property(
 *         property="remember_token",
 *         description="Rememberトークン",
 *         type="string",
 *         format="string",
 *         example="randomtoken123"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         description="レコード作成日",
 *         type="string",
 *         format="date-time",
 *         example="2023-06-20T21:20:14.000000Z"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         description="レコード更新日",
 *         type="string",
 *         format="date-time",
 *         example="2023-06-20T21:20:14.000000Z"
 *     )
 * )
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * 可変属性（Mass Assignable）であるカラム
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'auth_scope',
        'email',
        'password',
    ];

    /**
     * シリアライズ時に非表示にする属性
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * キャストする属性
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
