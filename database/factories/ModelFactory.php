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

/** @var \Illuminate\Database\Eloquent\Factory $factory 
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

*/

$factory->define(App\Baseline::class, function (Faker\Generator $faker) {
    return [
            'project_id' => $faker->numberBetween(1,70),
            'status' => $faker->randomElement($array = array('Opened','Closed','Locked')),
            ];
});

$factory->define(App\Project::class, function (Faker\Generator $faker) {
	return [
            'title' => $faker->sentence($nbWords = 3, $variableNbWords = true),
            'description' => $faker->text($maxNbChars = 200),
            'dateDebut' => $faker->dateTime,
            'dateFin' => $faker->dateTime,
            'STD' => $faker->numberBetween(0,9999),
            'progress' => $faker->numberBetween(1,7),
            'c_orgBaseline' => $faker->numberBetween(1,7),
        	];
});


$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
            'email' => $faker->unique()->safeEmail,
            'password' => bcrypt('secret'),
            'first_name' => $faker->name,
            'last_name' => $faker->name,
            'fonction' => $faker->randomElement($array = array('C_ORG','AI_ORG')),
            'organisation' => $faker->company(5),
            'access' => $faker->numberBetween(1,7),
            'remember_token' => str_random(10),
            ];
});