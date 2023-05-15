<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Rental;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cars = ['Avanza', 'Xenia', 'Innova', 'Kijang', 'Fortuner', 'Pajero', 'Ayla', 'Agya', 'Brio', 'Mobilio', 'Alphard'];
        $transmissions = ['manual', 'automatic'];
        $merk = ['Toyota', 'Mitsubishi', 'Daihatsu', 'Honda'];
        $carTypes = ['city car', 'compact mpv', 'mini mpv', 'minivan', 'suv'];

        foreach (Rental::all() as $rental) {
            for($i = 1; $i <= 4; $i++){
                Car::create([
                    'rental_id' => $rental->id,
                    'name' => $cars[array_rand($cars, 1)],
                    'transmission' => $transmissions[array_rand($transmissions, 1)],
                    'vehicle_license' => 'N ' . rand(1000, 9000) . ' AB',
                    'merk' => $merk[array_rand($merk, 1)],
                    'price' => rand(250000, 500000),
                    'car_type' => $carTypes[array_rand($carTypes, 1)],
                    'chairs_ammount' => rand(4, 8)
                ]);
            }
        }
    }
}
