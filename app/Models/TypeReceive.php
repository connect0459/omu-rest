<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeReceive extends Model
{
    use HasFactory;

    protected $table = 'types_receive';
    protected $primaryKey = 'id';
    protected $fillable = [
        'type'
    ];
    protected $dates = ['created_at', 'updated_at'];
}
