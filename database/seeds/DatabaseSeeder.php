<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = factory(App\User::class, 1)->create();
        $posts = factory(App\Post::class, 100)->create();
        $posts = factory(App\About::class, 1)->create();
        $posts = factory(App\Contact::class, 10)->create();
    }
}
