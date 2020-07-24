<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Buku;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Buku::class, function (Faker $faker) {
  return [
    'kategori_id' => $faker->numberBetween($min = 1, $max = 5),
    'rak_id' => $faker->numberBetween($min = 1, $max = 5),
    'kode_buku' => Str::random(7),
    'judul_buku' => $faker->sentence(8),
    'penulis' => $faker->name,
    'penerbit' => $faker->name,
    'tahun_terbit' => $faker->numberBetween($min = 2000, $max = 2020),
    'deskripsi' => $faker->paragraph(10),
    'jumlah' => $faker->randomDigitNotNull,
    ];
});
