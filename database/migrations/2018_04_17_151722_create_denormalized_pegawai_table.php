<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDenormalizedPegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('denormalized_pegawai')) {
            Schema::create('denormalized_pegawai', function (Blueprint $table) {
                $table->unsignedInteger('id_user')->primary();
                $table->string('nama')->index();
                $table->char('nip', 18)->unique();
                $table->string('tempat_lahir')->nullable();
                $table->date('tanggal_lahir')->nullable();
                $table->string('no_telp')->nullable();
                $table->unsignedInteger('id_pengubah')->nullable()->index();
    
                $table->string('kelompok_kompetensi')->nullable();
                $table->string('unit_kerja')->nullable();
                $table->string('posisi')->nullable();
                $table->string('tahun_masuk_kerja')->nullable();;
                $table->string('pendidikan_terakhir')->nullable();;
    
                $table->foreign('id_user')
                      ->references('id')->on('users')
                      ->onDelete('cascade')
                      ->onUpdate('cascade');
                $table->foreign('id_pengubah')
                      ->references('id_user')->on('pegawai')
                      ->onDelete('cascade')
                      ->onUpdate('cascade');
            });
        }

        DB::unprepared('
            CREATE TRIGGER tr_pegawai_denomarlize_insert
            AFTER INSERT ON `pegawai`
            FOR EACH ROW
            BEGIN
                INSERT INTO `denormalized_pegawai` (id_user, nama, nip, tempat_lahir, tanggal_lahir, no_telp, id_pengubah) 
                VALUES (NEW.id_user, NEW.nama, NEW.nip, NEW.tempat_lahir, NEW.tanggal_lahir, NEW.no_telp, NEW.id_pengubah);

                IF (NEW.id_kelompok_kompetensi IS NOT NULL) THEN 
                    UPDATE denormalized_pegawai 
                    SET denormalized_pegawai.kelompok_kompetensi = (
                        SELECT nama_kelompok_kompetensi 
                        FROM kelompok_kompetensi 
                        WHERE kelompok_kompetensi.id_kelompok_kompetensi = NEW.id_kelompok_kompetensi
                    ) 
                    WHERE denormalized_pegawai.id_user = NEW.id_user;
                END IF;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER tr_pegawai_denomarlize_update
            AFTER UPDATE ON `pegawai`
            FOR EACH ROW
            BEGIN
                IF (NEW.updated_at <> OLD.updated_at) THEN 
                    UPDATE denormalized_pegawai 
                    SET denormalized_pegawai.nama = NEW.nama, 
                        denormalized_pegawai.nip = NEW.nip, 
                        denormalized_pegawai.tempat_lahir = NEW.tempat_lahir, 
                        denormalized_pegawai.tanggal_lahir = NEW.tanggal_lahir, 
                        denormalized_pegawai.no_telp = NEW.no_telp, 
                        denormalized_pegawai.id_pengubah = NEW.id_pengubah 
                    WHERE denormalized_pegawai.id_user = NEW.id_user;

                    IF (NEW.id_kelompok_kompetensi IS NOT NULL) THEN 
                        UPDATE denormalized_pegawai 
                        SET denormalized_pegawai.kelompok_kompetensi = (
                            SELECT nama_kelompok_kompetensi 
                            FROM kelompok_kompetensi 
                            WHERE kelompok_kompetensi.id_kelompok_kompetensi = NEW.id_kelompok_kompetensi
                        ) 
                        WHERE denormalized_pegawai.id_user = NEW.id_user;
                    END IF;
                END IF;
            END
        ');

        DB::unprepared('
            CREATE PROCEDURE proc_data_kepegawaian_denormalize (IN in_id_pegawai int(10))
            BEGIN
                DECLARE v_unit_kerja VARCHAR(191);
                DECLARE v_posisi VARCHAR(191);
                DECLARE v_tahun_masuk VARCHAR(191);

                WITH latest_data_kepegawaian AS (
                    SELECT * 
                    FROM data_kepegawaian 
                    WHERE data_kepegawaian.id_pegawai = in_id_pegawai 
                    ORDER BY CASE 
                        WHEN tahun_keluar IS NULL 
                            THEN 1 
                            ELSE 0 
                        END DESC, 
                        tahun_masuk DESC 
                    LIMIT 1
                ) 
                SELECT tahun_masuk, nama_unit_kerja, nama_posisi 
                INTO v_tahun_masuk, v_unit_kerja, v_posisi 
                FROM latest_data_kepegawaian 
                    NATURAL JOIN unit_kerja 
                    NATURAL JOIN posisi;

                UPDATE denormalized_pegawai 
                SET denormalized_pegawai.unit_kerja = v_unit_kerja, 
                    denormalized_pegawai.posisi = v_posisi, 
                    denormalized_pegawai.tahun_masuk_kerja = v_tahun_masuk 
                WHERE denormalized_pegawai.id_user = in_id_pegawai;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER tr_data_kepegawaian_denomarlize_insert
            AFTER INSERT ON `data_kepegawaian`
            FOR EACH ROW
            BEGIN
                CALL proc_data_kepegawaian_denormalize(NEW.id_pegawai);
            END
        ');

        DB::unprepared('
            CREATE TRIGGER tr_data_kepegawaian_denomarlize_update
            AFTER UPDATE ON `data_kepegawaian`
            FOR EACH ROW
            BEGIN
                CALL proc_data_kepegawaian_denormalize(NEW.id_pegawai);
            END
        ');

        DB::unprepared('
            CREATE TRIGGER tr_data_kepegawaian_denomarlize_delete
            AFTER DELETE ON `data_kepegawaian`
            FOR EACH ROW
            BEGIN
                DECLARE v_count INT DEFAULT 0;

                SELECT count(*) 
                INTO v_count 
                FROM data_kepegawaian 
                WHERE data_kepegawaian.id_pegawai = OLD.id_pegawai;
                
                IF (v_count <> 0) THEN
                    CALL proc_data_kepegawaian_denormalize(OLD.id_pegawai);
                ELSE
                    UPDATE denormalized_pegawai 
                    SET denormalized_pegawai.unit_kerja = NULL, 
                        denormalized_pegawai.posisi = NULL, 
                        denormalized_pegawai.tahun_masuk_kerja = NULL 
                    WHERE denormalized_pegawai.id_user = OLD.id_pegawai;
                END IF;
            END
        ');

        DB::unprepared('
            CREATE PROCEDURE proc_riwayat_pendidikan_denormalize (IN in_id_pegawai int(10))
            BEGIN
                DECLARE v_strata VARCHAR(191);

                SELECT strata 
                INTO v_strata 
                FROM riwayat_pendidikan 
                WHERE riwayat_pendidikan.id_pegawai = in_id_pegawai 
                ORDER BY CASE 
                    WHEN tahun_keluar IS NULL 
                        THEN 1 
                        ELSE 0 
                    END DESC, 
                    tahun_masuk DESC 
                LIMIT 1;
                
                UPDATE denormalized_pegawai 
                SET denormalized_pegawai.pendidikan_terakhir = v_strata
                WHERE denormalized_pegawai.id_user = in_id_pegawai;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER tr_riwayat_pendidikan_denomarlize_insert
            AFTER INSERT ON `riwayat_pendidikan`
            FOR EACH ROW
            BEGIN
                CALL proc_riwayat_pendidikan_denormalize(NEW.id_pegawai);
            END
        ');

        DB::unprepared('
            CREATE TRIGGER tr_riwayat_pendidikan_denomarlize_update
            AFTER UPDATE ON `riwayat_pendidikan`
            FOR EACH ROW
            BEGIN
                CALL proc_riwayat_pendidikan_denormalize(NEW.id_pegawai);
            END
        ');

        DB::unprepared('
            CREATE TRIGGER tr_riwayat_pendidikan_denomarlize_delete
            AFTER DELETE ON `riwayat_pendidikan`
            FOR EACH ROW
            BEGIN
                DECLARE v_count INT DEFAULT 0;

                SELECT count(*) 
                INTO v_count 
                FROM riwayat_pendidikan 
                WHERE riwayat_pendidikan.id_pegawai = OLD.id_pegawai;
                
                IF (v_count <> 0) THEN
                    CALL proc_riwayat_pendidikan_denormalize(OLD.id_pegawai);
                ELSE
                    UPDATE riwayat_pendidikan 
                    SET riwayat_pendidikan.pendidikan_terakhir = NULL 
                    WHERE denormalized_pegawai.id_user = OLD.id_pegawai;
                END IF;
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
        DB::unprepared('DROP TRIGGER `tr_riwayat_pendidikan_denomarlize_delete`');
        DB::unprepared('DROP TRIGGER `tr_riwayat_pendidikan_denomarlize_update`');
        DB::unprepared('DROP TRIGGER `tr_riwayat_pendidikan_denomarlize_insert`');
        DB::unprepared('DROP PROCEDURE `proc_riwayat_pendidikan_denormalize`');
        DB::unprepared('DROP TRIGGER `tr_data_kepegawaian_denomarlize_delete`');
        DB::unprepared('DROP TRIGGER `tr_data_kepegawaian_denomarlize_update`');
        DB::unprepared('DROP TRIGGER `tr_data_kepegawaian_denomarlize_insert`');
        DB::unprepared('DROP PROCEDURE `proc_data_kepegawaian_denormalize`');
        DB::unprepared('DROP TRIGGER `tr_pegawai_denomarlize_update`');
        DB::unprepared('DROP TRIGGER `tr_pegawai_denomarlize_insert`');
        
        // Schema::dropIfExists('denormalized_pegawai');
    }
}
