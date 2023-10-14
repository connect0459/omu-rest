<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
