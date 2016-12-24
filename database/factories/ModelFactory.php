<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

//$factory->define(App\User::class, function (Faker\Generator $faker) {
//    static $password;
//
//    return [
//        'username' => $faker->userName,
//        'first_name' => $faker->firstName,
//        'last_name' => $faker->lastName,
//        'tel' => $faker->phoneNumber,
//        'email' => $faker->unique()->safeEmail,
//        'password' => $password ?: $password = bcrypt('secret'),
//        'remember_token' => str_random(10),
//        'api_token' => str_random(60),
//    ];
//});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    static $user_id;

    return [
        'user_id' =>$user_id ?: $user_id = 151,
        'title' => $faker->title,
        'description' => $faker->text,
    ];
});
