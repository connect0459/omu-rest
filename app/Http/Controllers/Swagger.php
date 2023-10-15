<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="omu-rest",
 *     description="Laravel製RESTful APIサーバー。著者: [connect0459](https://github.com/connect0459)"
 * )
 *
 * サーバー情報
 * @OA\Server(
 *   description="OpenApi host",
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
