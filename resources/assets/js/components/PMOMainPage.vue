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
                columns: [
                    {
                        label: 'NIP',
                        field: 'nip'
                    },
                    {
                        label: 'Nama',
                        field: 'name'
                    },
                    {
                        label: 'Unit',
                        field: 'unit'
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
                rows: [
                    {id:1, nip:12345678, name:"Iqbal", unit:"UKJ", phone: '085600000000', education: "S1", birthday: "18 Juli 1997"},
                    {id:2, nip:12345678, name:"Iqbal", unit:"UKJ", phone: '085600000000', education: "S1", birthday: "18 Juli 1997"},
                    {id:3, nip:12345678, name:"Iqbal", unit:"UKJ", phone: '085600000000', education: "S1", birthday: "18 Juli 1997"}
                ],
                dataPegawai: [
                    {id:1, nip:12345678, name:"Iqbal", unit:"UKJ", phone: '085600000000', education: "S1", birthday: "18 Juli 1997"},
                    {id:2, nip:12345678, name:"Iqbal", unit:"UKJ", phone: '085600000000', education: "S1", birthday: "18 Juli 1997"},
                    {id:3, nip:12345678, name:"Iqbal", unit:"UKJ", phone: '085600000000', education: "S1", birthday: "18 Juli 1997"}
                ],
                dataKinerja: [
                    {id:1, nip:12345678, name:"Al", unit:"Shokenbu", phone: '085600000000', education: "S1", birthday: "18 Juli 1997"},
                    {id:2, nip:12345678, name:"Al", unit:"Shokenbu", phone: '085600000000', education: "S1", birthday: "18 Juli 1997"},
                    {id:3, nip:12345678, name:"Al", unit:"Shokenbu", phone: '085600000000', education: "S1", birthday: "18 Juli 1997"}
                ],
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
            }
        }
    }
</script>

<style>

</style>