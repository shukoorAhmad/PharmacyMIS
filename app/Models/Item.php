<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $primaryKey = "item_id";
    use HasFactory;

    public function measure_details()
    {
        return $this->hasOne(Measure_unit::class, 'measure_unit_id', 'measure_unit_id');
    }

    public function stock_details()
    {
        return $this->hasOne(StockItem::class, 'item_id', 'item_id')->where('quantity', '!=', 0);
    }
    public function item_type_details()
    {
        return $this->hasOne(ItemType::class, 'id', 'item_type');
    }
}
