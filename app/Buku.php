<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
  protected $fillable =[
    'kode_buku',
    'kategori_id',
    'rak_id',
    'judul_buku',
    'penulis',
    'penerbit',
    'tahun_terbit',
    'deskripsi',
    'cover',
    'jumlah',
    ];
    public function kategori()
    {
      return $this->belongsTo(Kategori::class);
    }
    public function rak()
    {
      return $this->belongsTo(Rak::class);
    }
    public function transaksi()
    {
      return $this->hasMany(Transaksi::class);
    }
    public function getCover()
    {
      if(!$this->cover){
        return url('images/cover/nocover.jpg');
      }
      return url('images/cover/' .$this->cover);
    }
}
