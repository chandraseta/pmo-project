<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTrainingUnitKerjaPosisiTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_kerja', function (Blueprint $table) {
            $table->increments('id_unit_kerja');
            $table->string('nama_unit_kerja')->index();
        });

        Schema::table('posisi', function (Blueprint $table) {
            $table->dropColumn(['kompetensi', 'unit_kerja', 'kinerja']);
        });

        Schema::table('training', function (Blueprint $table) {
            $table->dropColumn(['penyelenggara', 'bidang']);
        });

        Schema::table('rekomendasi_posisi', function (Blueprint $table) {
            $table->unsignedInteger('id_unit_kerja')->after('id_pegawai')->index();

            $table->foreign('id_unit_kerja')
                  ->references('id_unit_kerja')->on('unit_kerja')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        Schema::table('data_kepegawaian', function (Blueprint $table) {
            $table->dropColumn(['kompetensi', 'unit_kerja', 'posisi']);

            $table->unsignedInteger('id_unit_kerja')->after('id_pegawai')->index();
            $table->unsignedInteger('id_posisi')->after('id_unit_kerja')->index();

            $table->foreign('id_unit_kerja')
                  ->references('id_unit_kerja')->on('unit_kerja')
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
        Schema::table('data_kepegawaian', function (Blueprint $table) {
            $table->dropForeign(['id_unit_kerja']);
            $table->dropForeign(['id_posisi']);
            $table->dropIndex(['id_unit_kerja']);
            $table->dropIndex(['id_posisi']);
            $table->dropColumn(['id_unit_kerja']);
            $table->dropColumn(['id_posisi']);

            $table->string('kompetensi')->index();
            $table->string('unit_kerja')->index();
            $table->string('posisi');
        });
        
        Schema::table('rekomendasi_posisi', function (Blueprint $table) {
            $table->dropForeign(['id_unit_kerja']);
            $table->dropIndex(['id_unit_kerja']);
            $table->dropColumn(['id_unit_kerja']);
        });
        
        Schema::table('training', function (Blueprint $table) {
            $table->string('penyelenggara');
            $table->string('bidang')->index();
        });

        Schema::table('posisi', function (Blueprint $table) {
            $table->string('kompetensi');
            $table->string('unit_kerja');
            $table->longtext('kinerja')->json()->nullable();
        });

        Schema::dropIfExists('unit_kerja');
    }
}
