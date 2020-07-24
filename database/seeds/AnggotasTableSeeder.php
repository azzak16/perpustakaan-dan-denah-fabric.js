<?php

use Illuminate\Database\Seeder;

class AnggotasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \App\Anggota::create(

        [
          'user_id' => 3,
          'id_anggota' => 'AG00001',
          'nama' => 'angga zakaria',
          'agama' => 'islam',
          'jenis_kelamin' => 'L',
          'tempat_lahir' => 'kediri',
          'tgl_lahir' => '1997-01-16',
          'alamat' => 'menganti',
          'no_hp' => '085648540552'
        ],
      );
    }
}
