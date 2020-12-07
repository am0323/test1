<?php
//実習問題 Chapter7 問題2より
use App\Person;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'mail' => $faker->unique()->safeEmail,
        'age' => $faker->numberBetween($min = 1, $max = 100),
    ];
});
