<?php

use Illuminate\Database\Seeder;

class PegawaisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \App\Pegawai::create(

        [
          'user_id' => 2,
          'id_pegawai' => 'PG00001',
          'nama' => 'didin',
          'agama' => 'islam',
          'jenis_kelamin' => 'L',
          'tempat_lahir' => 'surabaya',
          'tgl_lahir' => '1980-10-10',
          'alamat' => 'medayu',
          'no_hp' => '0878'
        ],
      );
    }
}
