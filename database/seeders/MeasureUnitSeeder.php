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
            ['unit' => 'ml'],
            ['unit' => 'mg'],
            ['unit' => 'lit'],
            ['unit' => 'gr'],
            ['unit' => 'cc'],
        ];
        foreach ($measures as $measure) {
            Measure_unit::create($measure);
        }
    }
}
