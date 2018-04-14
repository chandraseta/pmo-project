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
                            <button type="button"
                                    class="btn btn-outline-primary float-md-right m-1"
                                    data-toggle="modal"
                                    data-target="#downloadModal">
                                Download Hasil
                            </button>
                            <button type="button"
                                    class="btn btn-outline-primary float-md-right m-1"
                                    data-toggle="modal"
                                    data-target="#uploadModal">
                                Upload Data
                            </button>
                        </div>
                    </div>
                </div>
            </section>
            <data-table v-on:dataChange="saveData" :tableTitle="title"
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
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        Upload Data
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <p>
                                Download format excel di bawah ini terlebih dahulu.
                            </p>
                            <button type="button"
                                    class="btn btn-dark btn-sm"
                                    @click="downloadTemplate">
                                Download Format Excel
                            </button>
                        </div>
                        <br>
                        <form>
                            <div class="form-group container">
                                <label for="uploadFile">Upload data menggunakan file excel: </label>
                                <input type="file" class="form-control-file" id="uploadFile">
                                <small class="text-muted">Harap gunakan file excel dengan format yang telah disediakan di atas.</small>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="downloadModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
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
            },
            saveData: function (payload) {
                console.log(payload);
                let url = '/api/kompetensi/' + payload.id_kompetensi;
                let data = payload;
                let config = {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                };
                axios.put(url, data, config)
                    .then(response => {
                        console.log(response.data);
                    })
                    .catch(e => {
                        this.error.push(e);
                    });
            },
            getPegawai: function () {
                 axios.get('/api/pegawai')
                    .then(response => {
                        this.dataPegawai = response.data.data;
                    })
                    .catch(e => {
                        this.errors.push(e);
                    });
            },
            getKompetensi: function () {
                 axios.get('/api/kompetensi')
                    .then(response => {
                        this.dataKompetensi = response.data.data;
                    })
                    .catch(e => {
                        this.errors.push(e);
                    });
            },
            downloadTemplate: function() {
                let url = '/api/templates/template.xlsx';
                window.open(url);
            }
        },
        created: function () {
            axios.get('/api/pegawai')
                .then(response => {
                    this.dataPegawai = response.data.data;
                    this.columns = this.$options.dataPegawaiColumns;
                    this.rows = this.dataPegawai;
                })
                .catch(e => {
                    this.errors.push(e);
                });

            this.getKompetensi();
        }
    }
</script>

<style>

</style>