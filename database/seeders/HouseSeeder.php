<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\House;


class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        House::create([
            'title'         =>'first home',
            'beds'          =>1,
            'baths'         =>2,
            'price'         =>1500,
            'place'         =>'los angelus',
            'description'   =>'this house is really great and good if u dont like it u r stupid',
            'property_type' =>'appartment',
            'Balcony'       =>1,
            'Parking'       =>1,
            'Pool'          =>1,
            'Beach'         =>1,
            'Air_condtioning'=>1,
            'Pet_friendly'  =>1,
            'Kid_friendly'  =>1,
            'approved'      =>'approver',
            'user_id'       =>2,
        ]);
        House::create([
            'title'         =>'mayar home',
            'beds'          =>1,
            'baths'         =>2,
            'price'         =>1500,
            'place'         =>'los angelus',
            'description'   =>'this house is really great and good if u dont like it u r stupid',
            'property_type' =>'appartment',
            'Balcony'       =>1,
            'Parking'       =>1,
            'Pool'          =>1,
            'Beach'         =>1,
            'Air_condtioning'=>1,
            'Pet_friendly'  =>1,
            'Kid_friendly'  =>1,
            'approved'      =>'approver',
            'user_id'       =>1,
        ]);
        House::factory(20)->create();
    }
}
