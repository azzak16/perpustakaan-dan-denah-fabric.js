<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
      'kode_transaksi',
      'anggota_id',
      'pegawai_id',
      'buku_id',
      'denda_id',
      'kategori_id',
      'tgl_pinjam',
      'tgl_kembali',
      'tgl_book',
      'jam_book',
      'kembali_bnr',
      'status',
      'ket',
      'denda',
    ];
    public function anggota()
    {
    	return $this->belongsTo(Anggota::class);
    }

    public function pegawai()
    {
    	return $this->belongsTo(Pegawai::class);
    }

    public function buku()
    {
    	return $this->belongsTo(Buku::class);
    }

    public function kategoris()
    {
    	return $this->belongsTo(Kategori::class);
    }

    public function denda()
    {
      return $this->belongsTo(Denda::class);
    }
  }
