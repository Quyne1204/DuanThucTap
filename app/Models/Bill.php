<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',    'date',    'id_cart',    'id_customer',    'address',    'phone',    'total',    'status',    'note',    'created_at',    'updated_at',
    ];
}
