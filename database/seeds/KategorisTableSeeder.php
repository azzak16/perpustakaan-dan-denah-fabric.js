<?php

use Illuminate\Database\Seeder;

class KategorisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $kategoris = collect(['Bahasa', 'Teknologi', 'Geografi', 'Ekonomi']);
      $kategoris->each(function ($c){
        \App\kategori::create([
          'kategori' => $c,
        ]);
      });
    }
}
