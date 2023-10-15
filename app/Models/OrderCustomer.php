<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCustomer extends Model
{
    use HasFactory;

    protected $table = 'orders_customers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'numbering',
        'name1',
        'name2',
        'university',
        'grade',
        'belong',
        'email',
        'receive_method',
        'receive_date',
        'receive_time',
        'payment_method',
        'payment_due_date',
        'payment_due_time',
        'is_paid',
        'notes'
    ];
    protected $dates = ['created_at', 'updated_at'];
}
