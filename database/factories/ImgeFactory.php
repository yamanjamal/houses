<?php

namespace Database\Factories;

use App\Models\Imge;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImgeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Imge::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'src' => $this->faker->Image,
            'house_id' => rand(1,10),
            'user_id'       =>rand(1,10),
        ];
    }
}
