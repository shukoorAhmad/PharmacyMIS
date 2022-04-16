<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provices = [
            [
                "province_id" => "1",
                "name_en" => "Kabul",
                "name_dr" => "کابل",
            ],
            [
                "province_id" => "2",
                "name_en" => "Kapisa",
                "name_dr" => "کاپيسا",
            ],
            [
                "province_id" => "3",
                "name_en" => "Parwan",
                "name_dr" => "پروان",
            ],
            [
                "province_id" => "4",
                "name_en" => "Wardak",
                "name_dr" => "میدان وردک",
            ],
            [
                "province_id" => "5",
                "name_en" => "Logar",
                "name_dr" => "لوگر",
            ],
            [
                "province_id" => "6",
                "name_en" => "Ghazni",
                "name_dr" => "غزني",
            ],
            [
                "province_id" => "7",
                "name_en" => "Paktia",
                "name_dr" => "پکتيا",
            ],
            [
                "province_id" => "8",
                "name_en" => "Nangarhar",
                "name_dr" => "ننگرهار",
            ],
            [
                "province_id" => "9",
                "name_en" => "Laghman",
                "name_dr" => "لغمان",
            ],
            [
                "province_id" => "10",
                "name_en" => "Kunar",
                "name_dr" => "کنر",
            ],
            [
                "province_id" => "11",
                "name_en" => "Badakhshan",
                "name_dr" => "بدخشان",
            ],
            [
                "province_id" => "12",
                "name_en" => "Takhar",
                "name_dr" => "تخار",
            ],
            [
                "province_id" => "13",
                "name_en" => "Baghlan",
                "name_dr" => "بغلان",
            ],
            [
                "province_id" => "14",
                "name_en" => "Kunduz",
                "name_dr" => "کندوز",
            ],
            [
                "province_id" => "15",
                "name_en" => "Samangan",
                "name_dr" => "سمنگان",
            ],
            [
                "province_id" => "16",
                "name_en" => "Balkh",
                "name_dr" => "بلخ",
            ],
            [
                "province_id" => "17",
                "name_en" => "Jawzjan",
                "name_dr" => "جوزجان",
            ],
            [
                "province_id" => "18",
                "name_en" => "Faryab",
                "name_dr" => "فارياب",
            ],
            [
                "province_id" => "19",
                "name_en" => "Badghis",
                "name_dr" => "بادغيس",
            ],
            [
                "province_id" => "20",
                "name_en" => "Herat",
                "name_dr" => "هرات",
            ],
            [
                "province_id" => "21",
                "name_en" => "Farah",
                "name_dr" => "فراه",
            ],
            [
                "province_id" => "22",
                "name_en" => "Nimroz",
                "name_dr" => "نيمروز",
            ],
            [
                "province_id" => "23",
                "name_en" => "Hilmand",
                "name_dr" => "هلمند",
            ],
            [
                "province_id" => "24",
                "name_en" => "Kandahar",
                "name_dr" => "کندهار",
            ],
            [
                "province_id" => "25",
                "name_en" => "Zabul",
                "name_dr" => "زابل",
            ],
            [
                "province_id" => "26",
                "name_en" => "Uruzgan",
                "name_dr" => "ارزگان",
            ],
            [
                "province_id" => "27",
                "name_en" => "Ghor",
                "name_dr" => "غور",
            ],
            [
                "province_id" => "28",
                "name_en" => "Bamyan",
                "name_dr" => "باميان",
            ],
            [
                "province_id" => "29",
                "name_en" => "Paktika",
                "name_dr" => "پکتيکا",
            ],
            [
                "province_id" => "30",
                "name_en" => "Nuristan",
                "name_dr" => "نورستان",
            ],
            [
                "province_id" => "31",
                "name_en" => "Sar i Pul",
                "name_dr" => "سرپل",
            ],
            [
                "province_id" => "32",
                "name_en" => "Khost",
                "name_dr" => "خوست",
            ],
            [
                "province_id" => "33",
                "name_en" => "Panjshir",
                "name_dr" => "پنجشير",
            ],
            [
                "province_id" => "34",
                "name_en" => "Daikundi",
                "name_dr" => "دايکندي",
            ]
        ];
        foreach ($provices as $province) {
            Province::create($province);
        }
    }
}
