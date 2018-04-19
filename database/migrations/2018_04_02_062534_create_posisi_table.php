<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posisi', function (Blueprint $table) {
            $table->increments('id_posisi');
            $table->string('nama_posisi')->index();
            $table->string('kompetensi');
            $table->string('unit_kerja');
            $table->longtext('kinerja')->json()->nullable();
        });

        Schema::create('rekomendasi_posisi', function (Blueprint $table) {
            $table->increments('id_rekomendasi_posisi');
            $table->unsignedInteger('id_pegawai')->index();
            $table->unsignedInteger('id_posisi')->index();

            $table->foreign('id_pegawai')
                  ->references('id_user')->on('pegawai')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('id_posisi')
                  ->references('id_posisi')->on('posisi')
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
        Schema::dropIfExists('rekomendasi_posisi');
        Schema::dropIfExists('posisi');
    }
}
