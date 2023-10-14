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
