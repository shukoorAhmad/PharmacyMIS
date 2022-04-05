<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    public $primaryKey = "purchase_item_id";
    use HasFactory;
    public function purchase_items()
    {
        return $this->hasOne(Purchase::class, 'purchase_id', 'purchase_id');
    }
}
