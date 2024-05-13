<?php

namespace Database\Seeders;

use App\Models\prop\PropImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PropImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {
    //     $faker = Faker::create();
    //     for ($i = 0; $i < 100; $i++) {
    //         PropImage::create([
    //             'prop_id' => $faker->numberBetween(1, 16),
    //             'image' => $faker->randomElement([
    //                 'hero_bg_1.jpg',
    //                 'hero_bg_2.jpg',
    //                 'hero_bg_3.jpg',
    //                 'hero_bg_4.jpg',
    //                 'hero_bg_5.jpg',
    //                 'hero_bg_6.jpg',
    //                 'hero_bg_7.jpg',
    //                 'hero_bg_8.jpg',
    //                 'hero_bg_9.jpg',
    //                 'hero_bg_10.jpg',
    //                 'hero_bg_11.jpg',
    //                 'hero_bg_12.jpg',
    //                 'hero_bg_13.jpg',
    //             ]),
    //         ]);
    //     }
    // }
}
