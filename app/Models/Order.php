<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $primaryKey = "order_id";
    use HasFactory;
    protected $fillable = ['status'];

    public function supplier_detials()
    {
        return $this->hasOne(Supplier::class, 'supplier_id', 'supplier_id');
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }
}
