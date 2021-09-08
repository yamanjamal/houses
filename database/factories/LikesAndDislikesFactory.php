<?php

namespace Database\Factories;

use App\Models\LikesAndDislikes;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikesAndDislikesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LikesAndDislikes::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'likeState'  =>rand(1,0),
            'user_id' => rand(1,10),
            'house_id'=>rand(1,10),
            
        ];
    }
}
