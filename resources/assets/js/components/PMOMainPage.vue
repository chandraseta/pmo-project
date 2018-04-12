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
        dataPegawaiColumns: require('./configs/data-pegawai-columns.json'),
        dataKompetensiColumns: require('./configs/data-kompetensi-columns.json'),
        dataKinerjaColumns: require('./configs/data-kinerja-columns.json'),
        name: 'pmo-main-page',
        components: {
            'pmo-navbar': require('./PMONavbar.vue'),
            'data-table': require('./DataTable.vue'),
        },
        data() {
            return {
                title: 'Data Pegawai',
                columns: [],
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
                this.columns = this.$options[payload.name + 'Columns'];
            }
        },
        created: function () {
            this.columns = this.$options.dataPegawaiColumns;

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

            this.rows = this.dataPegawai;
        }
    }
</script>

<style>

</style>