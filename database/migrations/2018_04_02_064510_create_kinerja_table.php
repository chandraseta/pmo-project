<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKinerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kinerja', function (Blueprint $table) {
            $table->increments('id_kinerja');
            $table->unsignedInteger('id_pegawai')->index();
            $table->datetime('tanggal');
            // $table->json('laporan_kinerja');
            $table->longtext('laporan_kinerja');

            $table->foreign('id_pegawai')
                  ->references('id_user')->on('pegawai')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kinerja');
    }
}
