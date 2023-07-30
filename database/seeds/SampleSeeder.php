<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use App\Post;
use App\About;
use App\User;
use Illuminate\Database\Eloquent\Model;

class SampleSeeder extends Seeder
{

  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    factory(App\User::class, 3)
      ->create()
      ->each(function ($user) {
        factory(App\About::class, 1)->create([
          'user_id' => $user->id,
          'title' => $user->name,
        ]);
      });
    // factory(App\Post::class, 30)->create();
  }

}
