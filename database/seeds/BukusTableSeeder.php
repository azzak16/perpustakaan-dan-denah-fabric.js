<?php

use App\Buku;
use Illuminate\Database\Seeder;

class BukusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(Buku::class, 10)->create();
    }
}
