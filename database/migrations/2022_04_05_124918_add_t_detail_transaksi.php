<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTDetailTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_detail_transaksi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_transaksi');
            $table->integer('id_produk');
            $table->integer('id_ukuran');
            $table->integer('qty');
            $table->integer('subtotal_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_detail_transaksi');
    }
}
