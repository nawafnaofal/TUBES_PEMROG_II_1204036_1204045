<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesananDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan_details', function (Blueprint $table) {
            $table->bigIncrements('detail_id');
            $table->bigInteger('barang_id');
            $table->bigInteger('pesanan_id')->unsigned();
            $table->integer('jumlah');
            $table->integer('jumlah_harga');
            $table->timestamps();

            $table->foreign('pesanan_id')->references('pesanan_id')->on('pesanans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan_details');
    }
}
