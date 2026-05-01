<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ordermodel extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $guarded = [];
    // public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(usermodel::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(productsmodel::class, 'product_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function products()
    {
        return $this->belongsToMany(productsmodel::class, 'order_items', 'order_id', 'product_id')
                    ->withPivot('quantity', 'price');
    }
}
