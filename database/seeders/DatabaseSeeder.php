<?php

namespace Database\Seeders;

use App\Models\ExchangeRate;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProvinceSeeder::class,
            SiteSeeder::class,
            SupplierSeeder::class,
            CustomerSeeder::class,
            StockSeeder::class,
            ItemSeeder::class,
            SellerSeeder::class,
            MeasureUnitSeeder::class,
            CurrencySeeder::class,
            ExchangeRateSeeder::class

        ]);
    }
}
