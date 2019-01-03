<?php

use Faker\Generator as Faker;

$factory->define(App\Artikel::class, function (Faker $faker) {
    return [
        'judul' => $faker->sentence(8),
        'isi' => $faker->randomHtml(2,4),
        'slug' => $faker->slug,
        'id_kategori' => $faker->numberBetween(1, 4),
        'id_user' => $faker->numberBetween(1, 4),
    ];
});
