<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function anggota()
    {
      return $this->hasOne(Anggota::class);
    }

    public function pegawai()
    {
      return $this->hasOne(Pegawai::class);
    }
    public function post()
    {
      return $this->hasMany(Post::class);
    }

    public function allowsConfig()
{
    return $this->role == 'admin' || $this->role == 'ptgs';
}
    public function allowsConfuse()
{
    return $this->role == 'user' || $this->role == 'ptgs';
}


    public function getAvauser()
    {
      if(!$this->anggota->avatar&&$this->anggota->jenis_kelamin=='L'){
        return asset('images/default.png');
      }
      elseif (!$this->anggota->avatar&&$this->anggota->jenis_kelamin=='P') {
        return asset('images/default1.png');
      }
      return asset('images/' .Auth::user()->anggota->avatar);
    }

    public function getAvaptgs()
    {
      if(!$this->pegawai->avatar&&$this->pegawai->jenis_kelamin=='L'){
        return asset('images/default.png');
      }
      elseif (!$this->pegawai->avatar&&$this->pegawai->jenis_kelamin=='P') {
        return asset('images/default1.png');
      }
      return asset('images/' .Auth::user()->pegawai->avatar);
    }
}
