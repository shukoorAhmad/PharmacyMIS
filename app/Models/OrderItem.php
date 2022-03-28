<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public $primaryKey = "order_item_id";
    use HasFactory;
    public function items_details()
    {
        return $this->hasOne(Item::class, 'item_id', 'item_id');
    }
}
