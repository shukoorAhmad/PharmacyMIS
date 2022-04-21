<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    public $primaryKey = "sale_id";
    public function customer_details()
    {
        return $this->hasOne(Customer::class, 'customer_id', 'customer_id');
    }
    public function seller_details()
    {
        return $this->hasOne(Seller::class, 'seller_id', 'customer_id');
    }
    public function sales_details()
    {
        return $this->hasMany(SalesItem::class, 'sale_id', 'sale_id');
    }
    use HasFactory;
}
