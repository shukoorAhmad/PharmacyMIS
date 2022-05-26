<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;
    public function customer_account_function()
    {
        return $this->hasOne(CustomerAccount::class, 'customer_account_id', 'source_id');
    }
    public function seller_account_function()
    {
        return $this->hasOne(SellerAccount::class, 'seller_account_id', 'source_id');
    }
    public function supplier_account_function()
    {
        return $this->hasOne(SupplierAccount::class, 'supplier_account_id', 'source_id');
    }
}
