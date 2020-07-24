<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call(UsersTableSeeder::class);
      $this->call(DendasTableSeeder::class);
      $this->call(AnggotasTableSeeder::class);
      $this->call(PegawaisTableSeeder::class);
      $this->call(RaksTableSeeder::class);
      $this->call(KategorisTableSeeder::class);
      $this->call(BukusTableSeeder::class);
      $this->call(PostsTableSeeder::class);
    }
}
