<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $primaryKey = "item_id";
    use HasFactory;

    public function measure_details()
    {
        return $this->hasOne(Measure_unit::class, 'measure_unit_id', 'measure_unit_id');
    }

    public function supplier_details()
    {
        return $this->hasOne(Supplier::class, 'supplier_id', 'supplier_id');
    }
}
