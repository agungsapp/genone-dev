<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model implements AuthenticatableContract
{
  use Authenticatable;

  protected $table = 'sales';
  public $timestamps = false;
  protected $fillable = [
    'nama',
    'nip',
    'username',
    'password',
    'status_online',
    'id_dealer',
    'path_image',
    'nomor',
    'slogan',
    'urutan',
    'id_jabatan',
    'active',
  ];

  public function penjualan()
  {
    return $this->hasMany(Penjualan::class, 'id_motor');
  }

  public function dealer()
  {
    return $this->belongsTo(Dealer::class, 'id_dealer');
  }

  public function jabatan()
  {
    return $this->belongsTo(JabatanModel::class, 'id_jabatan', 'id');
  }
}
