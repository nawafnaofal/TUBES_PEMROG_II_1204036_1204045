<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function barang()
    {
        return $this->hasMany('App\Barang', 'categories_id', 'categories_id');
    }

    public $primaryKey = 'categories_id';

    protected $fillable = ['nama'];
}
