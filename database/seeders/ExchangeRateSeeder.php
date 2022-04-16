<?php

namespace Database\Seeders;

use App\Models\ExchangeRate;
use Illuminate\Database\Seeder;

class ExchangeRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exchangeRates = [
            ['usd_afg' => 88,'usd_kal' => 102]
        ];
        foreach ($exchangeRates as $ex_rate) {
            ExchangeRate::create($ex_rate);
        }
    }
}
