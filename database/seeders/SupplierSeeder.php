<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = [
            ['name' => 'gsk', 'contact_no' => '0795814021', 'email' => 'gsk@gmail.com'],
            ['name' => 'Abbot', 'contact_no' => '0795814021', 'email' => 'abbot@gmail.com'],
            ['name' => 'Merck', 'contact_no' => '0795814021', 'email' => 'merck@gmail.com'],
        ];
        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
