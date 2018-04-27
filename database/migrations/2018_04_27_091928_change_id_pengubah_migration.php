<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeIdPengubahMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->dropForeign(['id_pengubah']);

            $table->foreign('id_pengubah')
                  ->references('id')->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        Schema::table('denormalized_pegawai', function (Blueprint $table) {
            $table->dropForeign(['id_pengubah']);

            $table->foreign('id_pengubah')
                    ->references('id')->on('users')
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
            $table->dropForeign(['id_pengubah']);

            $table->foreign('id_pengubah')
                  ->references('id_user')->on('pegawai')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        Schema::table('denormalized_pegawai', function (Blueprint $table) {
            $table->dropForeign(['id_pengubah']);

            $table->foreign('id_pengubah')
                    ->references('id_user')->on('pegawai')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }
}
