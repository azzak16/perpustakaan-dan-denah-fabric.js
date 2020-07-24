<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    protected $fillable = [
      'denda',
    ];

    public function transaksi()
    {
      return $this->hasMany(Transaksi::class);
    }
}
