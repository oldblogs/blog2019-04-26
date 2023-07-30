<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt($faker->bothify('***###******###******###*****')),
        'enabled' => false,
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {

    return [
        'user_id' => function () {
            return App\User::inRandomOrder()->first()->id;
        },
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'published' => 1
    ];
});

$factory->define(App\About::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->name,
        'subtitle' => ' ',
        'body' => $faker->paragraph
    ];
});