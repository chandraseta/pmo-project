<template>
    <div>
        <main role="main" class="container">
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 p-2">
                            <button type="button" class="btn btn-primary m-1">Add User</button>
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
        name: 'admin-main-page',
        components: {
            'admin-navbar': require('./Navbar.vue'),
            'data-table': require('./DataTable.vue'),
        },
        data() {
            return {
                title: 'Data User',
                columns: [],
                dataUserColumns:[
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
                rows: [],
                dataUser: [
                    {id:1, nip:"12345678", name:"Iqbal", unit:"UKJ", position:"Ketua", startYear:2015, competencyGroup:"IT", phone: '085600000000', education: "S1", birthday: "18 Juli 1997"},
                    {id:2, nip:"12345634", name:"Al", unit:"UKJ", position:"Ketua", startYear:2015, competencyGroup:"IT", phone: '085600000000', education: "S1", birthday: "18 Juli 1997"},
                    {id:3, nip:"12345623", name:"Khowarizmi", unit:"UKJ", position:"Ketua", startYear:2015, competencyGroup:"IT", phone: '085600000000', education: "S1", birthday: "18 Juli 1997"},
                ],
            }
        },
        created: function () {
            this.rows = this.dataUser;
            this.columns = this.dataUserColumns;
        }
    }
</script>

<style>

</style>