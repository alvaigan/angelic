<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_transaksi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_pemesanan');
            $table->string('total_harga');
            $table->string('nama_lengkap');
            $table->string('email');
            $table->string('no_telp');
            $table->text('alamat');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('rtrw');
            $table->string('kode_pos');
            $table->string('status');
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
        Schema::dropIfExists('t_transaksi');
    }
}
