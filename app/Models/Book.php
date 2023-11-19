<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',    'title_book',    'price',    'image',    'description',    'quantity',    'id_review',    'id_author',    'id_cate',    'created_at',    'updated_at',
    ];
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'id_cate');
    }
}
