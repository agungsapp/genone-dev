<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeasingMotor extends Model
{
  protected $table = 'leasing_motor';
  public $timestamps = false;
  protected $fillable = [
    'nama',
    'gambar'
  ];

  public function penjualan()
  {
    return $this->hasMany(Penjualan::class, 'id_leasing');
  }
}
