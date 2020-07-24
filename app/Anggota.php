<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
  protected $fillable =[
    'id_anggota',
    'user_id',
    'nama',
    'agama',
    'jenis_kelamin',
    'tempat_lahir',
    'tgl_lahir',
    'alamat',
    'no_hp',
    'avatar',
  ];

  public function user()
    {
      return $this->belongsTo(User::class);
    }

  public function transaksi()
  {
    return $this->hasMany(Transaksi::class);
  }
  public function getAvatar()
  {
    if(!$this->avatar&&$this->jenis_kelamin=='L'){
      return url('images/default.png');
    }
    elseif (!$this->avatar&&$this->jenis_kelamin=='P') {
      return url('images/default1.png');
    }
    return url('images/' .$this->avatar);
  }

}
