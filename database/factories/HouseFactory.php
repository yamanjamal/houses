<?php

namespace Database\Factories;

use App\Models\House;
use Illuminate\Database\Eloquent\Factories\Factory;

class HouseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = House::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'         =>$this->faker->text(20),
            'beds'          =>rand(1,10),
            'baths'         =>rand(1,5),
            'price'         =>rand(1000,5000),
            'place'         =>$this->faker->address,
            'description'   =>$this->faker->text(200),
            'property_type' =>array_rand(['house','vella','appartment']),
            'Balcony'       =>rand(1,0),
            'Parking'       =>rand(1,0),
            'Pool'          =>rand(1,0),
            'Beach'         =>rand(1,0),
            'Air_condtioning'=>rand(1,0),
            'Pet_friendly'  =>rand(1,0),
            'Kid_friendly'  =>rand(1,0),
            'approved'      =>array_rand(['approver','inprogress','declined']),
            'user_id'       =>rand(1,10),
        ];
    }
}
