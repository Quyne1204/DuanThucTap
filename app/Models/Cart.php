<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',    'book_id',    'user_id', 'quantity',  'money',    'created_at',    'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getBy1($bookId)
    {
        return Cart::whereBookId($bookId)->first();
    }
    public function getBy2($userId)
    {
        return Cart::whereUserId($userId)->first();
    }
}
