<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public $primaryKey = "purchase_id";
    use HasFactory;
    public function stock_details()
    {
        return $this->hasOne(Stock::class, 'stock_id', 'stock_id');
    }
    public function purchase_items()
    {
        return $this->hasMany(PurchaseItem::class, 'purchase_id', 'purchase_id');
    }
    public function supplier_details()
    {
        return $this->hasOne(Supplier::class, 'supplier_id', 'supplier_id');
    }
}
