<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training', function (Blueprint $table) {
            $table->increments('id_training');
            $table->string('nama_training')->index();
            $table->string('penyelenggara');
            $table->string('bidang')->index();
        });

        Schema::create('rekomendasi_training', function (Blueprint $table) {
            $table->increments('id_rekomendasi_training');
            $table->unsignedInteger('id_pegawai')->index();
            $table->unsignedInteger('id_training')->index();

            $table->foreign('id_pegawai')
                  ->references('id_user')->on('pegawai')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('id_training')
                  ->references('id_training')->on('training')
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
        Schema::dropIfExists('rekomendasi_training');
        Schema::dropIfExists('training');
    }
}
