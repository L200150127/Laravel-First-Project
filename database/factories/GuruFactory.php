<?php

use Faker\Generator as Faker;

$factory->define(App\Guru::class, function (Faker $faker) {
    return [
        'nip' => $faker->regexify('[0-9]{10}'),
        'nama' => $faker->name,
        'jenis_kelamin' => $faker->randomElement(['L','P']),
        'alamat' => $faker->address,
        'jabatan' => 'Guru',
        'tgl_lahir' => $faker->date('Y-m-d', strtotime('today -20 year'))
    ];
});