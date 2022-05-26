<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerAccount extends Model
{
    public $primaryKey = "seller_account_id";
    use HasFactory;
    public function seller_function()
    {
        return $this->hasOne(Seller::class, 'seller_id', 'seller_id');
    }
}
