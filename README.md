# omu-rest
Laravelで構築されたRESTful APIサーバーです。

## API エンドポイント（URI）の追加
### Model・Migration・Controllerの作成
Migration（マイグレーション）ファイルとは、コマンドラインからデータベースの作成を行う際に参照される定義ファイルです。作成するModelの名前を`ModelName`とすると、次のコマンドでModel、Migration、Controllerファイルを一括で作成できます。
```
php artisan make:model ModelName --migration --controller --api 
```
Controllerを個別に作成する場合は以下のようにし、`--api`オプションを付けましょう。
```
php artisan make:controller ModelNameController --api
```
得られたファイルに仕様を実現するコードを追記しましょう。例として、`books_info`テーブルに関するエンドポイントを作成するためのコードを示します。
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
            $table->string('isbn', 13)->unique();
            $table->string('title', 255);
            $table->string('author', 255)->nullable();
            $table->string('publisher', 255)->nullable();
            $table->string('genre', 255)->nullable();
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
        'list_price',
        'sale_price'
    ];
    protected $dates = ['created_at', 'updated_at'];
}
```
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
        $book_info = BookInfo::create($request->all());
        return response()->json(
            $book_info,
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

### Routingの設定
