<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    public $primaryKey = "stock_item_id";
    use HasFactory;
    
    public function item_details()
    {
        return $this->hasOne(Item::class, 'item_id', 'item_id');
    }
}
