<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierAccount extends Model
{
    public $primaryKey = "supplier_account_id";
    use HasFactory;
    public function supplier_function()
    {
        return $this->hasOne(Supplier::class, 'supplier_id', 'supplier_id');
    }
}
