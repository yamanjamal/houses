<?php

namespace Database\Factories;

use App\Models\ChatGroups;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatGroupsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChatGroups::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'src'=>$this->faker->Image,
            // 'name'=>$this->faker->name,
            // 'user_id'=>rand(1,10),
            'src'=>'blabla.jpg',
            'name'=>'yamanchat',
            'user_id'=>1,
            'owner_id'=>2,
            'house_id'=>3,
        ];
    }
}
