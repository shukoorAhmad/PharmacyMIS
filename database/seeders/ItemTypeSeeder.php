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
            ['type' => 'DRY SYP'],
            ['type' => 'TAB'],
            ['type' => 'INJ'],
            ['type' => 'CAP'],
            ['type' => 'PWD'],
            ['type' => 'LOTION'],
            ['type' => 'SUSPENSION'],
            ['type' => 'DRP'],
            ['type' => 'PMD'],
            ['type' => 'SERM'],
            ['type' => 'OIL'],
        ];
        foreach ($items as $item) {
            ItemType::create($item);
        }
    }
}
