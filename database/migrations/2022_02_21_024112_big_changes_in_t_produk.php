<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BigChangesInTProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_produk', function (Blueprint $table) {
            $table->dropColumn('stok');
            $table->dropColumn('tags');
            $table->renameColumn('harga', 'harga_asli');
            $table->integer('harga_coret');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_produk', function (Blueprint $table) {
            $table->dropColumn('harga_coret');
            $table->renameColumn('harga_asli', 'harga');
            $table->string('tags');
            $table->integer('stok');
        });
    }
}
