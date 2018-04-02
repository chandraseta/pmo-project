<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConvertToJsonDatatype extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posisi', function (Blueprint $table) {
            $table->longtext('kinerja')->json()->change();
            $table->json('kinerja')->change();
        });

        Schema::table('kinerja', function (Blueprint $table) {
            $table->longtext('laporan_kinerja')->json()->change();
            $table->json('laporan_kinerja')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posisi', function (Blueprint $table) {
            $table->string('kinerja')->change();
        });
        
        Schema::table('kinerja', function (Blueprint $table) {
            $table->longtext('laporan_kinerja')->change();
        });
    }
}
