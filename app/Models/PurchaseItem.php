<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    public $primaryKey = "purchase_item_id";
    use HasFactory;
    public function items_details()
    {
        return $this->hasOne(Item::class, 'item_id', 'item_id');
    }
}
