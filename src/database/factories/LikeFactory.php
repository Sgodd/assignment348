<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Like::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /**
         * Chooses a random post and creates a new user to like it
         * Done to avoid the same user liking the same post in the table
         *  */ 
        
        return [
            'post_id' => Post::get()->random()->id,
            'user_id' => User::factory()->createOne()->id
        ];
    }
}
