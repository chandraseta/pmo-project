<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelompokKompetensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelompok_kompetensi', function (Blueprint $table) {
            $table->increments('id_kelompok_kompetensi');
            $table->string('nama_kelompok_kompetensi')->nullable()->index();
        });

        Schema::table('pegawai', function (Blueprint $table) {
            $table->unsignedInteger('id_kelompok_kompetensi')->after('no_telp')->index();

            $table->foreign('id_kelompok_kompetensi')
                  ->references('id_kelompok_kompetensi')->on('kelompok_kompetensi')
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
        Schema::table('pegawai', function (Blueprint $table) {
            $table->dropForeign(['id_kelompok_kompetensi']);
            $table->dropIndex(['id_kelompok_kompetensi']);
            $table->dropColumn(['id_kelompok_kompetensi']);
        });

        Schema::dropIfExists('kelompok_kompetensi');
    }
}
