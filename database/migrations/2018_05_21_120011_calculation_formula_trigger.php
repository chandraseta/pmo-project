<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CalculationFormulaTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER tr_kompetensi_calculate_insert 
            BEFORE INSERT ON `kompetensi`
            FOR EACH ROW
            BEGIN
                DECLARE v_kognitif DECIMAL(3,2) DEFAULT 0.00;
                DECLARE v_interaksional DECIMAL(3,2) DEFAULT 0.00;
                DECLARE v_emosional DECIMAL(3,2) DEFAULT 0.00;
                DECLARE v_sikap_kerja DECIMAL(3,2) DEFAULT 0.00;
                DECLARE v_manajerial DECIMAL(3,2) DEFAULT 0.00;
                DECLARE v_profil_potensi_keberhasilan decimal(3,2) DEFAULT 0.00;
                DECLARE v_profil_potensi_pengembangan_diri decimal(3,2) DEFAULT 0.00;
                DECLARE v_profil_loyalitas_terhadap_tugas decimal(3,2) DEFAULT 0.00;
                DECLARE v_profil_efektivitas_manajerial decimal(3,2) DEFAULT 0.00;
                DECLARE v_profil decimal(3,2) DEFAULT 0.00;
                DECLARE v_indeks char(1) DEFAULT "T";

                SELECT (
                    NEW.kognitif_efisiensi_kecerdasan +
                    NEW.kognitif_daya_nalar +
                    NEW.kognitif_daya_asosiasi +
                    NEW.kognitif_daya_analitis +
                    NEW.kognitif_daya_antisipasi +
                    NEW.kognitif_kemandirian_berpikir +
                    NEW.kognitif_fleksibilitas +
                    NEW.kognitif_daya_tangkap) / 8
                INTO v_kognitif;

                SELECT (
                    NEW.interaksional_penempatan_diri +
                    NEW.interaksional_percaya_diri +
                    NEW.interaksional_daya_kooperatif +
                    NEW.interaksional_penyesuaian_perasaan) / 4
                INTO v_interaksional;

                SELECT (
                    NEW.emosional_stabilitas_emosi +
                    NEW.emosional_toleransi_stres +
                    NEW.emosional_pengendalian_diri +
                    NEW.emosional_kemantapan_konsentrasi) / 4
                INTO v_emosional;

                SELECT (
                    NEW.sikap_kerja_hasrat_berprestasi +
                    NEW.sikap_kerja_daya_tahan +
                    NEW.sikap_kerja_keteraturan_kerja +
                    NEW.sikap_kerja_pengerahan_energi_kerja) / 4
                INTO v_sikap_kerja;

                SELECT (
                    NEW.manajerial_efektivitas_perencanaan +
                    NEW.manajerial_pengorganisasian_pelaksanaan +
                    NEW.manajerial_intensitas_pengarahan +
                    NEW.manajerial_kekuatan_pengawasan) / 4
                INTO v_manajerial;

                SELECT (
                    v_kognitif * 2 +
                    v_emosional * 2 +
                    v_sikap_kerja) / 5
                INTO v_profil_potensi_keberhasilan;

                SELECT (
                    v_kognitif +
                    v_interaksional * 2 +
                    v_sikap_kerja * 2) / 5
                INTO v_profil_potensi_pengembangan_diri;

                SELECT (
                    v_kognitif +
                    v_emosional * 2 +
                    v_sikap_kerja * 2) / 5
                INTO v_profil_loyalitas_terhadap_tugas;

                SELECT (
                    v_kognitif +
                    v_emosional * 2 +
                    v_manajerial * 2) / 5
                INTO v_profil_efektivitas_manajerial;

                SELECT (
                    v_profil_potensi_keberhasilan +
                    v_profil_potensi_pengembangan_diri +
                    v_profil_loyalitas_terhadap_tugas +
                    v_profil_efektivitas_manajerial) / 4
                INTO v_profil;

                IF (v_profil BETWEEN 5 AND 6) THEN 
                    SELECT "A" INTO v_indeks;
                ELSEIF (v_profil BETWEEN 4 AND 5) THEN 
                    SELECT "B" INTO v_indeks;
                ELSEIF (v_profil BETWEEN 3 AND 4) THEN 
                    SELECT "C" INTO v_indeks;
                ELSEIF (v_profil BETWEEN 2 AND 3) THEN 
                    SELECT "D" INTO v_indeks;
                ELSEIF (v_profil BETWEEN 1 AND 2) THEN 
                    SELECT "E" INTO v_indeks;
                END IF;

                SET NEW.kognitif = v_kognitif;
                SET NEW.interaksional = v_interaksional; 
                SET NEW.emosional = v_emosional; 
                SET NEW.sikap_kerja = v_sikap_kerja; 
                SET NEW.manajerial = v_manajerial; 
                SET NEW.profil_potensi_keberhasilan = v_profil_potensi_keberhasilan;
                SET NEW.profil_potensi_pengembangan_diri = v_profil_potensi_pengembangan_diri;
                SET NEW.profil_loyalitas_terhadap_tugas = v_profil_loyalitas_terhadap_tugas;
                SET NEW.profil_efektivitas_manajerial = v_profil_efektivitas_manajerial;
                SET NEW.profil = v_profil;
                SET NEW.indeks = v_indeks;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER tr_kompetensi_calculate_update
            BEFORE UPDATE ON `kompetensi`
            FOR EACH ROW
            BEGIN
                DECLARE v_kognitif DECIMAL(3,2) DEFAULT 0.00;
                DECLARE v_interaksional DECIMAL(3,2) DEFAULT 0.00;
                DECLARE v_emosional DECIMAL(3,2) DEFAULT 0.00;
                DECLARE v_sikap_kerja DECIMAL(3,2) DEFAULT 0.00;
                DECLARE v_manajerial DECIMAL(3,2) DEFAULT 0.00;
                DECLARE v_profil_potensi_keberhasilan decimal(3,2) DEFAULT 0.00;
                DECLARE v_profil_potensi_pengembangan_diri decimal(3,2) DEFAULT 0.00;
                DECLARE v_profil_loyalitas_terhadap_tugas decimal(3,2) DEFAULT 0.00;
                DECLARE v_profil_efektivitas_manajerial decimal(3,2) DEFAULT 0.00;
                DECLARE v_profil decimal(3,2) DEFAULT 0.00;
                DECLARE v_indeks char(1) DEFAULT "T";

                SELECT (
                    NEW.kognitif_efisiensi_kecerdasan +
                    NEW.kognitif_daya_nalar +
                    NEW.kognitif_daya_asosiasi +
                    NEW.kognitif_daya_analitis +
                    NEW.kognitif_daya_antisipasi +
                    NEW.kognitif_kemandirian_berpikir +
                    NEW.kognitif_fleksibilitas +
                    NEW.kognitif_daya_tangkap) / 8
                INTO v_kognitif;

                SELECT (
                    NEW.interaksional_penempatan_diri +
                    NEW.interaksional_percaya_diri +
                    NEW.interaksional_daya_kooperatif +
                    NEW.interaksional_penyesuaian_perasaan) / 4
                INTO v_interaksional;

                SELECT (
                    NEW.emosional_stabilitas_emosi +
                    NEW.emosional_toleransi_stres +
                    NEW.emosional_pengendalian_diri +
                    NEW.emosional_kemantapan_konsentrasi) / 4
                INTO v_emosional;

                SELECT (
                    NEW.sikap_kerja_hasrat_berprestasi +
                    NEW.sikap_kerja_daya_tahan +
                    NEW.sikap_kerja_keteraturan_kerja +
                    NEW.sikap_kerja_pengerahan_energi_kerja) / 4
                INTO v_sikap_kerja;

                SELECT (
                    NEW.manajerial_efektivitas_perencanaan +
                    NEW.manajerial_pengorganisasian_pelaksanaan +
                    NEW.manajerial_intensitas_pengarahan +
                    NEW.manajerial_kekuatan_pengawasan) / 4
                INTO v_manajerial;

                SELECT (
                    v_kognitif * 2 +
                    v_emosional * 2 +
                    v_sikap_kerja) / 5
                INTO v_profil_potensi_keberhasilan;

                SELECT (
                    v_kognitif +
                    v_interaksional * 2 +
                    v_sikap_kerja * 2) / 5
                INTO v_profil_potensi_pengembangan_diri;

                SELECT (
                    v_kognitif +
                    v_emosional * 2 +
                    v_sikap_kerja * 2) / 5
                INTO v_profil_loyalitas_terhadap_tugas;

                SELECT (
                    v_kognitif +
                    v_emosional * 2 +
                    v_manajerial * 2) / 5
                INTO v_profil_efektivitas_manajerial;

                SELECT (
                    v_profil_potensi_keberhasilan +
                    v_profil_potensi_pengembangan_diri +
                    v_profil_loyalitas_terhadap_tugas +
                    v_profil_efektivitas_manajerial) / 4
                INTO v_profil;

                IF (v_profil BETWEEN 5 AND 6) THEN 
                    SELECT "A" INTO v_indeks;
                ELSEIF (v_profil BETWEEN 4 AND 5) THEN 
                    SELECT "B" INTO v_indeks;
                ELSEIF (v_profil BETWEEN 3 AND 4) THEN 
                    SELECT "C" INTO v_indeks;
                ELSEIF (v_profil BETWEEN 2 AND 3) THEN 
                    SELECT "D" INTO v_indeks;
                ELSEIF (v_profil BETWEEN 1 AND 2) THEN 
                    SELECT "E" INTO v_indeks;
                END IF;

                SET NEW.kognitif = v_kognitif;
                SET NEW.interaksional = v_interaksional; 
                SET NEW.emosional = v_emosional; 
                SET NEW.sikap_kerja = v_sikap_kerja; 
                SET NEW.manajerial = v_manajerial; 
                SET NEW.profil_potensi_keberhasilan = v_profil_potensi_keberhasilan;
                SET NEW.profil_potensi_pengembangan_diri = v_profil_potensi_pengembangan_diri;
                SET NEW.profil_loyalitas_terhadap_tugas = v_profil_loyalitas_terhadap_tugas;
                SET NEW.profil_efektivitas_manajerial = v_profil_efektivitas_manajerial;
                SET NEW.profil = v_profil;
                SET NEW.indeks = v_indeks;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_kompetensi_calculate_update`');
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_kompetensi_calculate_insert`');
    }
}
