<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_transaksi')->unique();
            $table->bigInteger('anggota_id')->unsigned();
            $table->foreign('anggota_id')->references('id')->on('anggotas')->onDelete('cascade');
            $table->bigInteger('pegawai_id')->unsigned();
            $table->foreign('pegawai_id')->references('id')->on('pegawais')->onDelete('cascade');
            $table->bigInteger('buku_id')->unsigned();
            $table->foreign('buku_id')->references('id')->on('bukus')->onDelete('cascade');
            $table->bigInteger('denda_id')->unsigned();
            $table->foreign('denda_id')->references('id')->on('bukus')->onDelete('cascade');
            $table->date('tgl_book')->nullable();
            $table->date('tgl_pinjam')->nullable();
            $table->date('tgl_kembali')->nullable();
            $table->time('jam_book')->nullable();
            $table->date('kembali_bnr')->nullable();
            $table->enum('status',['book','pinjam','kembali']);
            $table->text('ket')->nullable();
            $table->string('denda')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
