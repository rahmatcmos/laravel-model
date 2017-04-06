<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      for ($i=0; $i <= 10 ; $i++) {
        /* Tanpa method save
        App\Post::insert([
          'title' => $faker->sentence,
          'content' => $faker->paragraph,
          'published' => rand(0,1)
        ]);*/
        $post = new App\Post;
        $post->title = $faker->sentence;
        $post->content = $faker->paragraph;
        $post->published = rand(0,1);
        $post->save();
      }
    }
}
