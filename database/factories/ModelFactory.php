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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name'  => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(App\Student::class, function (Faker\Generator $faker) {
    return [
        'name'      => $faker->firstName,
        'surname'   => $faker->lastName,
        'email'     => $faker->email,
        'ssn'       => $faker->numberBetween(),
        'birthdate' => $faker->date(),
        'gender'    => $faker->randomElement(['F', 'M']),
        'token'     => $faker->md5,
    ];
});

$factory->define(App\Instructor::class, function (Faker\Generator $faker) {
    return [
        'name'     => $faker->firstName,
        'surname'  => $faker->lastName,
        'email'    => $faker->email,
        'hiredate' => $faker->date(),
        'vatnumber'      => $faker->numberBetween(),
        'gender'   => $faker->randomElement(['F', 'M']),
        'token'    => $faker->md5,
    ];
});

$factory->define(App\Room::class, function (Faker\Generator $faker) {
    return [
        'number'   => strtoupper($faker->randomLetter . $faker->randomLetter . $faker->randomLetter),
        'capacity' => $faker->numberBetween(30, 100),
    ];
});