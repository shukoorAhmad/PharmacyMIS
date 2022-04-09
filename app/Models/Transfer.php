<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    public $primaryKey = "transfer_id";
    use HasFactory;
    public function transfer_items()
    {
        return $this->hasMany(TransferItem::class, 'transfer_id', 'transfer_id');
    }
    public function src_stock_details()
    {
        return $this->hasOne(Stock::class, 'stock_id', 'source_stock_id');
    }
    public function dest_stock_details()
    {
        return $this->hasOne(Stock::class, 'stock_id', 'destination_stock_id');
    }
}
