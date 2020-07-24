<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    \App\User::create(

    [
      'name' => 'admin',
      'email' => 'admin@gmail.com',
      'password' => bcrypt('admin123'),
      'role' => 'admin',
    ],
    [
      'name' => 'didin',
      'email' => 'didin@gmail.com',
      'password' => bcrypt('didin123'),
      'role' => 'ptgs',
    ],
    [
      'name' => 'angga',
      'email' => 'angga@gmail.com',
      'password' => bcrypt('angga123'),
      'role' => 'user',
    ]
    );
  }
}
