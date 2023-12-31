<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'cate_Name',        'created_at',    'updated_at',
    ];
    public function product()
    {
        return $this->hasMany(Book::class, 'id_cate', 'id');
    }
}
