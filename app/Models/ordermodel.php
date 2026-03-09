<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ordermodel extends Model
{
    use HasFactory;
    protected $table = 'orders';
    // public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(usermodel::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(productsmodel::class, 'product_id');
    }
}
