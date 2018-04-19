<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKompetensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kompetensi', function (Blueprint $table) {
            $table->increments('id_kompetensi');
            $table->unsignedInteger('id_pegawai')->index();
            $table->text('tujuan');
            $table->datetime('tanggal');
            
            $table->decimal('kognitif_efisiensi_kecerdasan', 3, 2);
            $table->decimal('kognitif_daya_nalar', 3, 2);
            $table->decimal('kognitif_daya_asosiasi', 3, 2);
            $table->decimal('kognitif_daya_analitis', 3, 2);
            $table->decimal('kognitif_daya_antisipasi', 3, 2);
            $table->decimal('kognitif_kemandirian_berpikir', 3, 2);
            $table->decimal('kognitif_fleksibilitas', 3, 2);
            $table->decimal('kognitif_daya_tangkap', 3, 2);
            $table->decimal('kognitif', 3, 2)->default(0);

            $table->decimal('interaksional_penempatan_diri', 3, 2);
            $table->decimal('interaksional_percaya_diri', 3, 2);
            $table->decimal('interaksional_daya_kooperatif', 3, 2);
            $table->decimal('interaksional_penyesuaian_perasaan', 3, 2);
            $table->decimal('interaksional', 3, 2)->default(0);

            $table->decimal('emosional_stabilitas_emosi', 3, 2);
            $table->decimal('emosional_toleransi_stres', 3, 2);
            $table->decimal('emosional_pengendalian_diri', 3, 2);
            $table->decimal('emosional_kemantapan_konsentrasi', 3, 2);
            $table->decimal('emosional', 3, 2)->default(0);

            $table->decimal('sikap_kerja_hasrat_berprestasi', 3, 2);
            $table->decimal('sikap_kerja_daya_tahan', 3, 2);
            $table->decimal('sikap_kerja_keteraturan_kerja', 3, 2);
            $table->decimal('sikap_kerja_pengerahan_energi_kerja', 3, 2);
            $table->decimal('sikap_kerja', 3, 2)->default(0);
            
            $table->decimal('manajerial_efektivitas_perencanaan', 3, 2);
            $table->decimal('manajerial_pengorganisasian_pelaksanaan', 3, 2);
            $table->decimal('manajerial_intensitas_pengarahan', 3, 2);
            $table->decimal('manajerial_kekuatan_pengawasan', 3, 2);
            $table->decimal('manajerial', 3, 2)->default(0);

            $table->decimal('profil_potensi_keberhasilan', 3, 2)->default(0);
            $table->decimal('profil_potensi_pengembangan_diri', 3, 2)->default(0);
            $table->decimal('profil_loyalitas_terhadap_tugas', 3, 2)->default(0);
            $table->decimal('profil_efektivitas_manajerial', 3, 2)->default(0);
            $table->decimal('profil', 3, 2)->default(0);

            $table->char('indeks', 1)->default('T');

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
        Schema::dropIfExists('kompetensi');
    }
}
