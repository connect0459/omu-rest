<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoBook extends Model
{
    use HasFactory;

    protected $table = 'info_books';
    protected $primaryKey = 'id';
    protected $fillable = [
        'isbn',
        'title',
        'author',
        'publisher',
        'genre',
        'list_price',
        'sale_price',
        'stock',
        'order',
        'sold',
    ];
    protected $dates = ['created_at', 'updated_at'];
}
