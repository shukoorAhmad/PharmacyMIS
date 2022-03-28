<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $primaryKey = "order_id";
    use HasFactory;

    public function supplier_detials()
    {
        return $this->hasOne(Supplier::class, 'supplier_id', 'supplier_id');
    }
}
