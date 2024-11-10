<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;
use App\Models\Country;

class BrandCountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brand1 = Brand::where('name', 'Alexander')->first();
        $brand2 = Brand::where('name', 'Legend Play')->first();
        $brand3 = Brand::where('name', 'Royalistplay')->first();
        $brand4 = Brand::where('name', 'Betalright')->first();
        $brand5 = Brand::where('name', 'Simsinos')->first();
        $brand6 = Brand::where('name', 'Talismania')->first();
        $brand7 = Brand::where('name', 'Cashed Casino')->first();
        $brand8 = Brand::where('name', 'Casombie')->first();
        $brand9 = Brand::where('name', 'Kingmaker')->first();
        $brand10 = Brand::where('name', 'Nine Casino')->first();

        $lu = Country::where('code', 'LU')->first();
        $fr = Country::where('code', 'FR')->first();
        $it = Country::where('code', 'IT')->first();

        DB::table('brand_country')->insert([
            ['brand_id' => $brand1->id, 'country_id' => $lu->id],
            ['brand_id' => $brand2->id, 'country_id' => $lu->id],
            ['brand_id' => $brand3->id, 'country_id' => $lu->id],

            ['brand_id' => $brand4->id, 'country_id' => $fr->id],
            ['brand_id' => $brand5->id, 'country_id' => $fr->id],
            ['brand_id' => $brand6->id, 'country_id' => $fr->id],
            ['brand_id' => $brand7->id, 'country_id' => $fr->id],

            ['brand_id' => $brand8->id, 'country_id' => $it->id],
            ['brand_id' => $brand9->id, 'country_id' => $it->id],
            ['brand_id' => $brand10->id, 'country_id' => $it->id],
        ]);
    }
}
