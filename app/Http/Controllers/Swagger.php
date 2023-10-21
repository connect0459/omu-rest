<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;

/**
 * Swaggerに出力する単一または共通の設定を記述するための空クラス
 * 
 * 基本情報
 * @OA\Info(
 *     version="1.0.0",
 *     title="omu-rest",
 *     description="Laravel製RESTful APIサーバー。著者: [connect0459](https://github.com/connect0459)"
 * )
 *
 * サーバー情報
 * @OA\Server(
 *   description="ローカルホストのAPIエンドポイント",
 *   url="http://localhost:8000/api"
 * )
 * 
 * セキュリティスキーマ
 * @OA\SecurityScheme(
 *   securityScheme="BearerAuth",
 *   type="apiKey",
 *   in="header",
 *   name="api_token"
 * )
 */
class Swagger
{
}
