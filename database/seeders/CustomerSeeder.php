<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = [
            ['pharmacy_name' => 'pharma 1', 'customer_name' => 'customer name 1', 'customer_last_name' => 'customer lname 1', 'site_id' => 1, 'contact_no' => '0795814021', 'contact_no_2' => '0795814021'],
            ['pharmacy_name' => 'pharma 2', 'customer_name' => 'customer name 2', 'customer_last_name' => 'customer lname 2', 'site_id' => 2, 'contact_no' => '0795814021', 'contact_no_2' => '0795814021'],
            ['pharmacy_name' => 'pharma 3', 'customer_name' => 'customer name 3', 'customer_last_name' => 'customer ;name 3', 'site_id' => 1, 'contact_no' => '0795814021', 'contact_no_2' => '0795814021'],
        ];
        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
