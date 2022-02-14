<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->bigIncrements('barang_id');
            $table->bigInteger('categories_id')->unsigned();
            $table->string('nama_barang');
            $table->string('gambar');
            $table->integer('harga');
            $table->integer('stok');
            $table->string('keterangan');
            $table->timestamps();

            $table->foreign('categories_id')->references('categories_id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangs');
    }
}
