<?php

namespace Database\Seeders;

use App\Models\ItemType;
use Illuminate\Database\Seeder;

class ItemTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['type' => 'SYP'],
            ['type' => 'TAB'],
            ['type' => 'INJ'],
            ['type' => 'CAP'],
            ['type' => 'POW'],
            ['type' => 'LOTION'],
            ['type' => 'DRP'],
        ];
        foreach ($items as $item) {
            ItemType::create($item);
        }
    }
}
