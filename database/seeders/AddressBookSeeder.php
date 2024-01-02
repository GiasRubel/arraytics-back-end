<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AddressBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            DB::table('address_book')->insert([
                'name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'email' => $faker->email,
                'website' => $faker->url,
                'gender' => $faker->randomElement([0, 1]), // 0 for female, 1 for male
                'age' => $faker->numberBetween(18, 65),
                'nationality' => $faker->country,
                'created_at' => now(),
                'created_by' => 1, // Set the appropriate user ID who created the entry
            ]);
        }
    }
}
