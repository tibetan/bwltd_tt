<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->insert([
            ['code' => 'LU', 'name' => 'Luxembourg'],
            ['code' => 'FR', 'name' => 'France'],
            ['code' => 'IT', 'name' => 'Italy'],
        ]);
    }
}
