<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteUrlOnBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('t_produk', function ($table) {
        $table->dropColumn('url_shopee');
        $table->dropColumn('url_tokped');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_produk', function ($table) {
        $table->text('url_shopee');
        $table->text('url_tokped');
      });
    }
}
