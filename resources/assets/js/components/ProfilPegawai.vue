<template>
    <div id="pegawai">
        <div class="card" id="profil-pegawai">
            <div class="card-header">
                Profil Pegawai<button class="btn btn-primary float-sm-right" v-on:click="editProfilPegawai" v-bind:disabled="disableEdit">Edit</button>
            </div>

            <div class="card-body">
                <div class="card-container">
                    <div class="row">
                        <div class="col-sm-3 img-responsive">
                            <img id="img-profile" v-bind:src="pegawai.imageProfileUrl" class="img-thumbnail">
                            <br><br>
                            <button type="button" class="btn btn-primary">Ganti Foto</button>
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-7">
                            <div class="row">
                                <div class="col-sm-3 text-right">
                                    Nama
                                </div>
                                <div class="col-sm-9">

                                    <b v-if="!isEditProfile" v-text="pegawai.nama"></b>

                                    <div id="edit-nama" class="form-group" v-if="isEditProfile">
                                        <input v-model="pegawai.nama" type="text" class="form-control">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-sm-3 text-right">
                                    Tempat, Tanggal Lahir
                                </div>
                                <div class="col-sm-9">
                                    <b v-if="!isEditProfile"><span v-text="pegawai.tempatLahir"></span>, <span v-text="pegawai.tanggalLahir"></span></b>

                                    <div class="form-row" v-if="isEditProfile">
                                        <div id="edit-tempat-lahir" class="form-group">
                                            <input v-model="pegawai.tempatLahir" type="text" class="form-control">
                                            <small class="form-text text-muted">*Tempat lahir. Wajib diisi</small>
                                        </div>
                                        <div id="edit-tanggal-lahir" class="form-group">
                                            <input v-model="pegawai.tanggalLahir" type="date" class="form-control">
                                            <small class="form-text text-muted">*Tanggal lahir. Wajib diisi</small>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-sm-3 text-right">
                                    Email
                                </div>
                                <div class="col-sm-9">
                                    <b v-if="!isEditProfile" v-text="pegawai.email"></b>

                                    <div v-if="isEditProfile" id="edit-email" class="form-group">
                                        <input v-model="pegawai.email" type="email" class="form-control">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>

                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-sm-3 text-right">
                                    No. Pegawai
                                </div>
                                <div class="col-sm-9">
                                    <b v-if="!isEditProfile" v-text="pegawai.nopeg"></b>

                                    <div v-if="isEditProfile" id="edit-nopeg" class="form-group">
                                        <input v-model="pegawai.nopeg" type="text" class="form-control">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-sm-3 text-right">
                                    Unit Kerja
                                </div>
                                <div class="col-sm-9">
                                    <b v-if="!isEditProfile" v-text="pegawai.unitKerja"></b>

                                    <div v-if="isEditProfile" id="edit-unit-kerja" class="form-group">
                                        <input v-model="pegawai.unitKerja" type="text" class="form-control">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-sm-3 text-right">
                                    Jabatan
                                </div>
                                <div class="col-sm-9">
                                    <b v-if="!isEditProfile" v-text="pegawai.posisi"></b>

                                    <div v-if="isEditProfile" id="edit-posisi" class="form-group">
                                        <input v-model="pegawai.posisi" type="text" class="form-control">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-sm-3 text-right">
                                    Kompetensi
                                </div>
                                <div class="col-sm-9">
                                    <b v-if="!isEditProfile" v-text="pegawai.kompetensi"></b>

                                    <div v-if="isEditProfile" id="edit-kompetensi" class="form-group">
                                        <input v-model="pegawai.kompetensi" type="text" class="form-control">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-sm-3 text-right">
                                    Tahun Masuk
                                </div>
                                <div class="col-sm-9">
                                    <b v-if="!isEditProfile" v-text="pegawai.tahunMasuk"></b>

                                    <div v-if="isEditProfile" id="edit-tahun-masuk" class="form-group">
                                        <input v-model="pegawai.tahunMasuk" type="text" class="form-control">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-muted" v-if="isEditProfile">
                <a href="#profil-pegawai" class="btn btn-success float-sm-right btn-simpan" v-on:click="saveProfilPegawai">Simpan</a>
                <a href="#profil-pegawai" class="btn btn-danger float-sm-right" v-on:click="cancelProfilPegawai">Batal</a>
            </div>
        </div>

        <br>

        <div class="card" id="data-kepegawaian">
            <div class="card-header">
                Data Kepegawaian<button class="btn btn-primary float-sm-right" v-on:click="editDataKepegawaian" v-bind:disabled="disableEdit">Edit</button>
            </div>

            <div class="card-body">
                <div class="container">

                    <div v-if="dataKepegawaian.length === 0" class="no-data-kepegawaian">
                        
                        Belum ditambahkan.
                        <br>
                    </div>

                    <div v-if="dataKepegawaian.length !== 0" class="data-kepegawaian">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Unit Kerja</th>
                                <th scope="col">Posisi</th>
                                <th scope="col">Tahun Masuk</th>
                                <th scope="col">Tahun Keluar</th>
                            </tr>
                            </thead>
                            <tbody v-for="dk in dataKepegawaian">
                            <tr v-if="!isEditKepegawaian">
                                <td v-text="dk.id_unit_kerja" ></td>
                                <td v-text="dk.id_posisi" ></td>
                                <td v-text="dk.tahun_masuk" ></td>
                                <td v-text="dk.tahun_keluar" ></td>
                            </tr>
                            <tr v-if="isEditKepegawaian">
                                <td>
                                    <div class="form-group">
                                        <input v-model="dk.id_unit_kerja" type="text" class="form-control text-center">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input v-model="dk.id_posisi" type="text" class="form-control text-center">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input v-model="dk.tahun_masuk" type="text" class="form-control text-center">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input v-model="dk.tahun_keluar" type="text" class="form-control text-center">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </td>
                                <td>
                                    <button v-bind:id="dataKepegawaian.indexOf(dk)" v-on:click="delDataKepegawaian($event)" class="btn btn-danger" type="button">Hapus</button>
                                </td>
                            </tr>
                            </tbody>
                            <button v-if="isEditKepegawaian" class="btn btn-primary float-sm-left" v-on:click="addDataKepegawaian">Tambah</button>
                        </table>

                    </div>

                    <br>

                </div>
            </div>
            <div class="card-footer text-muted" v-if="isEditKepegawaian">
                <a href="#data-kepegawaian" class="btn btn-success float-sm-right btn-simpan" v-on:click="saveDataKepegawaian">Simpan</a>
                <a href="#data-kepegawaian" class="btn btn-danger float-sm-right" v-on:click="cancelDataKepegawaian">Batal</a>
            </div>
        </div>

        <br>

        <div class="card">
            <div class="card-header">
                Riwayat Pendidikan dan Pekerjaan<button class="btn btn-primary float-sm-right" v-on:click="editRiwayatPegawai" v-bind:disabled="disableEdit">Edit</button>
            </div>

            <div class="card-body">
                <div class="container">

                    <h5>Riwayat Pendidikan</h5>

                    <div v-if="riwayatPendidikan.length === 0" class="no-riwayat-pendidikan">
                        <hr>
                        Belum ditambahkan.
                        <br>
                    </div>

                    <div v-if="riwayatPendidikan.length !== 0" class="riwayat-pendidikan">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Tingkat Pendidikan</th>
                                <th scope="col">Nama Institusi</th>
                                <th scope="col">Jurusan</th>
                                <th scope="col">Tahun Masuk</th>
                                <th scope="col">Tahun Keluar</th>
                            </tr>
                            </thead>
                            <tbody v-for="rp in riwayatPendidikan">
                            <tr>
                                <td v-text="rp.strata" ></td>
                                <td v-text="rp.nama_institusi" ></td>
                                <td v-text="rp.jurusan" ></td>
                                <td v-text="rp.tahun_masuk" ></td>
                                <td v-text="rp.tahun_keluar" ></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>

                    <br><br>


                    <h5>Riwayat Pekerjaan</h5>

                    <div v-if="riwayatPekerjaan.length === 0" class="no-riwayat-pekerjaan">
                        <hr>
                        Belum ditambahkan.
                        <br>
                    </div>

                    <div v-if="riwayatPekerjaan.length !== 0" class="riwayat-pekerjaan">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Nama Institusi</th>
                                <th scope="col">Posisi</th>
                                <th scope="col">Tahun Masuk</th>
                                <th scope="col">Tahun Keluar</th>
                            </tr>
                            </thead>
                            <tbody v-for="rp in riwayatPekerjaan">
                            <tr>
                                <td v-text="rp.nama_institusi" ></td>
                                <td v-text="rp.posisi" ></td>
                                <td v-text="rp.tahun_masuk" ></td>
                                <td v-text="rp.tahun_keluar" ></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['id'],

        data() {
            return {
                disableEdit: false,
                isEditProfile: false,
                isEditKepegawaian: false,
                isEditRiwayat: false,
                cachedpegawai: null,
                cachedDataKepegawaian: null,
                cachedRiwayatPendidikan: null,
                cachedRiwayatPekerjaan: null,
                pegawai: {
                    imageProfileUrl: "https://i.pinimg.com/236x/34/ba/c1/34bac13dd65ab3b81267f727e5633549--patrick-dempsey-handsome-man.jpg",
                    nama: "",
                    tempatLahir: "",
                    tanggalLahir: "",
                    email: "",
                    nopeg: "",
                    unitKerja: "",
                    posisi: "",
                    kompetensi: "",
                    tahunMasuk: ""
                },
                dataKepegawaian: [],
                riwayatPendidikan: [],
                riwayatPekerjaan: []
            }
               
        },
        created() {

            axios.get('/api/pegawai/' + this.id)
                .then((response) => {
                    //get data from api response
                    var responsePegawai = response.data["data"];
                    this.pegawai.nama = responsePegawai["user"]["name"];
                    this.pegawai.tempatLahir = responsePegawai["pegawai"]["tempat_lahir"];
                    this.pegawai.tanggalLahir = responsePegawai["pegawai"]["tanggal_lahir"];
                    this.pegawai.email = responsePegawai["user"]["email"];
                    this.pegawai.nopeg = responsePegawai["pegawai"]["nip"];
                    this.dataKepegawaian = responsePegawai["kepegawaian"];
                    this.riwayatPendidikan = responsePegawai["pendidikan"];
                    this.riwayatPekerjaan = responsePegawai["pekerjaan"];

                })
                .catch(function (error) {
                    console.log(error);
                });

            this.cachedpegawai = Object.assign({}, this.pegawai);
        },
        methods: {
            disableEditToggle() {
                this.disableEdit = !this.disableEdit;
            },

            editProfilPegawai() {
                this.isEditProfile = true;
                this.disableEditToggle();
            },

            editDataKepegawaian() {
                this.isEditKepegawaian = true;
                this.disableEditToggle();
            },

            editRiwayatPegawai() {
                this.isEditRiwayat = true;
                this.disableEditToggle();
            },

            addDataKepegawaian() {
                var newData = {
                    id_data_kepegawaian : "",
                    id_pegawai : "",
                    id_unit_kerja : "",
                    id_posisi : "",
                    tahun_masuk : "",
                    tahun_keluar : ""
                };
                this.dataKepegawaian.push(newData);
            },

            delDataKepegawaian(event) {
                var targetIndex = event.currentTarget.id;
                this.dataKepegawaian.splice(targetIndex, 1);
            },

            saveProfilPegawai() {
                this.disableEditToggle();
                this.cachedUser = Object.assign({}, this.user);
                this.isEditProfile = false;

                axios.patch('/api/pegawai/4', {
                    name: this.user.nama,
                    email: this.user.email,
                    password: '1234',
                    nip: this.user.nopeg
                })
                .then(function (response) {
                    alert(response);
                })
                .catch(function (error) {
                    alert(error);
                });

            },

            saveDataKepegawaian() {
                this.disableEditToggle();
                this.cachedDataKepegawaian = Object.assign({}, this.dataKepegawaian);
                this.isEditKepegawaian = false;
            },

            saveRiwayatPegawai() {
                this.disableEditToggle();
                this.cachedRiwayatPendidikan = Object.assign({}, this.riwayatPendidikan);
                this.cachedRiwayatPekerjaan = Object.assign({}, this.riwayatPekerjaan);
                this.isEditRiwayat = false;
            },

            cancelProfilPegawai() {
                this.disableEditToggle();
                this.user = Object.assign({}, this.cachedUser);
                this.isEditProfile = false;
            },

            cancelDataKepegawaian() {
                this.disableEditToggle();
                this.dataKepegawaian = Object.assign({}, this.cachedDataKepegawaian);
                this.isEditKepegawaian = false;
            },

            cancelRiwayatPegawai() {
                this.disableEditToggle();
                this.riwayatPendidikan = Object.assign({}, this.cachedRiwayatPendidikan);
                this.riwayatPekerjaan = Object.assign({}, this.cachedRiwayatPekerjaan);
                this.isEditRiwayat = false;
            },
        }
    }
</script>

<style>

</style>