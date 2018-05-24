<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSertifikatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sertifikat', function (Blueprint $table) {
            $table->increments('id_sertifikat');
            $table->unsignedInteger('id_pegawai')->index();
            $table->string('judul')->nullable();
            $table->string('lembaga')->nullable();
            $table->year('tahun_diterbitkan')->nullable();
            $table->text('catatan')->nullable();
            $table->string('nama_file')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('sertifikat');
    }
}
