<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $primaryKey = "customer_id";
    use HasFactory;
    public function site()
    {
        return $this->hasOne(site::class, 'site_id', 'site_id');
    }
}
