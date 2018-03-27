<template>
    <div>
        <header>
            <pmo-navbar v-on:navigation="changeTable"></pmo-navbar>
        </header>
        <main role="main" class="container">
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
                        sortable: true
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
                        field: 'startYear'
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
                dataKompetensiColumns:[],
                dataKinerjaColumns:[],
                rows: [],
                dataPegawai: [
                    {id:1, nip:"12345678", name:"Iqbal", unit:"UKJ", position:"Ketua", startYear:2015, competencyGroup:"IT", phone: '085600000000', education: "S1", birthday: "18 Juli 1997"},
                    {id:2, nip:"12345634", name:"Iqbal", unit:"UKJ", position:"Ketua", startYear:2015, competencyGroup:"IT", phone: '085600000000', education: "S1", birthday: "18 Juli 1997"},
                    {id:3, nip:"12345623", name:"Iqbal", unit:"UKJ", position:"Ketua", startYear:2015, competencyGroup:"IT", phone: '085600000000', education: "S1", birthday: "18 Juli 1997"},
                ],
                dataKinerja: [],
                dataKompetensi: [
                    {id:1, nip:99999999, name:"Al", unit:"Shokenbu", phone: '085600000000', education: "S1", birthday: "18 Juli 1997"},
                    {id:2, nip:99999999, name:"Al", unit:"Shokenbu", phone: '085600000000', education: "S1", birthday: "18 Juli 1997"},
                    {id:3, nip:99999999, name:"Al", unit:"Shokenbu", phone: '085600000000', education: "S1", birthday: "18 Juli 1997"}
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