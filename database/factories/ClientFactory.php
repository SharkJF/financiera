<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ModelsClient;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'name'      =>$faker->name,
        'address'   =>$faker->address,
        'phone'     =>$faker->phone,
    ];
});
