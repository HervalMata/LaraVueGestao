<?php
/**
 * Created by PhpStorm.
 * User: Herval
 * Date: 29/10/2018
 * Time: 03:29
 */
use Faker\Generator as Faker;

$factory->define(\App\Models\Unit::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
    ];
});