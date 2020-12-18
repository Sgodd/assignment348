<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Factory;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create();

        \App\Models\Post::factory(50)->create()->each(function ($post) use ($faker) {
            /**
             * 0.1 chance of a post being assigned a reply_id
             * Having reply_id means the post is a reply
             * Since all replies are posts, all replies can be replied to
             */
            $post->reply_id = $faker->optional($weight=0.1)->passthrough(\App\Models\Post::get()->random()->id);
            $post->save();
        });
    }
}
