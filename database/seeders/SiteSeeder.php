<?php

namespace Database\Seeders;

use App\Models\Site;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    public function run()
    {
        $sites = [
            ['site_name' => 'Kabul', 'province' => 1],
            ['site_name' => 'Darulaman', 'province' => 1],
            ['site_name' => 'Khairkhan', 'province' => 1],
        ];
        foreach ($sites as $site) {
            Site::create($site);
        }
    }
}
