<template>
    <div>
        <div class="card" id="profil-pegawai-specific">
            <div class="card-header">
                Profil Pegawai
                <!-- <button class="btn btn-primary float-sm-right" v-on:click="editProfilPegawai" v-bind:disabled="disableEdit">
                    Edit <i class="fas fa-edit"></i>
                </button> -->
            </div>

            <div class="card-body">
                <div class="card-container">
                    <div class="row">
                        <div class="col-sm-3 img-responsive">
                            <img id="img-profile" v-bind:src="pegawai.imageProfileUrl" class="img-thumbnail">
                            <br><br>
                            <input type="file" v-if="isEditProfile" v-on:change="FileChangeProfile" class="form-control">
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
                                    <b v-if="!isEditProfile" v-text="pegawai.unitKerja.text"></b>

                                    <div v-if="isEditProfile" id="edit-unit-kerja" class="form-group">
                                        <select class="form-control" v-model="pegawai.unitKerja.id">
                                            <option v-for="uk in unitKerja" v-bind:value="uk.id_unit_kerja">
                                                {{ uk.nama_unit_kerja }}
                                            </option>
                                        </select>
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
                                    <b v-if="!isEditProfile" v-text="pegawai.posisi.text"></b>

                                    <div v-if="isEditProfile" id="edit-posisi" class="form-group">
                                        <select class="form-control" v-model="pegawai.posisi.id">
                                            <option v-for="pos in posisi" v-bind:value="pos.id_posisi">
                                                {{ pos.nama_posisi }}
                                            </option>
                                        </select>
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
                                    <b v-if="!isEditProfile" v-text="pegawai.kompetensi.text"></b>

                                    <div v-if="isEditProfile" id="edit-kompetensi" class="form-group">
                                        <select class="form-control" v-model="pegawai.kompetensi.id">
                                            <option v-for="kk in kelompokKompetensi" v-bind:value="kk.id_kelompok_kompetensi">
                                                {{ kk.nama_kelompok_kompetensi }}
                                            </option>
                                        </select>
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-sm-3 text-right">
                                    Tahun Mulai Jabatan Saat Ini
                                </div>
                                <div class="col-sm-9">
                                    <b v-if="!isEditProfile" v-text="pegawai.tahunMasuk"></b>

                                    <div v-if="isEditProfile" id="edit-tahun-masuk" class="form-group">
                                        <input v-model="pegawai.tahunMasuk" type="text" class="form-control">
                                        <small class="form-text text-muted">*Edit pada data kepegawaian di bawah</small>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-muted" v-if="isEditProfile">
                <a href="#profil-pegawai-specific" class="btn btn-success float-sm-right btn-simpan" v-on:click="saveProfilPegawai">
                    Simpan <i class="fas fa-check"></i>
                    </a>
                <a href="#profil-pegawai-specific" class="btn btn-danger float-sm-right" v-on:click="cancelProfilPegawai">
                    Batal <i class ="fas fa-times"></i>
                </a>
            </div>
        </div>

        <br>

        <div class="card" id="data-kepegawaian">
            <div class="card-header">
                Data Kepegawaian
                <!-- <button class="btn btn-primary float-sm-right" v-on:click="editDataKepegawaian" v-bind:disabled="disableEdit">
                    Edit <i class="fas fa-edit"></i>
                </button> -->
            </div>

            <div class="card-body">
                <div class="container">

                    <div v-if="dataKepegawaian.length === 0" class="no-data-kepegawaian">
                        <div v-if="!isEditKepegawaian">
                            Belum ditambahkan.
                            <br>
                        </div>
                        <button v-if="isEditKepegawaian" class="btn btn-primary float-sm-left" v-on:click="addDataKepegawaian">
                            Tambah <i class="fas fa-plus"></i>
                        </button>
                        
                    </div>

                    <div v-if="dataKepegawaian.length !== 0" class="data-kepegawaian">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Unit Kerja</th>
                                <th scope="col">Jabatan</th>
                                <!-- <th scope="col">Kompetensi</th> -->
                                <th scope="col">Tahun Mulai</th>
                                <th scope="col">Tahun Selesai</th>
                            </tr>
                            </thead>
                            <tbody v-for="dk in dataKepegawaian">
                            <tr v-if="!isEditKepegawaian">
                                <td v-text="unitKerja.find(x => x.id_unit_kerja == dk.id_unit_kerja).nama_unit_kerja" ></td>
                                <td v-text="posisi.find(x => x.id_posisi == dk.id_posisi).nama_posisi" ></td>
                                <!-- <td v-text="kelompokKompetensi.find(x => x.id_kelompok_kompetensi == dk.id_kelompok_kompetensi).nama_kelompok_kompetensi" ></td> -->
                                <td v-text="dk.tahun_masuk" ></td>
                                <td v-text="dk.tahun_keluar" ></td>
                            </tr>
                            <tr v-if="isEditKepegawaian">
                                <td>
                                    <div class="form-group">
                                        <select class="form-control" v-model="dk.id_unit_kerja">
                                            <option v-for="uk in unitKerja" v-bind:value="uk.id_unit_kerja">
                                                {{ uk.nama_unit_kerja }}
                                            </option>
                                        </select>
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <select class="form-control" v-model="dk.id_posisi">
                                            <option v-for="pos in posisi" v-bind:value="pos.id_posisi">
                                                {{ pos.nama_posisi }}
                                            </option>
                                        </select>
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </td>
                                <!-- <td>
                                    <div class="form-group">
                                        <select class="form-control" v-model="dk.id_kelompok_kompetensi">
                                            <option v-for="kk in kelompokKomptensi" v-bind:value="kk.id_kelompok_kompetensi">
                                                {{ kk.nama_kelompok_kompetensi }}
                                            </option>
                                        </select>
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </td> -->
                                <td>
                                    <div class="form-group">
                                        <input v-model="dk.tahun_masuk" type="text" class="form-control text-center">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input v-model="dk.tahun_keluar" type="text" class="form-control text-center">
                                        <small class="form-text text-muted">*Isi dengan "-" jika belum selesai</small>
                                    </div>
                                </td>
                                <td>
                                    <button v-bind:id="dataKepegawaian.indexOf(dk)" v-on:click="delDataKepegawaian($event)" class="btn btn-danger" type="button">
                                        Hapus <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                            <button v-if="isEditKepegawaian" class="btn btn-primary float-sm-left" v-on:click="addDataKepegawaian">
                                Tambah <i class="fas fa-plus"></i>
                            </button>
                        </table>

                    </div>

                    <br>

                </div>
            </div>
            <div class="card-footer text-muted" v-if="isEditKepegawaian">
                <a href="#data-kepegawaian" class="btn btn-success float-sm-right btn-simpan" v-on:click="saveDataKepegawaian">
                    Simpan <i class="fas fa-check"></i>
                    </a>
                <a href="#data-kepegawaian" class="btn btn-danger float-sm-right" v-on:click="cancelDataKepegawaian">
                    Batal <i class ="fas fa-times"></i>
                </a>
            </div>
        </div>

        <br>

        <div class="card" id="riwayat-pegawai">
            <div class="card-header">
                Riwayat Pendidikan dan Pekerjaan
                <!-- <button class="btn btn-primary float-sm-right" v-on:click="editRiwayatPegawai" v-bind:disabled="disableEdit">
                    Edit <i class="fas fa-edit"></i>
                </button> -->
            </div>

            <div class="card-body">
                <div class="container">

                    <h5>Riwayat Pendidikan</h5>

                    <div v-if="riwayatPendidikan.length === 0" class="no-riwayat-pendidikan">
                        <div v-if="!isEditRiwayat">
                            <hr>
                            Belum ditambahkan.
                            <br>
                        </div>
                        <button v-if="isEditRiwayat" class="btn btn-primary float-sm-left" v-on:click="addRiwayatPendidikan">
                            Tambah <i class="fas fa-plus"></i>
                        </button>
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
                            <tr v-if="!isEditRiwayat">
                                <td v-text="rp.strata" ></td>
                                <td v-text="rp.nama_institusi" ></td>
                                <td v-text="rp.jurusan" ></td>
                                <td v-text="rp.tahun_masuk" ></td>
                                <td v-text="rp.tahun_keluar" ></td>
                            </tr>
                            <tr v-if="isEditRiwayat">
                                <td>
                                    <div class="form-group">
                                        <input v-model="rp.strata" type="text" class="form-control text-center">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input v-model="rp.nama_institusi" type="text" class="form-control text-center">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input v-model="rp.jurusan" type="text" class="form-control text-center">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input v-model="rp.tahun_masuk" type="text" class="form-control text-center">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input v-model="rp.tahun_keluar" type="text" class="form-control text-center">
                                        <small class="form-text text-muted">*Isi dengan "-" jika belum selesai</small>
                                    </div>
                                </td>
                                <td>
                                    <button v-bind:id="riwayatPendidikan.indexOf(rp)" v-on:click="delRiwayatPendidikan($event)" class="btn btn-danger" type="button">
                                        Hapus <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>

                            </tbody>
                            <button v-if="isEditRiwayat" class="btn btn-primary float-sm-left" v-on:click="addRiwayatPendidikan">
                                Tambah <i class="fas fa-plus"></i>
                            </button>
                        </table>

                    </div>

                    <br><br>


                    <h5>Riwayat Pekerjaan (di luar ITB)</h5>

                    <div v-if="riwayatPekerjaan.length === 0" class="no-riwayat-pekerjaan">
                        <div v-if="!isEditRiwayat">
                            <hr>
                            Belum ditambahkan.
                            <br>
                        </div>
                        <button v-if="isEditRiwayat" class="btn btn-primary float-sm-left" v-on:click="addRiwayatPekerjaan">
                            Tambah <i class="fas fa-plus"></i>
                        </button>
                    </div>

                    <div v-if="riwayatPekerjaan.length !== 0" class="riwayat-pekerjaan">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Nama Institusi</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Tahun Masuk</th>
                                <th scope="col">Tahun Keluar</th>
                            </tr>
                            </thead>
                            <tbody v-for="rp in riwayatPekerjaan">
                            <tr v-if="!isEditRiwayat">
                                <td v-text="rp.nama_institusi" ></td>
                                <td v-text="rp.posisi" ></td>
                                <td v-text="rp.tahun_masuk" ></td>
                                <td v-text="rp.tahun_keluar" ></td>
                            </tr>

                            <tr v-if="isEditRiwayat">
                                <td>
                                    <div class="form-group">
                                        <input v-model="rp.nama_institusi" type="text" class="form-control text-center">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input v-model="rp.posisi" type="text" class="form-control text-center">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input v-model="rp.tahun_masuk" type="text" class="form-control text-center">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input v-model="rp.tahun_keluar" type="text" class="form-control text-center">
                                        <small class="form-text text-muted">*Isi dengan "-" jika belum selesai</small>
                                    </div>
                                </td>
                                <td>
                                    <button v-bind:id="riwayatPekerjaan.indexOf(rp)" v-on:click="delRiwayatPekerjaan($event)" class="btn btn-danger" type="button">
                                        Hapus <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                            <button v-if="isEditRiwayat" class="btn btn-primary float-sm-left" v-on:click="addRiwayatPekerjaan">
                                Tambah <i class="fas fa-plus"></i>
                            </button>
                        </table>

                    </div>

                </div>
            </div>
            <div class="card-footer text-muted" v-if="isEditRiwayat">
                <a href="#riwayat-pegawai" class="btn btn-success float-sm-right btn-simpan" v-on:click="saveRiwayatPegawai">
                    Simpan <i class="fas fa-check"></i>
                    </a>
                <a href="#riwayat-pegawai" class="btn btn-danger float-sm-right" v-on:click="cancelRiwayatPegawai">
                    Batal <i class ="fas fa-times"></i>
                </a>
            </div>
        </div>

        <br>

        <div class="card" id="sertificate">
            <div class="card-header">
                Sertifikat<button class="btn btn-primary float-sm-right" v-on:click="editSertifikat" v-bind:disabled="disableEdit">
                    Edit <i class="fas fa-edit"></i>
                    </button>
            </div>

            <div class="card-body">
                <div class="container">
                    <div v-if="sertifikat.length === 0" class="no-sertificate">
                        <div v-if="!isEditSertifikat">
                            Belum ditambahkan.
                            <br>
                        </div>
                        <button v-if="isEditSertifikat" class="btn btn-primary float-sm-left" v-on:click="addSertifikat">
                            Tambah <i class="fas fa-plus"></i>
                        </button>
                    </div>

                    <div v-if="sertifikat.length !== 0" class="sertificate">
                        <table class="table" align="left" style="width: 100%">
                            <tbody v-for="dk in sertifikat">
                            <div v-if="!isEditSertifikat">
                                <colgroup>
                                    <col width="35%">
                                    <col width="15%">
                                    <col width="50%">
                                </colgroup>
                                <tr>
                                    <td rowspan="4">
                                        <img id="img-sertifikat-1" v-bind:src="dk.nama_file" class="img-thumbnail" width="200">
                                    </td>
                                    <th scope="col">Judul</th>
                                    <td v-text="dk.judul" ></td>
                                </tr>
                                <tr>
                                    <th scope="col">Lembaga</th>
                                    <td v-text="dk.lembaga" ></td>
                                </tr>
                                <tr>
                                    <th scope="col">Tahun Diterbitkan</th>
                                    <td v-text="dk.tahun_diterbitkan" ></td>
                                </tr>
                                <tr>
                                    <th scope="col">Catatan</th>
                                    <td v-text="dk.catatan" ></td>   
                                </tr>
                            </div>

                            <div v-if="isEditSertifikat">
                            <tr>
                                <td rowspan="4">
                                    <div>
                                        <button v-bind:id="sertifikat.indexOf(dk)" v-on:click="delSertifikat($event)" class="btn btn-danger" type="button">
                                            Hapus <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                                <td rowspan="4">
                                    <img id="img-sertifikat-1" v-bind:src="dk.nama_file" class="img-thumbnail" width="200">
                                    <br><br>
                                    <input type="file" v-bind:id="sertifikat.indexOf(dk)" v-on:change="FileChangeSertifikat" class="form-control">
                                </td>
                                <th scope="col">Judul</th>
                                <td>
                                    <div class="form-group">
                                        <input v-model="dk.judul" type="text" class="form-control">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">Lembaga</th>
                                <td>
                                    <div class="form-group">
                                        <input v-model="dk.lembaga" type="text" class="form-control">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">Tahun Diterbitkan</th>
                                <td>
                                    <div class="form-group">
                                        <input v-model="dk.tahun_diterbitkan" type="text" class="form-control">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">Catatan</th>
                                <td>
                                    <div class="form-group">
                                        <input v-model="dk.catatan" type="text" class="form-control">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </td>
                            </tr>
                            </div>
                            </tbody>
                            <button v-if="isEditSertifikat" class="btn btn-primary float-sm-left" v-on:click="addSertifikat">
                                Tambah <i class="fas fa-plus"></i>
                            </button>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted" v-if="isEditSertifikat">
                <a href="#sertificate" class="btn btn-success float-sm-right btn-simpan" v-on:click="saveSertifikat">
                    Simpan <i class="fas fa-check"></i>
                    </a>
                <a href="#sertificate" class="btn btn-danger float-sm-right" v-on:click="cancelSertifikat">
                    Batal <i class ="fas fa-times"></i>
                </a>
            </div>
        </div>


        <br>

        <div class="card" id="data-kinerja">
            <div class="card-header">
                Hasil Kinerja<button class="btn btn-primary float-sm-right" v-on:click="editDataKinerja" v-bind:disabled="disableEdit">
                    Edit <i class="fas fa-edit"></i>
                    </button>
            </div>

            <div class="card-body">
                <div class="container">
                    <div v-if="dataKinerja.length === 0" class="no-data-kinerja">
                        <div v-if="!isEditDataKinerja">
                            Belum ditambahkan.
                            <br>
                        </div>
                        <button v-if="isEditDataKinerja" class="btn btn-primary float-sm-left" v-on:click="addDataKinerja">
                            Tambah <i class="fas fa-plus"></i>
                        </button>
                    </div>

                    <div v-if="dataKinerja.length !== 0" class="data-kinerja">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Tahun</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Nilai</th>
                                <th scope="col">Catatan</th>
                            </tr>
                            </thead>
                            <tbody>
                                
                            <tr v-if="!isEditDataKinerja" v-for="dks in dataKinerjaShow">
                                <td v-text="dks.tahun" ></td>
                                <td v-text="dks.semester" ></td>
                                <td v-text="dks.nilai" ></td>
                                <td v-text="dks.catatan" ></td>
                            </tr>

                            <tr v-if="isEditDataKinerja" v-for="dk in dataKinerja">
                                <td>
                                    <div class="form-group">
                                        <input v-model="dk.tahun" type="text" class="form-control text-center">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input v-model="dk.semester" type="text" class="form-control text-center">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input v-model="dk.nilai" type="text" class="form-control text-center">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input v-model="dk.catatan" type="text" class="form-control text-center">
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </td>
                                <td>
                                    <button v-bind:id="dataKinerja.indexOf(dk)" v-on:click="delDataKinerja($event)" class="btn btn-danger" type="button">
                                        Hapus <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                            <a href="#data-kinerja" v-if="!isEditDataKinerja && !isShowAllDataKinerja" class="btn btn-primary float-sm-left" v-on:click="showAllDataKinerja">
                                Tamplikan semua <i class="fas fa-eye"></i>
                            </a>
                            <a href="#data-kinerja" v-if="!isEditDataKinerja && isShowAllDataKinerja" class="btn btn-danger float-sm-left" v-on:click="hideDataKinerja">
                                Sembunyikan sebagian <i class="fas fa-eye-slash"></i>
                            </a>
                            <button v-if="isEditDataKinerja" class="btn btn-primary float-sm-left" v-on:click="addDataKinerja">
                                Tambah <i class="fas fa-plus"></i>
                            </button>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted" v-if="isEditDataKinerja">
                <a href="#data-kinerja" class="btn btn-success float-sm-right btn-simpan" v-on:click="saveDataKinerja">
                    Simpan <i class="fas fa-check"></i>
                    </a>
                <a href="#data-kinerja" class="btn btn-danger float-sm-right" v-on:click="cancelDataKinerja">
                    Batal <i class ="fas fa-times"></i>
                </a>
            </div>
        </div>

        <br>

        <div class="card" id="data-kompetensi">
            <div class="card-header">
                Hasil Kompetensi<button class="btn btn-primary float-sm-right" v-on:click="editKommpetensi" v-bind:disabled="disableEdit">
                    Edit <i class="fas fa-edit"></i>
                    </button>
            </div>

            <div class="card-body">
                <div class="container">

                     <button class="btn btn-primary float-sm-left" v-on:click="downloadKompetensi" v-bind:disabled="disableEdit">
                    Download <i class="fas fa-download"></i>
                 </button>

                </div>
            </div>
        </div>

        <br>

        <div class="card" id="rekomendasi">
            <div class="card-header">
                Rekomendasi<button class="btn btn-primary float-sm-right" v-on:click="editRekomendasi" v-bind:disabled="disableEdit">
                    Edit <i class="fas fa-edit"></i>
                    </button>
            </div>

            <div class="card-body">
                <div class="container">

                    <h5>Rekomendasi Training</h5>

                    <hr>

                    <div v-if="rekomendasiTraining.length === 0" class="no-rekomendasi-posisi">
                        <div v-if="!isEditRekomendasi">
                            Belum ditambahkan.
                            <br>
                        </div>
                        <button v-if="isEditRekomendasi" class="btn btn-primary float-sm-left" v-on:click="addRekomendasiTraining">
                            Tambah <i class="fas fa-plus"></i>
                        </button>
                        
                    </div>

                    <div v-if="rekomendasiTraining.length !== 0" v-for="rt in rekomendasiTraining" class="rekomendasi-training">
                        <ul v-if="!isEditRekomendasi">
                            <li v-text="trainingList.find(x => x.id_training == rt.id_training).nama_training"></li>
                        </ul>

                        <div v-if="isEditRekomendasi" class="form-group row">
                            <div class="col-sm-10">
                                <select class="form-control" v-model="rt.id_training">
                                    <option v-for="tl in trainingList" v-bind:value="tl.id_training">
                                        {{ tl.nama_training }}
                                    </option>
                                </select>
                                <small class="form-text text-muted">*Wajib diisi</small>
                            </div>
                            <div class="col-sm-1">
                                <button v-bind:id="rekomendasiTraining.indexOf(rt)" v-on:click="delRekomendasiTraining($event)" class="btn btn-danger" type="button">
                                    Hapus <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                            
                        </div>


                    </div>

                    <button v-if="isEditRekomendasi && rekomendasiTraining.length !== 0" class="btn btn-primary float-sm-left" v-on:click="addRekomendasiTraining">
                        Tambah <i class="fas fa-plus"></i>
                    </button>

                    <br><br><br>


                    <h5>Rekomendasi Lain-lain</h5>

                    

                    <div v-if="rekomendasiPosisi.length === 0" class="no-rekomendasi-posisi">
                        <div v-if="!isEditRekomendasi">
                            <hr>
                            Belum ditambahkan.
                            <br>
                        </div>
                        <button v-if="isEditRekomendasi" class="btn btn-primary float-sm-left" v-on:click="addRekomendasiPosisi">
                            Tambah <i class="fas fa-plus"></i>
                        </button>
                        
                    </div>

                    <div v-if="rekomendasiPosisi.length !== 0" class="rekomendasi-posisi">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Unit Kerja</th>
                                <th scope="col">Jabatan</th>
                            </tr>
                            </thead>
                            <tbody v-for="rp in rekomendasiPosisi">
                            <tr v-if="!isEditRekomendasi">
                                <td v-text="unitKerja.find(x => x.id_unit_kerja == rp.id_unit_kerja).nama_unit_kerja" ></td>
                                <td v-text="posisi.find(x => x.id_posisi == rp.id_posisi).nama_posisi" ></td>
                            </tr>
                            <tr v-if="isEditRekomendasi">
                                <td>
                                    <div class="form-group">
                                        <select class="form-control" v-model="rp.id_unit_kerja">
                                            <option v-for="uk in unitKerja" v-bind:value="uk.id_unit_kerja">
                                                {{ uk.nama_unit_kerja }}
                                            </option>
                                        </select>
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <select class="form-control" v-model="rp.id_posisi">
                                            <option v-for="pos in posisi" v-bind:value="pos.id_posisi">
                                                {{ pos.nama_posisi }}
                                            </option>
                                        </select>
                                        <small class="form-text text-muted">*Wajib diisi</small>
                                    </div>
                                </td>
                                <td>
                                    <button v-bind:id="rekomendasiPosisi.indexOf(rp)" v-on:click="delRekomendasiPosisi($event)" class="btn btn-danger" type="button">
                                        Hapus <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                            <button v-if="isEditRekomendasi" class="btn btn-primary float-sm-left" v-on:click="addRekomendasiPosisi">
                                Tambah <i class="fas fa-plus"></i>
                            </button>
                        </table>

                    </div>

                    <br>

                </div>
            </div>
            <div class="card-footer text-muted" v-if="isEditRekomendasi">
                <a href="#rekomendasi" class="btn btn-success float-sm-right btn-simpan" v-on:click="saveRekomendasi">
                    Simpan <i class="fas fa-check"></i>
                    </a>
                <a href="#rekomendasi" class="btn btn-danger float-sm-right" v-on:click="cancelRekomendasi">
                    Batal <i class ="fas fa-times"></i>
                </a>
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        props: ['id-pmo','id', 'unit-kerja', 'posisi', 'kelompok-kompetensi', 'data-kinerja-temp', 'rekomendasi-training-temp', 'training-list', 'rekomendasi-posisi-temp'],

        data() {
            return {
                
                pegawai: {
                    imageProfileUrl: "",
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
                dataKepegawaianPrev: null,
                riwayatPendidikan: [],
                riwayatPekerjaan: [],  
                sertifikat: [],

                isShowAllDataKinerja: false,
                disableEdit: false,
                isEditProfile: false,
                isEditKepegawaian: false,
                isEditRiwayat: false,
                isEditSertifikat: false,
                isEditDataKinerja: false,
                isEditRekomendasi: false,
                cachedPegawai: null,
                cachedDataKepegawaian: null,
                cachedRiwayatPendidikan: null,
                cachedRiwayatPekerjaan: null,
                cachedSertifikat: null,
                cachedDataKinerja: null,
                cachedRekomendasiTraining: null,
                cachedRekomendasiPosisi:null,
                pegawai: {
                    imageProfileUrl: null,
                    nama: null,
                    tempatLahir: null,
                    tanggalLahir: null,
                    email: null,
                    nopeg: null,
                    unitKerja: {
                        id: null,
                        text: null
                    },
                    posisi: {
                        id: null,
                        text: null   
                    },
                    kompetensi: {
                        id: null,
                        text: null   
                    },
                    tahunMasuk: null
                },
                dataKepegawaian: [],
                riwayatPendidikan: [],
                riwayatPekerjaan: [],
                dataKinerja: [],
                dataKinerjaShow: [],
                rekomendasiTraining : [],
                rekomendasiPosisi : []
            }
               
        },  

        mounted() {
            
        },

        created() {
            //dataKinerja
            this.dataKinerja = this.dataKinerjaTemp;

            axios.get('/api/pegawai/' + this.id)
                .then((response) => {
                    //get data from api response
                    var responsePegawai = response.data["data"];

                    this.dataKepegawaian = responsePegawai["kepegawaian"];
                    this.riwayatPendidikan = responsePegawai["pendidikan"];
                    this.riwayatPekerjaan = responsePegawai["pekerjaan"];
                    this.updateDataKepegawaian();

                    this.dataKepegawaianPrev = this.dataKepegawaian[this.dataKepegawaian.length-1];

                    this.sertifikat = responsePegawai["sertifikat"];
                    this.updateSertifikat();

                    this.pegawai.nama = responsePegawai["user"]["name"];
                    this.pegawai.tempatLahir = responsePegawai["pegawai"]["tempat_lahir"];
                    this.pegawai.tanggalLahir = responsePegawai["pegawai"]["tanggal_lahir"];
                    this.pegawai.email = responsePegawai["user"]["email"];
                    this.pegawai.nopeg = responsePegawai["pegawai"]["nip"];
                    this.pegawai.imageProfileUrl = 'pimage/' + responsePegawai["pegawai"]["nip"] + '.' + responsePegawai["pegawai"]["ekstensi_foto"];
                    this.pegawai.kompetensi.id = responsePegawai["pegawai"]["id_kelompok_kompetensi"];
                    this.updateProfilPegawai();

                    //chacing
                    this.cachedPegawai = JSON.parse(JSON.stringify(this.pegawai));
                    this.cachedDataKepegawaian = JSON.parse(JSON.stringify(this.dataKepegawaian));
                    this.cachedRiwayatPendidikan = JSON.parse(JSON.stringify(this.riwayatPendidikan));
                    this.cachedRiwayatPekerjaan = JSON.parse(JSON.stringify(this.riwayatPekerjaan));
                    this.cachedSertifikat = JSON.parse(JSON.stringify(this.sertifikat));
                    this.cachedDataKinerja = JSON.parse(JSON.stringify(this.dataKinerja));

                    console.log(this);
                })
                .catch(function (error) {
                    console.log(error);
                    alert('Gagal mengambil data');
                });

            //caching others
            this.cachedDataKinerja = JSON.parse(JSON.stringify(this.dataKinerja));
            
            // init dataKinerjaShow
            if (this.dataKinerja.length > 6) {
                this.dataKinerjaShow = this.dataKinerja.slice(this.dataKinerja.length-6);
            } else {
                this.dataKinerjaShow = this.dataKinerja;
            }

            //init rekomendasiTraining
            this.rekomendasiTraining = this.rekomendasiTrainingTemp;
            this.cachedRekomendasiTraining = JSON.parse(JSON.stringify(this.rekomendasiTraining));

            //init rekomendasiPosisi
            this.rekomendasiPosisi = this.rekomendasiPosisiTemp;
            this.cachedRekomendasiPosisi = JSON.parse(JSON.stringify(this.rekomendasiPosisi));
        },

        methods: {
            downloadKompetensi() {
                window.open('/api/kompetensi/report/' + this.id);
            },

            editKommpetensi() {
                window.open('/pages/pmo?nip=' + this.pegawai.nopeg + '&tab=dataKompetensi');
            },

            showAllDataKinerja() {
                this.isShowAllDataKinerja = true;
                this.dataKinerjaShow = this.dataKinerja;
            },

            hideDataKinerja() {
                this.isShowAllDataKinerja = false;
                
                if (this.dataKinerja.length > 6) {
                    this.dataKinerjaShow = this.dataKinerja.slice(this.dataKinerja.length-6);
                }
            },

            updateProfilPegawai() {
                if (this.pegawai.unitKerja.id != null) {
                    this.pegawai.unitKerja.text = this.unitKerja.find(x => x.id_unit_kerja == this.pegawai.unitKerja.id).nama_unit_kerja;
                } else {
                    this.pegawai.unitKerja.text = null;
                }
                
                if (this.pegawai.kompetensi.id != null) {
                    this.pegawai.kompetensi.text = this.kelompokKompetensi.find(x => x.id_kelompok_kompetensi == this.pegawai.kompetensi.id).nama_kelompok_kompetensi;
                } else {
                    this.pegawai.kompetensi.text = null;
                }
                    
                if (this.pegawai.posisi.id != null) {
                    this.pegawai.posisi.text = this.posisi.find(x => x.id_posisi == this.pegawai.posisi.id).nama_posisi;
                } else {
                    this.pegawai.posisi.text = null;
                }
            },

            updateDataKepegawaian() {
                
                //update relevan
                if (this.dataKepegawaian.length == 0) {
                    this.pegawai.unitKerja.id = null;
                    this.pegawai.posisi.id = null;
                    // this.pegawai.kompetensi.id = null;
                    this.pegawai.tahunMasuk = null;
                } else {
                    //sort
                    this.dataKepegawaian.sort(function(a, b){
                        var keyA = a.tahun_masuk,
                            keyB = b.tahun_masuk;
                        // Compare the 2 dates
                        if(keyA < keyB) return -1;
                        if(keyA > keyB) return 1;
                        return 0;
                    });
                    var lastDataPegawai = this.dataKepegawaian[this.dataKepegawaian.length-1];
                    this.pegawai.unitKerja.id = lastDataPegawai["id_unit_kerja"];
                    this.pegawai.posisi.id = lastDataPegawai["id_posisi"];
                    // this.pegawai.kompetensi.id = lastDataPegawai["id_kelompok_kompetensi"];
                    this.pegawai.tahunMasuk = lastDataPegawai["tahun_masuk"];
                }
            },

            updateDataKepegawaianAfterEditProfile() {
                
                //update relevan
                if (this.dataKepegawaian.length == 0) {
                    var newData = {
                        id_data_kepegawaian : null,
                        id_pegawai : null,
                        id_unit_kerja : this.pegawai.unitKerja.id,
                        id_posisi : this.pegawai.posisi.id,
                        // id_kelompok_kompetensi : this.pegawai.kompetensi.id,
                        tahun_masuk : this.pegawai.tahunMasuk,
                        tahun_keluar : null
                    };
                    this.dataKepegawaian.push(newData);
                } else {
                    //sort
                    this.dataKepegawaian.sort(function(a, b){
                        var keyA = a.tahun_masuk,
                            keyB = b.tahun_masuk;
                        // Compare the 2 dates
                        if(keyA < keyB) return -1;
                        if(keyA > keyB) return 1;
                        return 0;
                    });
                    var lastDataPegawai = this.dataKepegawaian[this.dataKepegawaian.length-1];
                    lastDataPegawai["id_unit_kerja"] = this.pegawai.unitKerja.id;
                    lastDataPegawai["id_posisi"] = this.pegawai.posisi.id;
                    // lastDataPegawai["id_kelompok_kompetensi"] = this.pegawai.kompetensi.id;
                    lastDataPegawai["tahun_masuk"] = this.pegawai.tahunMasuk;
                }
            },

            updateSertifikat(){
                for(var i = 0; i < this.sertifikat.length; i++){
                    this.sertifikat[i].nama_file = 'simage/' + this.sertifikat[i].nama_file;
                }
            },

            disableEditButton() {
                this.disableEdit = true;
            },

            enableEditButton() {
                this.disableEdit = false;
            },

            editProfilPegawai() {
                this.isEditProfile = true;
                this.disableEditButton();
            },

            editDataKepegawaian() {
                this.isEditKepegawaian = true;
                this.disableEditButton();
            },

            editRiwayatPegawai() {
                this.isEditRiwayat = true;
                this.disableEditButton();
            },

            editSertifikat() {
                this.isEditSertifikat = true;
                this.disableEditButton();
            },

            editDataKinerja() {
                this.isEditDataKinerja = true;
                this.disableEditButton();
            },

            editDataKompetensi() {

            },

            editRekomendasi() {
                this.isEditRekomendasi = true;
                this.disableEditButton();
            },

            addDataKepegawaian() {
                var newData = {
                    id_data_kepegawaian : null,
                    id_pegawai : null,
                    id_unit_kerja : null,
                    id_posisi : null,
                    // id_kelompok_kompetensi : null,
                    tahun_masuk : null,
                    tahun_keluar : null
                };
                this.dataKepegawaian.push(newData);
            },

            addRiwayatPendidikan() {
                var newData = {
                    id_riwayat_pendidikan : null,
                    id_pegawai : null,
                    nama_institusi : null,
                    strata : null,
                    jurusan : null,
                    tahun_masuk : null,
                    tahun_keluar : null
                };
                this.riwayatPendidikan.push(newData);
            },

            addRiwayatPekerjaan() {
                var newData = {
                    id_riwayat_pekerjaan : null,
                    id_pegawai : null,
                    nama_institusi : null,
                    posisi : null,
                    tahun_masuk : null,
                    tahun_keluar : null
                };
                this.riwayatPekerjaan.push(newData);
            },

            addSertifikat() {
                var newData = {
                    id_sertifikat : null,
                    id_pegawai : null,
                    judul : null,
                    lembaga : null,
                    tahun_diterbitkan : null,
                    catatan : null,
                    nama_file : null,
                };
                this.sertifikat.push(newData);
            },

            addDataKinerja() {
                var newData = {
                    id_kinerja : null,
                    id_pegawai : null,
                    tahun : null,
                    semester : null,
                    nilai : null,
                    catatan : null
                };
                this.dataKinerja.push(newData);
            },

            addRekomendasiTraining() {
                var newData = {
                    id_rekomendasi_training : null,
                    id_pegawai : null,
                    id_training : null
                };
                this.rekomendasiTraining.push(newData);
            },

            addRekomendasiPosisi() {
                var newData = {
                    id_rekomendasi_posisi : null,
                    id_pegawai : null,
                    id_unit_kerja : null,
                    id_posisi : null
                };
                this.rekomendasiPosisi.push(newData);
            },

            delDataKepegawaian(event) {
                var targetIndex = event.currentTarget.id;
                this.dataKepegawaian.splice(targetIndex, 1);
            },

            delRiwayatPendidikan(event) {
                var targetIndex = event.currentTarget.id;
                this.riwayatPendidikan.splice(targetIndex, 1);
            },

            delRiwayatPekerjaan(event) {
                var targetIndex = event.currentTarget.id;
                this.riwayatPekerjaan.splice(targetIndex, 1);
            },

            delSertifikat(event) {
                var targetIndex = event.currentTarget.id;
                this.sertifikat.splice(targetIndex, 1);
            },

            delDataKinerja(event) {
                var targetIndex = event.currentTarget.id;
                this.dataKinerja.splice(targetIndex, 1);
            },

            delRekomendasiTraining(event) {
                var targetIndex = event.currentTarget.id;
                this.rekomendasiTraining.splice(targetIndex, 1);
            },

            delRekomendasiPosisi(event) {
                var targetIndex = event.currentTarget.id;
                this.rekomendasiPosisi.splice(targetIndex, 1);
            },

            saveProfilPegawai() {
                this.enableEditButton();

                this.updateProfilPegawai();
                this.updateDataKepegawaianAfterEditProfile();

                this.cachedPegawai = JSON.parse(JSON.stringify(this.pegawai));
                this.isEditProfile = false;

                axios.post('/api/pegawai/' + this.id, {
                    pegawai: this.pegawai,
                    data_kepegawaian: this.dataKepegawaian,
                    data_kepegawaian_prev: this.dataKepegawaianPrev,
                    _method: "put"
                })
                .then(function (response) {
                    console.log(response);
                    window.location.href = '/pages/profile/' + this.id;
                })
                .catch(function (error) {
                    console.log(error);
                    alert('Semua kolom harus terisi');
                });

                console.log(this.dataKepegawaian);

            },

            saveDataKepegawaian() {
                this.updateDataKepegawaian();
                this.updateProfilPegawai();
                this.enableEditButton();
                this.cachedDataKepegawaian = JSON.parse(JSON.stringify(this.dataKepegawaian));
                this.isEditKepegawaian = false;

                console.log(this.dataKepegawaian);

                axios.post('/api/kepegawaian/' + this.id, {
                    kepegawaian: this.dataKepegawaian,
                    _method: 'put'
                })
                .then(function (response) {
                    console.log(response);
                    window.location.href = "/pages/profile/" + this.id;
                })
                .catch(function (error) {
                    console.log(error);
                    alert('Semua kolom harus terisi');
                });
            },

            saveRiwayatPegawai() {
                //sort
                this.riwayatPendidikan.sort(function(a, b){
                        var keyA = a.tahun_masuk,
                            keyB = b.tahun_masuk;
                        // Compare the 2 dates
                        if(keyA < keyB) return -1;
                        if(keyA > keyB) return 1;
                        return 0;
                    });

                //sort
                this.riwayatPekerjaan.sort(function(a, b){
                        var keyA = a.tahun_masuk,
                            keyB = b.tahun_masuk;
                        // Compare the 2 dates
                        if(keyA < keyB) return -1;
                        if(keyA > keyB) return 1;
                        return 0;
                    });

                this.enableEditButton();
                this.cachedRiwayatPendidikan = JSON.parse(JSON.stringify(this.riwayatPendidikan));
                this.cachedRiwayatPekerjaan = JSON.parse(JSON.stringify(this.riwayatPekerjaan));
                this.isEditRiwayat = false;

                console.log(this.riwayatPendidikan);
                console.log(this.riwayatPekerjaan);

                axios.post('/api/riwayat/' + this.id, {
                    pendidikan: this.riwayatPendidikan,
                    pekerjaan: this.riwayatPekerjaan,
                    _method: 'put'
                })
                .then(function (response) {
                    console.log(response);
                    window.location.href = "/pages/profile/" + this.id;
                })
                .catch(function (error) {
                    console.log(error);
                    alert('Semua kolom harus terisi');
                });
            },

            saveSertifikat() {
                this.enableEditButton();
                this.cachedSertifikat = JSON.parse(JSON.stringify(this.sertifikat));
                this.isEditSertifikat = false;
                console.log(this.sertifikat);

                axios.post('/api/sertifikat/' + this.id, {
                    sertifikat: this.sertifikat,
                    _method: 'put'
                })
                .then(function (response) {
                    console.log(response);
                    // window.location.href = "/pages/profile/" + response.data.data;
                })
                .catch(function (error) {
                    console.log(error);
                    alert('Semua kolom harus terisi');
                });

                axios.post('/api/lastedited/' + this.id, {
                    id_pengubah: this.idPmo,
                    _method: 'put'
                })
                .then(function (response) {
                    console.log(response);
                    location.reload();
                    // window.location.href = "/pages/profile/" + this.id;
                })
                .catch(function (error) {
                    console.log(error);
                    alert(error);
                    alert('Semua kolom harus terisi');
                });
            },

            saveDataKinerja() {
                //sort
                this.dataKinerja.sort(function(a, b){
                        var keyA = a.tahun,
                            keyB = b.tahun;
                        // Compare the 2 dates
                        if(keyA < keyB) return -1;
                        if(keyA > keyB) return 1;
                        if (keyA == keyB) {
                            if (a.semester < b.semester) return -1;
                            else return 1;
                        }
                    });

                this.enableEditButton();
                this.cachedDataKinerja = JSON.parse(JSON.stringify(this.dataKinerja));
                this.isEditDataKinerja = false;

                if (this.isShowAllDataKinerja) {
                    this.showAllDataKinerja();
                } else {
                    this.hideDataKinerja();
                }

                axios.post('/api/savekinerja/' + this.id, {
                    kinerja: this.dataKinerja,
                    _method: 'put'
                })
                .then(function (response) {
                    console.log(response);
                    // window.location.href = "/pages/profile/" + this.id;
                })
                .catch(function (error) {
                    console.log(error);
                    alert(error);
                    alert('Semua kolom harus terisi');
                });

                axios.post('/api/lastedited/' + this.id, {
                    id_pengubah: this.idPmo,
                    _method: 'put'
                })
                .then(function (response) {
                    console.log(response);
                    location.reload();
                    // window.location.href = "/pages/profile/" + this.id;
                })
                .catch(function (error) {
                    console.log(error);
                    alert(error);
                    alert('Semua kolom harus terisi');
                });
            },

            saveRekomendasi() {
                this.enableEditButton();
                this.cachedRekomendasiTraining = JSON.parse(JSON.stringify(this.rekomendasiTraining));
                this.cachedRekomendasiPosisi = JSON.parse(JSON.stringify(this.rekomendasiPosisi));
                this.isEditRekomendasi = false;

                axios.post('/api/rekomendasi/' + this.id, {
                    training: this.rekomendasiTraining,
                    posisi: this.rekomendasiPosisi,
                    _method: 'put'
                })
                .then(function (response) {
                    console.log(response);
                    // window.location.href = "/pages/profile/" + this.id;
                })
                .catch(function (error) {
                    console.log(error);
                    alert(error);
                    alert('Semua kolom harus terisi');
                });

                axios.post('/api/lastedited/' + this.id, {
                    id_pengubah: this.idPmo,
                    _method: 'put'
                })
                .then(function (response) {
                    console.log(response);
                    location.reload();
                    // window.location.href = "/pages/profile/" + this.id;
                })
                .catch(function (error) {
                    console.log(error);
                    alert(error);
                    alert('Semua kolom harus terisi');
                });
            },


            /////

            cancelProfilPegawai() {
                this.enableEditButton();
                this.pegawai = JSON.parse(JSON.stringify(this.cachedPegawai));
                this.isEditProfile = false;
            },

            cancelDataKepegawaian() {
                this.enableEditButton();
                this.dataKepegawaian = JSON.parse(JSON.stringify(this.cachedDataKepegawaian));
                this.isEditKepegawaian = false;
            },

            cancelRiwayatPegawai() {
                this.enableEditButton();
                this.riwayatPendidikan = JSON.parse(JSON.stringify(this.cachedRiwayatPendidikan));
                this.riwayatPekerjaan = JSON.parse(JSON.stringify(this.cachedRiwayatPekerjaan));
                this.isEditRiwayat = false;
            },

            cancelSertifikat() {
                this.enableEditButton();
                this.sertifikat = JSON.parse(JSON.stringify(this.cachedSertifikat));
                this.isEditSertifikat = false;
            },

            cancelDataKinerja() {
                this.enableEditButton();
                this.dataKinerja = JSON.parse(JSON.stringify(this.cachedDataKinerja));
                this.isEditDataKinerja = false;

                if (this.isShowAllDataKinerja) {
                    this.showAllDataKinerja();
                } else {
                    this.hideDataKinerja();
                }
            },

            cancelRekomendasi() {
                this.enableEditButton();
                this.rekomendasiTraining = JSON.parse(JSON.stringify(this.cachedRekomendasiTraining));
                this.rekomendasiPosisi = JSON.parse(JSON.stringify(this.cachedRekomendasiPosisi));
                this.isEditRekomendasi = false;
            },

            FileChangeProfile(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;

                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.pegawai.imageProfileUrl = e.target.result;
                };
                reader.readAsDataURL(files[0]);
            },

            FileChangeSertifikat(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;

                var idx = e.currentTarget.id;

                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.sertifikat[idx].nama_file = e.target.result;
                };
                reader.readAsDataURL(files[0]);
            },
        }
    }
</script>

<style>

</style>