<template>
    <div class="card" id="profil-pegawai">

        <div class="card-header">
            Profil Pegawai<a href="#profil-pegawai" class="btn btn-primary float-sm-right" v-on:click="editProfilPegawai">Edit</a>
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
</template>

<script>
    export default {
        props: ['id'],

        data() {
            return {
                isEditProfile: false,
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
                }
            }
               
        },
        created() {

            axios.get('/api/pegawai/' + this.id)
                .then((response) => {
                    var responsePegawai = response.data["data"];
                    this.pegawai.nama = responsePegawai["user"]["name"];
                    this.pegawai.tempatLahir = responsePegawai["pegawai"]["tempat_lahir"];
                    this.pegawai.tanggalLahir = responsePegawai["pegawai"]["tanggal_lahir"];
                    this.pegawai.email = responsePegawai["user"]["email"];
                    this.pegawai.nopeg = responsePegawai["pegawai"]["nip"];

                })
                .catch(function (error) {
                    console.log(error);
                });

            this.cachedpegawai = Object.assign({}, this.pegawai);
        },
        methods: {
            editProfilPegawai() {
                this.isEditProfile = true;
            }, 

            saveProfilPegawai() {
                this.cachedpegawai = Object.assign({}, this.pegawai);
                this.isEditProfile = false;

                axios.patch('/api/pegawai/4', {
                    name: this.pegawai.nama,
                    email: this.pegawai.email,
                    password: '1234',
                    nip: this.pegawai.nopeg
                })
                    .then(function (response) {
                        alert(response);
                    })
                    .catch(function (error) {
                        alert(error);
                    });

            },

            cancelProfilPegawai() {
                this.pegawai = Object.assign({}, this.cachedpegawai);
                this.isEditProfile = false;
            }
        }
    }
</script>

<style>

</style>