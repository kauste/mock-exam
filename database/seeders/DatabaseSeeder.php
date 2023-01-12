<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123'),
        ]);

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
            'role' => 2,
        ]);
        $countries = [
            'Argentina',
            'Island',
            'Italy',
            'Latvia',
            'Lithuania',
            'Spain',
            'France',
            'Germany'
        ];


        foreach($countries as $country) {
            DB::table('countries')->insert([
                'country_name' => $country,
                'seazon_id' => rand(1, 4),
            ]);
        }
        $seazons = [
            'summer',
            'spring',
            'winter',
            'autumn'
        ];
        foreach($seazons as $seazon) {
            DB::table('seazons')->insert([
                'seazon_name' => $seazon,
            ]);
        }

        $faker = Faker::create('lt_LT');
        foreach(range(1, 10) as $_){
            DB::table('hotels')->insert([
                'hotel_name' => $faker->firstNameFemale,
                'price'=> rand(200, 999),
                'duration' => rand(7,14),
                'country_id'=> rand(0, count($countries)- 1)
            ]);
        }
    }
}
