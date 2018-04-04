<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiwayatPegawaiTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_pekerjaan', function (Blueprint $table) {
            $table->increments('id_riwayat_pekerjaan');
            $table->unsignedInteger('id_pegawai')->index();
            $table->string('nama_institusi')->index();
            $table->string('posisi');
            $table->year('tahun_masuk');
            $table->year('tahun_keluar');

            $table->foreign('id_pegawai')
                  ->references('id_user')->on('pegawai')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        Schema::create('riwayat_pendidikan', function (Blueprint $table) {
            $table->increments('id_riwayat_pendidikan');
            $table->unsignedInteger('id_pegawai')->index();
            $table->string('nama_institusi')->index();
            $table->string('strata')->index();
            $table->string('jurusan');
            $table->year('tahun_masuk');
            $table->year('tahun_keluar');

            $table->foreign('id_pegawai')
                  ->references('id_user')->on('pegawai')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        Schema::create('data_kepegawaian', function (Blueprint $table) {
            $table->increments('id_data_kepegawaian');
            $table->unsignedInteger('id_pegawai')->index();
            $table->string('kompetensi')->index();
            $table->string('unit_kerja')->index();
            $table->string('posisi');
            $table->year('tahun_masuk');
            $table->year('tahun_keluar');

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
        Schema::dropIfExists('riwayat_pekerjaan');
        Schema::dropIfExists('riwayat_pendidikan');
        Schema::dropIfExists('data_kepegawaian');
    }
}
