<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    public $primaryKey = "site_id";
    use HasFactory;
    public function prov_id()
    {
        return $this->hasOne(Province::class, 'province_id', 'province');
    }
}
