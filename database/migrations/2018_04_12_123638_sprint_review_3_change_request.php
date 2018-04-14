<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SprintReview3ChangeRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->unsignedInteger('id_pengubah')->index();
            $table->timestamps();
        });

        Schema::table('pegawai', function (Blueprint $table) {
            $table->foreign('id_pengubah')
                  ->references('id_user')->on('pegawai')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        Schema::table('kinerja', function (Blueprint $table) {
            $table->dropColumn(['tanggal', 'laporan_kinerja']);

            $table->year('tahun');
            $table->boolean('semester');
            $table->decimal('nilai');
            $table->text('catatan')->nullable();
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
            $table->dropForeign(['id_pengubah']);
            $table->dropIndex(['id_pengubah']);
            $table->dropColumn(['id_pengubah']);
        });

        Schema::table('kinerja', function (Blueprint $table) {
            $table->dropColumn(['tahun', 'semester', 'nilai', 'catatan']);

            $table->datetime('tanggal');
            $table->longtext('laporan_kinerja')->json()->nullable();
        });
    }
}
