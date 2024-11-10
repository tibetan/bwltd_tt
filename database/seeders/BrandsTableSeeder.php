<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('brands')->insert([
            ['name' => 'Alexander', 'image' => 'img/alexander-casino.png', 'rating' => 5],
            ['name' => 'Legend Play', 'image' => 'img/royalistplay-casino.png', 'rating' => 4],
            ['name' => 'Royalistplay', 'image' => 'img/royalistplay-casino.png', 'rating' => 3],
            ['name' => 'Betalright', 'image' => 'img/betalright-casino.png', 'rating' => 3],
            ['name' => 'Simsinos', 'image' => 'img/simsino-casino.png', 'rating' => 5],
            ['name' => 'Talismania', 'image' => 'img/talismania-casino.png', 'rating' => 4],
            ['name' => 'Cashed Casino', 'image' => 'img/cashed-casino.png', 'rating' => 5],
            ['name' => 'Casombie', 'image' => 'img/Casombie-Casino.png', 'rating' => 4],
            ['name' => 'Kingmaker', 'image' => 'img/kingmaker-casino.png', 'rating' => 3],
            ['name' => 'Nine Casino', 'image' => 'img/nine-casino.png', 'rating' => 3],
        ]);
    }
}
