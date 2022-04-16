<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stocks = [
            ['stock_name' => 'Stock 1', 'stock_address' => 'darulaman', 'incharge' => 'ahmad', 'contact_no' => '0795814021'],
            ['stock_name' => 'Stock 2', 'stock_address' => 'barchi', 'incharge' => 'qasem', 'contact_no' => '0795814021'],
            ['stock_name' => 'Stock 3', 'stock_address' => 'pul-e-surkh', 'incharge' => 'nabi', 'contact_no' => '0795814021'],
        ];
        foreach ($stocks as $stock) {
            Stock::create($stock);
        }
    }
}
