<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{
    public function barang()
    {
        return $this->hasOne('App\Barang', 'barang_id', 'barang_id');
    }

    public function pesanan()
    {
        return $this->belongsTo('App\Pesanan', 'user_id', 'detail_id');
    }

    public $primaryKey = 'detail_id';
}
