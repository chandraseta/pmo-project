<template>
    <div>
        <header>
            <pmo-navbar v-on:navigation="changeTable"></pmo-navbar>
        </header>
        <main role="main" class="container">
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 p-2">
                            <button type="button"
                                    class="btn btn-primary m-1"
                                    data-toggle="modal"
                                    data-target="#addDataModal">
                                Tambah Data
                            </button>
                        </div>
                        <div class="col-md-3 p-2"></div>
                        <div class="col-md-3 p-2"></div>
                        <div class="col-md-3 p-2">
                            <button type="button" class="btn btn-outline-primary float-md-right m-1">
                                Download
                            </button>
                            <button type="button" class="btn btn-outline-primary float-md-right m-1">
                                Upload
                            </button>
                        </div>
                    </div>
                </div>
            </section>
            <data-table :tableTitle="title"
                        :columns="columns"
                        :rows="rows">
            </data-table>
        </main>
        <footer>

        </footer>
        <!--Modals-->
        <div class="modal fade" id="addDataModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDataModalLabel">Entri {{ title }} Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group" v-for="column in columns" v-if="column.label != ''">
                                <label :for="column.field">{{ column.label }}</label>
                                <input class="form-control"
                                       :type="column.type == 'number' || 'date' ? column.type : 'text'"
                                       :id="column.field" :placeholder="column.label">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'pmo-main-page',
        components: {
            'pmo-navbar': require('./Navbar.vue'),
            'data-table': require('./DataTable.vue'),
        },
        data() {
            return {
                title: 'Data Pegawai',
                columns: [],
                dataPegawaiColumns:[
                    {
                        label: 'NIP',
                        field: 'nip',
                        immutable: true
                    },
                    {
                        label: 'Nama Lengkap',
                        field: 'nama',
                        immutable: true
                    },
                    {
                        label: 'Unit Kerja',
                        field: 'unit'
                    },
                    {
                        label: 'Jabatan',
                        field: 'position'
                    },
                    {
                        label: 'Tahun Menjabat',
                        field: 'startYear',
                        type: 'number'
                    },
                    {
                        label: 'Kelompok Kompetensi',
                        field: 'competencyGroup'
                    },
                    {
                        label: 'No. Telp.',
                        field: 'phone'
                    },
                    {
                        label: 'Pendidikan',
                        field: 'education'
                    },
                    {
                        label: 'Tanggal Lahir',
                        field: 'tanggal_lahir',
                        type: 'date',
                        dateInputFormat: 'YYYY-MM-DD',
                        dateOutputFormat: 'DD-MM-YYYY',
                        immutable: true
                    },
                ],
                dataKompetensiColumns:[
//                    Data Pegawai
                    {
                        label: 'Nama Lengkap',
                        field: 'nama'
                    },
                    {
                        label: 'NIP',
                        field: 'nip',
                    },
                    {
                        label: 'Unit Kerja',
                        field: 'unit'
                    },
                    {
                        label: 'Tingkat Pendidikan',
                        field: 'pendidikan_terakhir'
                    },
                    {
                        label: 'Tanggal Lahir',
                        field: 'tanggal_lahir'
                    },
                    {
                        label: 'Jabatan',
                        field: 'jabatan'
                    },
                    {
                        label: 'Tujuan Pemeriksaan',
                        field: 'tujuan_pemeriksaan'
                    },
                    {
                        label: 'Tanggal Pelaksanaan',
                        field: 'tanggal',
                        type: 'date',
                        dateInputFormat: 'YYYY-MM-DD',
                        dateOutputFormat: 'DD-MM-YYYY'
                    },
//                    Fungsi Kognitif
                    {
                        label: 'Efisiensi Kecerdasan',
                        field: 'kognitif_efisiensi_kecerdasan',
                        type: 'number',
                        thClass: 'text-center fungsi-kognitif-group'
                    },
                    {
                        label: 'Daya Nalar',
                        field: 'kognitif_daya_nalar',
                        type: 'number',
                        thClass: 'text-center fungsi-kognitif-group'
                    },
                    {
                        label: 'Daya Asosiasi',
                        field: 'kognitif_daya_asosiasi',
                        type: 'number',
                        thClass: 'text-center fungsi-kognitif-group'
                    },
                    {
                        label: 'Daya Analitis',
                        field: 'kognitif_daya_analitis',
                        type: 'number',
                        thClass: 'text-center fungsi-kognitif-group'
                    },
                    {
                        label: 'Daya Antisipasi',
                        field: 'kognitif_daya_antisipasi',
                        type: 'number',
                        thClass: 'text-center fungsi-kognitif-group'
                    },
                    {
                        label: 'Kemandirian Berpikir',
                        field: 'kognitif_kemandirian_berpikir',
                        type: 'number',
                        thClass: 'text-center fungsi-kognitif-group'
                    },
                    {
                        label: 'Fleksibilitas',
                        field: 'kognitif_fleksibilitas',
                        type: 'number',
                        thClass: 'text-center fungsi-kognitif-group'
                    },
                    {
                        label: 'Daya Tangkap',
                        field: 'kognitif_daya_tangkap',
                        type: 'number',
                        thClass: 'text-center fungsi-kognitif-group'
                    },
                    {
                        label: 'Rata-rata Kognitif',
                        field: 'kognitif',
                        type: 'decimal',
                        thClass: 'text-center fungsi-kognitif-group'
                    },
//                    Fungsi Interaksional
                    {
                        label: 'Penempatan Diri',
                        field: 'interaksional_penempatan_diri',
                        type: 'number',
                        thClass: 'text-center fungsi-interaksional-group'
                    },
                    {
                        label: 'Percaya Diri',
                        field: 'interaksional_percaya_diri',
                        type: 'number',
                        thClass: 'text-center fungsi-interaksional-group'
                    },
                    {
                        label: 'Daya Kooperatif',
                        field: 'interaksional_daya_kooperatif',
                        type: 'number',
                        thClass: 'text-center fungsi-interaksional-group'
                    },
                    {
                        label: 'Penyesuaian Perasaan',
                        field: 'interaksional_penyesuaian_perasaan',
                        type: 'number',
                        thClass: 'text-center fungsi-interaksional-group'
                    },
                    {
                        label: 'Penyesuaian Perasaan',
                        field: 'interaksional',
                        type: 'decimal',
                        thClass: 'text-center fungsi-interaksional-group'
                    },
//                    Fungsi Emosional
                    {
                        label: 'Stabilitas Emosi',
                        field: 'emosional_stabilitas_emosi',
                        type: 'number',
                        thClass: 'text-center fungsi-emosional-group'
                    },
                    {
                        label: 'Toleransi terhadap Stress',
                        field: 'emosional_toleransi_stres',
                        type: 'number',
                        thClass: 'text-center fungsi-emosional-group'
                    },
                    {
                        label: 'Pengendalian Diri',
                        field: 'emosional_pengendalian_diri',
                        type: 'number',
                        thClass: 'text-center fungsi-emosional-group'
                    },
                    {
                        label: 'Kemantapan Konsentrasi',
                        field: 'emosional_kemantapan_konsentrasi',
                        type: 'number',
                        thClass: 'text-center fungsi-emosional-group'
                    },
                    {
                        label: 'Rata-rata Emosional',
                        field: 'emosional_kemantapan_konsentrasi',
                        type: 'decimal',
                        thClass: 'text-center fungsi-emosional-group'
                    },
//                    Fungsi Sikap Kerja
                    {
                        label: 'Hasrat Berprestasi',
                        field: 'sikap_kerja_hasrat_berprestasi',
                        type: 'number',
                        thClass: 'text-center fungsi-sikap-kerja-group'
                    },
                    {
                        label: 'Daya Tahan',
                        field: 'sikap_kerja_daya_tahan',
                        type: 'number',
                        thClass: 'text-center fungsi-sikap-kerja-group'
                    },
                    {
                        label: 'Keteraturan Kerja',
                        field: 'sikap_kerja_keteraturan_kerja',
                        type: 'number',
                        thClass: 'text-center fungsi-sikap-kerja-group'
                    },
                    {
                        label: 'Pengerahan Energi Kerja',
                        field: 'sikap_kerja_pengerahan_energi_kerja',
                        type: 'number',
                        thClass: 'text-center fungsi-sikap-kerja-group'
                    },
                    {
                        label: 'Rata-rata Sikap Kerja',
                        field: 'sikap_kerja',
                        type: 'decimal',
                        thClass: 'text-center fungsi-sikap-kerja-group'
                    },
//                    Fungsi Manajerial
                    {
                        label: 'Efektivitas Perencanaan',
                        field: 'manajerial_efektivitas_perencanaan',
                        type: 'number',
                        thClass: 'text-center fungsi-manajerial-group'
                    },
                    {
                        label: 'Pengorganisasian Pelaksanaan',
                        field: 'manajerial_pengorganisasian_pelaksanaan',
                        type: 'number',
                        thClass: 'text-center fungsi-manajerial-group'
                    },
                    {
                        label: 'Intensitas Pengarahan',
                        field: 'manajerial_intensitas_pengarahan',
                        type: 'number',
                        thClass: 'text-center fungsi-manajerial-group'
                    },
                    {
                        label: 'Kekuatan Pengawasan',
                        field: 'manajerial_kekuatan_pengawasan',
                        type: 'number',
                        thClass: 'text-center fungsi-manajerial-group'
                    },
                    {
                        label: 'Rata-rata Manajerial',
                        field: 'manajerial',
                        type: 'decimal',
                        thClass: 'text-center fungsi-manajerial-group'
                    },
                    // Summary
                    {
                        label: 'Potensi Keberhasilan',
                        field: 'profil_potensi_keberhasilan',
                        type: 'decimal',
                        thClass: 'text-center'
                    },
                    {
                        label: 'Potensi Pengembangan Diri',
                        field: 'profil_potensi_pengembangan_diri',
                        type: 'decimal',
                        thClass: 'text-center'
                    },
                    {
                        label: 'Loyalitas Terhadap Tugas',
                        field: 'profil_loyalitas_terhadap_tugas',
                        type: 'decimal',
                        thClass: 'text-center'
                    },
                    {
                        label: 'Efektivitas Manajerial',
                        field: 'profil_efektivitas_manajerial',
                        type: 'decimal',
                        thClass: 'text-center'
                    },
                    {
                        label: 'Nilai Prediksi',
                        field: 'profil',
                        type: 'decimal',
                        thClass: 'text-center'
                    },
                    {
                        label: 'Rekomendasi',
                        field: 'indeks',
                        thClass: 'text-center'
                    },
                    {
                        label: '',
                        field: 'editButton'
                    }
                ],
                dataKinerjaColumns:[],
                rows: [],
                dataPegawai: [],
                dataKinerja: [],
                dataKompetensi: [],
            }
        },
        methods: {
            changeTable: function (payload) {
                this.title = payload.label;
                this.rows = this[payload.name];
                this.columns = this[payload.name + 'Columns']
            }
        },
        created: function () {
            this.rows = this.dataPegawai;
            this.columns = this.dataPegawaiColumns;

            axios.get('/api/pegawai')
                .then(response => {
                    this.dataPegawai = response.data.data;
                })
                .catch(e => {
                    this.errors.push(e);
                });

            axios.get('/api/kompetensi')
                .then(response => {
                    this.dataKompetensi = response.data.data;
                })
                .catch(e => {
                    this.errors.push(e);
                });
        }
    }
</script>

<style>

</style>