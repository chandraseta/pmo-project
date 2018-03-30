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
                            <button type="button" class="btn btn-primary m-1">Add Data</button>
                        </div>
                        <div class="col-md-3 p-2"></div>
                        <div class="col-md-3 p-2"></div>
                        <div class="col-md-3 p-2">
                            <button type="button" class="btn btn-outline-primary float-md-right m-1">Download</button>
                            <button type="button" class="btn btn-outline-primary float-md-right m-1">Upload</button>
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
                    },
                    {
                        label: 'Nama Lengkap',
                        field: 'name'
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
                        field: 'birthday'
                    },
                ],
                dataKompetensiColumns:[
//                    Data Pegawai
                    {
                        label: 'NIP',
                        field: 'nip',
                    },
                    {
                        label: 'Nama Lengkap',
                        field: 'name'
                    },
                    {
                        label: 'Unit Kerja',
                        field: 'unit'
                    },
//                    Fungsi Kognitif
                    {
                        label: 'Efisiensi Kecerdasan',
                        field: 'efisiensiKecerdasan',
                        type: 'number',
                        thClass: 'text-center fungsi-kognitif-group'
                    },
                    {
                        label: 'Daya Nalar',
                        field: 'dayaNalar',
                        type: 'number',
                        thClass: 'text-center fungsi-kognitif-group'
                    },
                    {
                        label: 'Daya Asosiasi',
                        field: 'dayaAsosiasi',
                        type: 'number',
                        thClass: 'text-center fungsi-kognitif-group'
                    },
                    {
                        label: 'Daya Analitis',
                        field: 'dayaAnalitis',
                        type: 'number',
                        thClass: 'text-center fungsi-kognitif-group'
                    },
                    {
                        label: 'Daya Antisipasi',
                        field: 'dayaAntisipasi',
                        type: 'number',
                        thClass: 'text-center fungsi-kognitif-group'
                    },
                    {
                        label: 'Kemandirian Berpikir',
                        field: 'kemandirianBerpikir',
                        type: 'number',
                        thClass: 'text-center fungsi-kognitif-group'
                    },
                    {
                        label: 'Fleksibilitas',
                        field: 'fleksibilitas',
                        type: 'number',
                        thClass: 'text-center fungsi-kognitif-group'
                    },
                    {
                        label: 'Daya Tangkap',
                        field: 'dayaTangkap',
                        type: 'number',
                        thClass: 'text-center fungsi-kognitif-group'
                    },
//                    Fungsi Interaksional
                    {
                        label: 'Penempatan Diri',
                        field: 'penempatanDiri',
                        type: 'number',
                        thClass: 'text-center fungsi-interaksional-group'
                    },
                    {
                        label: 'Percaya Diri',
                        field: 'percayaDiri',
                        type: 'number',
                        thClass: 'text-center fungsi-interaksional-group'
                    },
                    {
                        label: 'Daya Kooperatif',
                        field: 'dayaKooperatif',
                        type: 'number',
                        thClass: 'text-center fungsi-interaksional-group'
                    },
                    {
                        label: 'Penyesuaian Perasaan',
                        field: 'penyesuaianPerasaan',
                        type: 'number',
                        thClass: 'text-center fungsi-interaksional-group'
                    },
//                    Fungsi Emosional
                    {
                        label: 'Stabilitas Emosi',
                        field: 'stabilitasEmosi',
                        type: 'number',
                        thClass: 'text-center fungsi-emosional-group'
                    },
                    {
                        label: 'Toleransi terhadap Stress',
                        field: 'toleransiStress',
                        type: 'number',
                        thClass: 'text-center fungsi-emosional-group'
                    },
                    {
                        label: 'Pengendalian Diri',
                        field: 'pengendalianDiri',
                        type: 'number',
                        thClass: 'text-center fungsi-emosional-group'
                    },
                    {
                        label: 'Kemantapan Konsentrasi',
                        field: 'kemantapanKonsentrasi',
                        type: 'number',
                        thClass: 'text-center fungsi-emosional-group'
                    },
//                    Fungsi Sikap Kerja
                    {
                        label: 'Hasrat Berprestasi',
                        field: 'hasratBerprestasi',
                        type: 'number',
                        thClass: 'text-center fungsi-sikap-kerja-group'
                    },
                    {
                        label: 'Daya Tahan',
                        field: 'dayaTahan',
                        type: 'number',
                        thClass: 'text-center fungsi-sikap-kerja-group'
                    },
                    {
                        label: 'Keteraturan Kerja',
                        field: 'keteraturanKerja',
                        type: 'number',
                        thClass: 'text-center fungsi-sikap-kerja-group'
                    },
                    {
                        label: 'Pengerahan Energi Kerja',
                        field: 'pengerahanEnergi',
                        type: 'number',
                        thClass: 'text-center fungsi-sikap-kerja-group'
                    },
//                    Fungsi Manajerial
                    {
                        label: 'Efektivitas Perencanaan',
                        field: 'efektivitasPerencanaan',
                        type: 'number',
                        thClass: 'text-center fungsi-manajerial-group'
                    },
                    {
                        label: 'Pengorganisasian Pelaksanaan',
                        field: 'pengorganisasianPelaksanaan',
                        type: 'number',
                        thClass: 'text-center fungsi-manajerial-group'
                    },
                    {
                        label: 'Intensitas Pengarahan',
                        field: 'intensitasPengarahan',
                        type: 'number',
                        thClass: 'text-center fungsi-manajerial-group'
                    },
                    {
                        label: 'Kekuatan Pengawasan',
                        field: 'kekuatanPengawasan',
                        type: 'number',
                        thClass: 'text-center fungsi-manajerial-group'
                    },
                ],
                dataKinerjaColumns:[],
                rows: [],
                dataPegawai: [
                    {id:1, nip:"12345678", name:"Iqbal", unit:"UKJ", position:"Ketua", startYear:2015, competencyGroup:"IT", phone: '085600000000', education: "S1", birthday: "18 Juli 1997"},
                    {id:2, nip:"12345634", name:"Al", unit:"UKJ", position:"Ketua", startYear:2015, competencyGroup:"IT", phone: '085600000000', education: "S1", birthday: "18 Juli 1997"},
                    {id:3, nip:"12345623", name:"Khowarizmi", unit:"UKJ", position:"Ketua", startYear:2015, competencyGroup:"IT", phone: '085600000000', education: "S1", birthday: "18 Juli 1997"},
                ],
                dataKinerja: [],
                dataKompetensi: [
                    {
                        id:1, nip:99999999, name:"Al", unit:"Shokenbu"
                    },
                ],
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
        }
    }
</script>

<style>

</style>