<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesItem extends Model
{
    public $primaryKey = "sale_item_id";
    public function items_details()
    {
        return $this->hasOne(Item::class, 'item_id', 'item_id');
    }
    use HasFactory;
}
