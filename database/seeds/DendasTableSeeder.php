<?php

use Illuminate\Database\Seeder;

class DendasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \App\Denda::create([
        'denda' => 2000,
      ]);
    }
}
