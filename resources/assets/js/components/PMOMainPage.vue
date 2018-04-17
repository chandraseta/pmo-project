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
                                    class="btn btn-secondary m-1"
                                    data-toggle="modal"
                                    data-target="#addDataModal"
                                    v-if="!disableTambahDataButton">
                                Tambah Data
                            </button>
                        </div>
                        <div class="col-md-3 p-2"></div>
                        <div class="col-md-3 p-2"></div>
                        <div class="col-md-3 p-2">
                            <button type="button"
                                    class="btn btn-primary float-md-right m-1"
                                    data-toggle="modal"
                                    data-target="#downloadModal">
                                Download Data
                            </button>
                            <button type="button"
                                    class="btn btn-secondary float-md-right m-1"
                                    data-toggle="modal"
                                    data-target="#uploadModal"
                                    v-if="!disableUploadDataButton">
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
                            <div class="form-group" v-for="column in columns" v-if="column.fillable">
                                <label :for="column.field">{{ column.label }}</label>
                                <input class="form-control"
                                       :class="{'is-invalid': isFormInvalid[column.field]}"
                                       :type="column.type == 'number' || 'date' ? column.type : 'text'"
                                       :id="column.field"
                                       :placeholder="column.label"
                                       v-model="newData[column.field]">
                                <div v-if="column.required" class="invalid-feedback">
                                    NIP diperlukan untuk membuat data baru.
                                </div>
                            </div>
                        </form>
                        <div class="alert" :class="'alert-' + statusAlert.type" role="alert" v-if="statusAlert.display">
                            {{ statusAlert.message }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" @click="addData" :disabled="!isFormValid">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadModalLabel">Upload {{ title }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
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
                        <h5 class="modal-title" id="downloadModalLabel">Download {{ title }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
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
                currentTab: 'pegawai',
                columns: [],
                rows: [],
                dataPegawai: [],
                dataKinerja: [],
                dataKompetensi: [],
                newData: {},
                disableTambahDataButton: true,
                disableUploadDataButton: true,
                isFormInvalid: {},
                statusAlert: {
                    display: false,
                    message: '',
                    type: ''
                }
            }
        },
        computed: {
            isFormValid: function () {
                let validity;
                let isInvalid = this.isFormInvalid
                for (let field in isInvalid) {
                    validity |= isInvalid[field];
                }
                return !validity;
            }
        },
        watch: {
            newData: {
                handler: function (oldVal, newVal) {
                    let isInvalid = {};
                    this.columns.forEach(function (column) {
                        if (column.required) {
                            isInvalid[column.field] = newVal[column.field] == '';
                        }
                    });
                    this.isFormInvalid = isInvalid;
                },
                deep: true
            }
        },
        methods: {
            changeTable: function (payload) {
                this.title = payload.label;
                this.currentTab = payload.name;
                this.rows = this[payload.name];
                this.columns = this.$options[payload.name + 'Columns'];

                this.disableTambahDataButton = payload.name === "dataPegawai";
                this.disableUploadDataButton = payload.name === "dataPegawai";
            },
            saveData: function (payload) {
                console.log(payload);

                let url;
                if (this.currentTab === 'dataKompetensi') {
                    url = '/api/kompetensi/' + payload.id_kompetensi;
                } else if (this.currentTab === 'dataKinerja') {
                    url = '/api/kinerja/' + payload.id_kinerja;
                }

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
                        this.errors.push(e);
                    });
            },
            addData: function () {
                console.log(this.newData);

                let url;
                if (this.currentTab === 'dataKompetensi') {
                    url = '/api/kompetensi';
                } else if (this.currentTab === 'dataKinerja') {
                    url = '/api/kinerja';
                }

                let data = this.newData;
                let config = {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                };
                axios.post(url, data, config)
                    .then(response => {
                        console.log(response.data);
                        this.newData = {};
                        this.setAlert('success', response.data.message);
                    })
                    .catch(e => {
                        console.log(e.message);
                        console.log(e.response.data.message);
                        this.setAlert('danger', e.response.data.message);
                    })
            },
            getPegawai: function () {
                axios.get('/api/pegawai')
                    .then(response => {
                        this.dataPegawai = response.data.data;
                        this.dataPegawai.forEach(function (row, index, array) {
                            if (row.data_kepegawaians.length > 0) {
                                let data_kepegawaian = row.data_kepegawaians[row.data_kepegawaians.length - 1];
                                array[index].unit_kerja = data_kepegawaian.unit_kerja;
                                array[index].kompetensi = data_kepegawaian.kompetensi;
                                array[index].jabatan = data_kepegawaian.posisi;
                                array[index].tahun_masuk = data_kepegawaian.tahun_masuk;
                            }

                            if (row.riwayat_pendidikans.length > 0) {
                                array[index].strata = row.riwayat_pendidikans[row.riwayat_pendidikans.length - 1].strata;
                            }
                        });
                        this.columns = this.$options.dataPegawaiColumns;
                        this.rows = this.dataPegawai;
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
            getKinerja: function () {
                axios.get('/api/kinerja')
                    .then(response => {
                        this.dataKinerja = response.data.data;
                    })
                    .catch(e => {
                        this.errors.push(e);
                    })
            },
            downloadTemplate: function() {
                let url = '/api/templates/template.xlsx';
                window.open(url);
            },
            setAlert: function (type, message) {
                this.statusAlert.display = true;
                this.statusAlert.message = message;
                this.statusAlert.type = type;
            }
        },
        created: function () {
            this.getPegawai();
            this.getKompetensi();
            this.getKinerja();
        }
    }
</script>

<style>

</style>