<?php

namespace Database\Seeders;

use App\Models\Measure_unit;
use Illuminate\Database\Seeder;

class MeasureUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $measures = [
            ['unit' => 'Box'],
            ['unit' => 'Pcs'],
            ['unit' => 'Bottle'],
        ];
        foreach ($measures as $measure) {
            Measure_unit::create($measure);
        }
    }
}
