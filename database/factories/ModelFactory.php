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
        'name'      => $faker->firstName,
        'surname'   => $faker->lastName,
        'email'     => $faker->email,
        'ssn'       => $faker->numberBetween(),
        'birthdate' => $faker->date(),
        'gender'    => $faker->randomElement(['F', 'M']),
        'token'     => $faker->md5,
    ];
});

$factory->define(App\Role::class, function () {
    return [
        //'user_id'   => App\User::all()->random()->id,
        'role' => random_int(\App\Role::STUDENT, \App\Role::EMPLOYEE),
    ];
});

$factory->define(App\Room::class, function (Faker\Generator $faker) {
    return [
        'number'   => strtoupper($faker->randomLetter . $faker->randomLetter . $faker->randomLetter),
        'capacity' => $faker->numberBetween(30, 100),
    ];
});

$factory->define(App\Classe::class, function (Faker\Generator $faker) {
    return [
        'name'          => strtoupper($faker->word),
        'discipline_id' => App\Discipline::all()->random()->id,
        'instructor_id' => function () {
            $instructors_id = [];
            $instructors = App\User::allInstructors()->get();
            foreach ($instructors as $item) {
                $instructors_id[] = $item->id;
            }

            return random_int(min($instructors_id), max($instructors_id));
        },
    ];
});