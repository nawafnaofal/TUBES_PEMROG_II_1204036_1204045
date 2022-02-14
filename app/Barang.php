<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    public function category()
    {
        return $this->hasOne('App\Category', 'categories_id', 'categories_id');
    }

    public function pesanan_detail()
    {
        return $this->hasMany('App\PesananDetail', 'barang_id', 'barang_id');
    }

    public $primaryKey = 'barang_id';

    protected $fillable = ['nama_barang', 'categories_id', 'harga', 'stok', 'keterangan'];
}
