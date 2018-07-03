<?php

use App\Zoo\Animals\Animal;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Animal::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ];
});
