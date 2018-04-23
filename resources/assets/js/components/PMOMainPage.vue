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
                                    v-if="!disableDownloadDataButton"
                                    @click="downloadData">
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
                                <label for="upload-file">Upload data menggunakan file excel: </label>
                                <input type="file" class="form-control-file" id="upload-file">
                                <small class="text-muted">Harap gunakan file Excel dengan format yang telah disediakan di atas.</small>
                            </div>
                        </form>
                        <div class="alert" :class="'alert-' + statusAlert.type" role="alert" v-if="statusAlert.display">
                            {{ statusAlert.message }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" @click="uploadFile">Upload</button>
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
        dataTrainingColumns: require('./configs/data-training-columns.json'),
        name: 'pmo-main-page',
        components: {
            'pmo-navbar': require('./PMONavbar.vue'),
            'data-table': require('./DataTable.vue'),
        },
        data() {
            return {
                title: 'Data Pegawai',
                currentTab: 'dataPegawai',
                columns: [],
                rows: [],
                dataPegawai: [],
                dataKinerja: [],
                dataKompetensi: [],
                dataTraining: [],
                newData: {},
                disableTambahDataButton: true,
                disableDownloadDataButton: true,
                disableUploadDataButton: true,
                isFormInvalid: {},
                statusAlert: {
                    display: false,
                    message: '',
                    type: ''
                },
                errors: []
            }
        },
        computed: {
            isFormValid: function () {
                let validity;
                let isInvalid = this.isFormInvalid;
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
                this.disableUploadDataButton = payload.name === "dataPegawai" || payload.name === "dataTraining";
                this.disableDownloadDataButton = payload.name === "dataTraining";
            },
            saveData: function (payload) {
                console.log(payload);

                let url;
                let getData;
                if (this.currentTab === 'dataKompetensi') {
                    url = '/api/kompetensi/' + payload.id_kompetensi;
                    getData = this.getKompetensi;
                } else if (this.currentTab === 'dataKinerja') {
                    url = '/api/kinerja/' + payload.id_kinerja;
                    getData = this.getKinerja;
                } else if (this.currentTab === 'dataTraining') {
                    url = '/api/training/' + payload.id_training;
                    getData = this.getTraining;
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
                        alert(response.data.message);
                        getData();
                    })
                    .catch(e => {
                        this.errors.push(e);
                        alert(e.response.data.message);
                    });
            },
            addData: function () {
                console.log(this.newData);

                let url;
                let getData;
                if (this.currentTab === 'dataKompetensi') {
                    url = '/api/kompetensi';
                    getData = this.getKompetensi;
                } else if (this.currentTab === 'dataKinerja') {
                    url = '/api/kinerja';
                    getData = this.getKinerja;
                } else if (this.currentTab === 'dataTraining') {
                    url = '/api/training';
                    getData = this.getTraining;
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
                        getData();
                    })
                    .catch(e => {
                        console.log(e.message);
                        console.log(e.response.data.message);
                        this.setAlert('danger', e.response.data.message);
                    })
            },
            getPegawai: function () {
                axios.get('/api/pegawai-denormalized')
                    .then(response => {
                        this.dataPegawai = response.data.data;
                        this.rows = this[this.currentTab];
                    })
                    .catch(e => {
                        this.errors.push(e);
                    });

            },
            getKompetensi: function () {
                 axios.get('/api/kompetensi')
                    .then(response => {
                        this.dataKompetensi = response.data.data;
                        this.rows = this[this.currentTab];
                    })
                    .catch(e => {
                        this.errors.push(e);
                    });
            },
            getKinerja: function () {
                axios.get('/api/kinerja')
                    .then(response => {
                        this.dataKinerja = response.data.data;
                        this.rows = this[this.currentTab];
                    })
                    .catch(e => {
                        this.errors.push(e);
                    })
            },
            getTraining: function () {
                axios.get('/api/training')
                    .then(response => {
                        this.dataTraining = response.data.data;
                        this.rows = this[this.currentTab];
                    })
                    .catch(e => {
                        this.errors.push(e);
                    })
            },
            downloadTemplate: function() {
                let url = '/api/templates/template.xlsx';
                switch (this.currentTab) {
                    case 'dataKompetensi': url = '/api/templates/kompetensi_template.xlsx'; break;
                    case 'dataKinerja': url = '/api/templates/kinerja_template.xlsx'; break;
                }
                window.open(url);
            },
            downloadData: function () {
                let url;
                switch (this.currentTab) {
                    case 'dataPegawai': url = '/api/pegawai/export'; break;
                    case 'dataKompetensi': url = '/api/kompetensi/export'; break;
                    case 'dataKinerja': url = '/api/kinerja/export'; break;
                }
                window.open(url);
            },
            uploadFile: function () {
                let url;
                switch (this.currentTab) {
                    case 'dataKompetensi': url = '/api/kompetensi/import'; break;
                    case 'dataKinerja': url = '/api/kinerja/import'; break;
                }

                let excelFile = document.getElementById('upload-file').files[0];
                let formData = new FormData;
                formData.append('excel', excelFile);

                axios.post(url, formData)
                    .then(response => {
                        console.log("Import successful");
                        this.setAlert('success', response.data);
                    })
                    .catch(e => {
                        this.errors.push(e);
                        this.setAlert('danger', e.response.data);
                        console.log(e.response.data);
                    })
            },
            setAlert: function (type, message) {
                this.statusAlert.display = true;
                this.statusAlert.message = message;
                this.statusAlert.type = type;
                setTimeout(() => document.addEventListener('click', this.unsetAlert), 0);
            },
            unsetAlert: function () {
                this.statusAlert.display = false;
                document.removeEventListener('click', this.unsetAlert);
            }
        },
        created: function () {
            this.columns = this.$options.dataPegawaiColumns;
            this.getPegawai();
            this.getKompetensi();
            this.getKinerja();
            this.getTraining();
        }
    }
</script>

<style>

</style>