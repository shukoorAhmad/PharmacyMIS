<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['item_name' => 'cefiget', 'item_type' => 1, 'item_unit' => '200 ml', 'measure_unit_id' => 3, 'quantity_per_carton' => 12,'purchase_price'=>11,'sale_price'=>12],
            ['item_name' => 'cefiget', 'item_type' => 1, 'item_unit' => '100 ml', 'measure_unit_id' => 3,  'quantity_per_carton' =>12, 'purchase_price' => 10, 'sale_price' => 12],
            ['item_name' => 'paraol', 'item_type' => 2, 'item_unit' => '20 gr', 'measure_unit_id' => 2,  'quantity_per_carton' =>24, 'purchase_price' => 9, 'sale_price' => 13],
            ['item_name' => 'panadol', 'item_type' => 2, 'item_unit' => '20 gr', 'measure_unit_id' => 2,  'quantity_per_carton' =>24, 'purchase_price' => 8, 'sale_price' => 10],
            ['item_name' => 'cofcol', 'item_type' => 1, 'item_unit' => '130 ml', 'measure_unit_id' => 3,'quantity_per_carton' =>12, 'purchase_price' => 15, 'sale_price' => 20],
        ];
        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
