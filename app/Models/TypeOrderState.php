<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOrderState extends Model
{
    use HasFactory;

    protected $table = 'types_order_state';
    protected $primaryKey = 'id';
    protected $fillable = [
        'type'
    ];
    protected $dates = ['created_at', 'updated_at'];
}
