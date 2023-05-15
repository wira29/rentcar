<?php

namespace Database\Seeders;

use App\Models\Rental;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rentals = ['Bintang Cahaya Trans', 'Happy Trans', 'Jaya Trans', 'Fast Trans', 'Adi Trans'];

        foreach ($rentals as $rental){
            $email = explode(' ', $rental)[0];
            $user = User::create([
                'name'  => $rental,
                'email' => strtolower($email) . '@gmail.com',
                'password' => bcrypt('password')
            ]);

            $user->assignRole('rental');

            $data = [
                'name' => $rental,
                'province_id' => '35',
                'regency_id' => '3507',
                'district_id' => '3507010',
                'village_id' => '3507200002',
                'address' => fake()->address
            ];
            $data['user_id'] = $user->id;

            Rental::create($data);
        }
    }
}
