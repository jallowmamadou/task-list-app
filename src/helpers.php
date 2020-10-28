<?php

use App\Features\User\Support\Display;
use Carbon\Carbon;
use Faker\Factory;

if (!function_exists('dd')) {
    function dd($args)
    {
        var_dump($args);
        die();
    }
}

if (!function_exists('createFake')) {
    function createFake($times = 1)
    {
        $faker = Factory::create();

        $generated = array_map(function ($id) use ($faker) {
            return [
                'id'          => null,
                'title'       => $faker->sentence,
                'description' => $faker->sentence(128),
                'status'      => $faker->randomElement(['done', 'in-progress', 'pending']),
                'due_date'    => Carbon::parse($faker->dateTime)->toDateTimeString()
            ];
        }, range(1, $times));

        return $times > 1 ? $generated : $generated[0];
    }
}
