<?php

namespace Database\Seeders;

use App\Models\prop\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PropsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Generate 10 dummy records
        for ($i = 0; $i < 15; $i++) {
            Property::create([
                'title' => $faker->sentence,
                'price' => $faker->randomFloat(2, 1000, 100000),
                'image' => $faker->randomElement(['hero_bg_1.jpg', 'hero_bg_2.jpg', 'hero_bg_3.jpg']),
                'beds' => $faker->numberBetween(1, 5),
                'baths' => $faker->numberBetween(1, 3),
                'sqm' => $faker->numberBetween(500, 3000),
                'home_type' => $faker->randomElement(['House', 'Apartment', 'Hostel']),
                'year_built' => $faker->numberBetween(1950, 2023),
                'price_per_sqm' => $faker->randomFloat(2, 50, 500),
                'more_info' => $faker->paragraph,
                'location' => $faker->address,
                'agent_name' => $faker->name,
                'prop_type' => $faker->randomElement(['Lease', 'Rent', 'Purchase']),
            ]);
        }
    }
}
