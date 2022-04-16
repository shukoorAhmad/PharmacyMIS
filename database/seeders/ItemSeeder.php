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
            ['item_name' => 'cefiget', 'measure_unit_id' => 1, 'dose' => 100, 'quantity_per_carton' => 12],
            ['item_name' => 'cefiget', 'measure_unit_id' => 1, 'dose' => 200, 'quantity_per_carton' => 12],
            ['item_name' => 'paraol', 'measure_unit_id' => 2, 'dose' => 10, 'quantity_per_carton' => 24],
            ['item_name' => 'panadol', 'measure_unit_id' => 2, 'dose' => 10, 'quantity_per_carton' => 24],
            ['item_name' => 'cofcol', 'measure_unit_id' => 3, 'dose' => 20, 'quantity_per_carton' => 12],
        ];
        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
