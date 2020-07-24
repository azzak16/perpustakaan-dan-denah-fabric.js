<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rak extends Model
{
  protected $fillable =[

    'rak',
    ];

    public function buku()
    {
      return $this->hasMany(Buku::class);
    }
}
