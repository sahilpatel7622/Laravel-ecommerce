<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productsmodel extends Model
{
    use HasFactory;
    protected $table = 'products';

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category');

    }
}
