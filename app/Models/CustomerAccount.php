<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAccount extends Model
{
    public $primaryKey = "customer_account_id";
    use HasFactory;
    public function customer_function()
    {
        return $this->hasOne(Customer::class, 'customer_id', 'customer_id');
    }
}
