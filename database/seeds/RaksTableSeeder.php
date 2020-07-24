<?php

use Illuminate\Database\Seeder;

class RaksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $raks = collect(['rak 2', 'rak 3', 'rak 4', 'rak 5']);
      $raks->each(function ($c){
        \App\rak::create([
          'rak' => $c,
        ]);
      });
    }
}
