<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Seeder;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sellers = [
            ['seller_name' => 'seller name 1', 'seller_last_name' => 'seller l name 1', 'address' => 'kabul', 'contact_no' => '0795814021', 'contact_no_2' => '0795814021'],
            ['seller_name' => 'seller name 2', 'seller_last_name' => 'seller l name 2', 'address' => 'kabul', 'contact_no' => '0795814021', 'contact_no_2' => '0795814021'],
            ['seller_name' => 'seller name 3', 'seller_last_name' => 'seller l name 3', 'address' => 'kabul', 'contact_no' => '0795814021', 'contact_no_2' => '0795814021'],
        ];
        foreach ($sellers as $seller) {
            Seller::create($seller);
        }
    }
}
