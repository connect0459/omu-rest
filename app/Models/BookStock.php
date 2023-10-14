<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookStock extends Model
{
    use HasFactory;

    protected $table = 'books_stock';
    protected $primaryKey = 'id';
    protected $fillable = [
        'books_info_id',
        'isbn',
        'stock',
        'order',
        'sold'
    ];
    protected $dates = ['created_at', 'updated_at'];
}
