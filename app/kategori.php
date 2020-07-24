<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
  protected $fillable =[

  'kategori',
  ];

  public function buku()
  {
    return $this->hasMany(Buku::class);
  }
  public function transaksi()
    {
      return $this->hasMany(Transaksi::class);
    }
}
