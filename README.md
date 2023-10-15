# omu-rest

Laravel で構築された RESTful API サーバーです。PHP・Composer・MySQL はインストール済みであることを前提としています。phpMyAdmin があればデータ管理が楽なので併せてセッティングしましょう。

## ローカル環境へのインストール

コマンド実行においては、特段断りがない限り、プロジェクトのルートディレクトリで実行するものとします。

### 1. Git からプロジェクトをクローン

```bash
git clone https://github.com/connect0459/omu-rest.git
cd 'path/to/omu-rest'
```

### 2. Composer を使用して依存関係をインストール

```bash
composer install
```

### 3. `.env` ファイルを作成

プロジェクトフォルダ内に `.env` ファイルを作成し、必要な設定を記述します。以下は `.env` ファイルの例です。データベースの作成とユーザー権限の付与は phpMyAdmin などで行ってください。

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

## API エンドポイント（URI）の追加

### Model・Migration・Controller の作成

Migration（マイグレーション）ファイルとは、コマンドラインからデータベースの作成を行う際に参照される定義ファイルです。作成する Model の名前を`ModelName`とすると、次のコマンドで Model、Migration、Controller ファイルを一括で作成できます。

```bash
php artisan make:model ModelName --migration --controller --api
```

Controller を個別に作成する場合は以下のようにし、`--api`オプションを付けましょう。

```bash
php artisan make:controller ModelNameController --api
```

生成されたファイルにはデフォルトでいくつかコードが書かれていますが、求める仕様を実現するコードを追記しましょう。例として、`books_info`テーブルに関するエンドポイントを作成するためのコードを示します。

-   Migration（database/）

```php:database/migrations2023_10_14_082639_create_books_info_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books_info', function (Blueprint $table) {
            $table->id();
            $table->string('isbn', 13);
            $table->string('title', 255);
            $table->string('author', 255)->nullable();
            $table->string('publisher', 255)->nullable();
            $table->string('genre', 255)->nullable();
            $table->text('description')->nullable();
            $table->integer('list_price');
            $table->integer('sale_price');
            $table->datetime('created_at')->useCurrent();
            $table->datetime('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books_info');
    }
};
```

-   Model（app/Models/）

```php:app/Models/BookInfo.php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'genre',
        'description',
        'list_price',
        'sale_price'
    ];
    protected $dates = ['created_at', 'updated_at'];
}
```

-   Controller（app/Http/Controllers/）

```php:app/Http/Controllers/BookInfoController.php
<?php

namespace App\Http\Controllers;

use App\Models\BookInfo;
use Illuminate\Http\Request;

class BookInfoController extends Controller
{
    /** @var string The message called when a record is not found  */
    private string $notfound_message = 'The record is not found.';

    /**
     * GET
     * Display a listing of the resource.
     */
    public function index()
    {
        $books_info = BookInfo::all();
        return response()->json(
            $books_info,
            200
        );
    }

    /**
     * POST
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        var_dump($request->all());
        $books_info = BookInfo::create($request->all());
        return response()->json(
            $books_info,
            201
        );
    }

    /**
     * GET
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book_info = BookInfo::find($id);

        if (!$book_info) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        return response()->json(
            $book_info,
            200
        );
    }

    /**
     * PUT
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book_info = BookInfo::find($id);

        if (!$book_info) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $book_info->update($request->all());
        return response()->json(
            $book_info,
            200
        );
    }

    /**
     * DELETE
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book_info = BookInfo::find($id);

        if (!$book_info) {
            return response()->json(['message' => $this->notfound_message], 404);
        }

        $book_info->delete();
        return response()->json(
            null,
            204
        );
    }
}
```

### Migration と Route 設定

作成した Migration ファイルからデータベースへのマイグレーションを行います。以下のコマンドを実行してください。

```bash
php artisan migrate
```

次に、ルーティング設定の確認です。`routes/api.php`にコントローラーファイルと URI の結び付けを記述してエンドポイントを作成します。

```php:routes/api.php
<?php

use App\Http\Controllers\BookInfoController;
use App\Http\Controllers\BookStockController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * 以下、追加したコントローラーに対するルーティング設定
 * 使用するクラスを最上部でuse宣言することを忘れずに行う
 */
Route::apiResource('/books_info', BookInfoController::class);
```

記述後、次のコマンドでルーティングが適切に設定されているか確認します。

```bash
php artisan route:list
```

以下のような出力が出たら結びつけが成功しています。

```
GET|HEAD        / .........................................................................................................
  POST            _ignition/execute-solution .. ignition.executeSolution › Spatie\LaravelIgnition › ExecuteSolutionController
  GET|HEAD        _ignition/health-check .............. ignition.healthCheck › Spatie\LaravelIgnition › HealthCheckController
  POST            _ignition/update-config ........... ignition.updateConfig › Spatie\LaravelIgnition › UpdateConfigController
  GET|HEAD        api/books_info ................................................ books_info.index › BookInfoController@index
  POST            api/books_info ................................................ books_info.store › BookInfoController@store
  GET|HEAD        api/books_info/{books_info} ..................................... books_info.show › BookInfoController@show
  PUT|PATCH       api/books_info/{books_info} ................................. books_info.update › BookInfoController@update
  DELETE          api/books_info/{books_info} ............................... books_info.destroy › BookInfoController@destroy
```

設定が確認出来たら、`curl`コマンドでエンドポイントが機能するか確認しましょう。

### curl でサーバーにリクエストを送信

#### 1. ローカルサーバーの起動

次のコマンドを実行して、Laravel の開発サーバーを立ち上げましょう。デフォルトのポートは`8000`です。

```bash
php artisan serve
```

#### 2. ダミーデータの挿入（CREATE）

CRUD 操作のうち CREATE（POST）には`store`メソッドが対応します。ここでは「独学 PHP 第 4 版」と「はじめての PHP5 プログラミング 基本編」をダミーデータとして扱います。store メソッドは一つの JSON の送信にしか対応していないので、複数のデータ登録はエンドポイントを複数回叩くか SQL でまとめて Insert しましょう。

-   独学 PHP 第 4 版

```bash:POST
curl -X POST -H "Content-Type: application/json" -d "{\"id\":1,\"isbn\":\"9784798168494\",\"title\":\"独学PHP 第4版\",\"author\":\"山田 祥寛\",\"publisher\":\"翔泳社\",\"genre\":\"情報学\",\"description\":\"\",\"list_price\":2700,\"sale_price\":1350,\"created_at\":\"2023-09-12T23:37:39.000000Z\",\"updated_at\":\"2023-09-12T23:37:39.000000Z\"}" http://localhost:8000/api/books_info
```

-   はじめての PHP5 プログラミング 基本編

```bash
curl -X POST -H "Content-Type: application/json" -d "{\"id\":2,\"isbn\":\"9784798009063\",\"title\":\"はじめてのPHP5プログラミング 基本編\",\"author\":\"豊崎 直也\",\"publisher\":\"秀和システム\",\"genre\":\"情報学\",\"description\":\"\",\"list_price\":2200,\"sale_price\":1100,\"created_at\":\"2023-09-12T23:37:39.000000Z\",\"updated_at\":\"2023-09-12T23:37:39.000000Z\"}" http://localhost:8000/api/books_info
```

#### 3. SQL に登録されたデータを確認（READ）

READ（GET）には全取得の`index`メソッドと部分取得の`show`メソッドが対応します。次のコマンドを実行して、登録されたデータを確認しましょう。

```bash:GET
curl http://localhost:8000/api/books_info
```

以下のような Unicode 文字で結果が返ってきます。Unicode 文字をデコードすれば、日本語に変換できます。

```bash:return
[{"id":1,"isbn":"9784798168494","title":"\u72ec\u5b66PHP \u7b2c4\u7248","author":"\u5c71\u7530 \u7965\u5bdb","publisher":"\u7fd4\u6cf3\u793e","genre":"\u60c5\u5831\u5b66","description":null,"list_price":2700,"sale_price":1350,"created_at":"2023-10-14T14:21:56.000000Z","updated_at":"2023-10-14T23:24:35.000000Z"},{"id":2,"isbn":"9784798009063","title":"\u306f\u3058\u3081\u3066\u306ePHP5\u30d7\u30ed\u30b0\u30e9\u30df\u30f3\u30b0 \u57fa\u672c\u7de8","author":"\u8c4a\u5d0e \u76f4\u4e5f","publisher":"\u79c0\u548c\u30b7\u30b9\u30c6\u30e0","genre":"\u60c5\u5831\u5b66","description":null,"list_price":2200,"sale_price":1100,"created_at":"2023-10-14T14:24:19.000000Z","updated_at":"2023-10-14T23:24:37.000000Z"}]
```

特定のレコードを取得したい場合は、次のように`id`を指定します。

```bash:GET
curl http://localhost:8000/api/books_info/1
```

結果

```bash:return
{"id":1,"isbn":"9784798168494","title":"\u72ec\u5b66PHP \u7b2c4\u7248","author":"\u5c71\u7530 \u7965\u5bdb","publisher":"\u7fd4\u6cf3\u793e","genre":"\u60c5\u5831\u5b66","description":null,"list_price":2700,"sale_price":1350,"created_at":"2023-10-14T14:21:56.000000Z","updated_at":"2023-10-14T23:24:35.000000Z"}
```

#### 4. SQL のレコードを更新（UPDATE）

UPDATE（PUT|PATCH）には`update`メソッドが対応します。次のコマンドを実行して、「独習 PHP 第 4 版」の販売額を 1350 円から 1300 円に変更します。

```bash:PUT
curl -X PUT -H "Content-Type: application/json" -d "{\"sale_price\": \"1300\"}" http://localhost:8000/api/books_info/1
```

結果を見ると、`sale_price`が`1300`になっていることが確認できます。

```bash:return
{"id":1,"isbn":"9784798168494","title":"\u72ec\u5b66PHP \u7b2c4\u7248","author":"\u5c71\u7530 \u7965\u5bdb","publisher":"\u7fd4\u6cf3\u793e","genre":"\u60c5\u5831\u5b66","description":null,"list_price":2700,"sale_price":"1300","created_at":"2023-10-14T14:21:56.000000Z","updated_at":"2023-10-14T14:47:46.000000Z"}
```

#### 5. SQL のレコードを削除（DELETE）

DELETE には`destroy`メソッドが対応します。

```bash:DELETE
curl -X DELETE http://localhost:8000/api/books_info/1
```

実行後、レコードを`index`メソッドで取得すると`id:1`のレコードが削除されているのがわかります。

```bash:return
[{"id":2,"isbn":"9784798009063","title":"\u306f\u3058\u3081\u3066\u306ePHP5\u30d7\u30ed\u30b0\u30e9\u30df\u30f3\u30b0 \u57fa\u672c\u7de8","author":"\u8c4a\u5d0e \u76f4\u4e5f","publisher":"\u79c0\u548c\u30b7\u30b9\u30c6\u30e0","genre":"\u60c5\u5831\u5b66","description":null,"list_price":2200,"sale_price":1100,"created_at":"2023-10-14T14:24:19.000000Z","updated_at":"2023-10-14T23:24:37.000000Z"}]
```

## API 仕様書の生成

### l5-swagger のインストール

次のコマンドで`l5-swagger`をインストールします。

```
composer require "darkaonline/l5-swagger" --dev
```

### Controller 共通スキーマの定義

`app/Http/Controller/`に`Swagger.php`を作成し、共通の設定を記述しましょう。

```php:Swagger.php
<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="omu-rest",
 *     description="Laravel製RESTful APIサーバー"
 *
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
 *
 * 作成日
 * @OA\Schema(
 *   schema="created_at",
 *   description="Created At",
 *   type="string",
 *   format="date-time",
 *   example="2017-07-21T17:32:28Z"
 * )
 */
class Swagger
{
}
```

Model を Schema として登録します。以下の例だと、`@OA\Schema(ref="#/components/schemas/BookInfo")`で Schema が読み込めるようになります。

```php:BookInfo.php
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
 *      ...
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
        'genre',
        'description',
        'list_price',
        'sale_price'
    ];
    protected $dates = ['created_at', 'updated_at'];
}
```

そして、Controller ファイルにメソッドの説明を記述します。

```php:BookInfoController.php
<?php

namespace App\Http\Controllers;

use App\Models\BookInfo;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class BookInfoController extends Controller
{
    /** @var string The message called when a record is not found  */
    private string $notfound_message = 'The record is not found';

    /**
     * @OA\Get(
     *      path="/api/books_info",
     *      summary="Get a list of book_info",
     *      @OA\Response(
     *          response=200,
     *          description="Successful response",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/BookInfo")
     *          )
     *      )
     * )
     */
    public function index()
    {
        $books_info = BookInfo::all();
        return response()->json(
            $books_info,
            200
        );
    }
    ...
}
```

### ドキュメントの生成

次のコマンドでドキュメントを生成します。

```bash
php artisan l5-swagger:generate
```
`storage/api-docs/api-docs.json`が生成されています。`http://localhost:8000/api/documentation`から生成されたドキュメントを確認できます。

`.env`ファイルに以下を追記すると、ドキュメントの自動生成とyamlファイルでの保存を行ってくれます。
```
L5_SWAGGER_GENERATE_ALWAYS=true
L5_SWAGGER_GENERATE_YAML_COPY=ture
L5_FORMAT_TO_USE_FOR_DOCS=yaml
```

## 著者

[connect0459 (Akira Nakaoka)](https://github.com/connect0459)
