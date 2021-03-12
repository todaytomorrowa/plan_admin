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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\Service\Models\Admin\AdminUser::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'usernick' => $faker->unique()->firstName,
        'username' => $faker->unique()->word,
        'password' => $password ?: $password = bcrypt('admin123'),
        'remember_token' => str_random(10),
    ];
});


