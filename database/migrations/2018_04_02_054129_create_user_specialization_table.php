<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSpecializationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmo', function (Blueprint $table) {
            $table->unsignedInteger('id_user')->primary();

            $table->foreign('id_user')
                  ->references('id')->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        Schema::create('admin', function (Blueprint $table) {
            $table->unsignedInteger('id_user')->primary();

            $table->foreign('id_user')
                  ->references('id')->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        Schema::create('pegawai', function (Blueprint $table) {
            $table->unsignedInteger('id_user')->primary();
            $table->string('nama');
            $table->char('nip', 18)->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');

            $table->foreign('id_user')
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
        Schema::dropIfExists('pmo');
        Schema::dropIfExists('admin');
        Schema::dropIfExists('pegawai');
    }
}
