<template>
    <div>
        <div class="card" id="profil-pegawai">
            <div class="card-header">
                Profil Pegawai
                <button class="btn btn-primary float-sm-right" v-on:click="editProfilPegawai" v-bind:disabled="disableEdit">
                    Edit <i class="fas fa-edit"></i>
                </button>
            </div>

            <div class="card-body">
                <div class="card-container">
                    <div class="row">
                        <div class="col-sm-3 img-responsive">
                            <img id="img-profile" v-bind:src="pegawai.imageProfileUrl" class="img-thumbnail">
                            <br><br>
                            <button v-if="isEditProfile" type="button" class="btn btn-primary">Ganti Foto</button>
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
                                        <!-- <input v-bind:value="unitKerja.find(x => x.id_unit_kerja == pegawai.unitKerja).nama_unit_kerja" type="text" class="form-control" disabled> -->
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
                                        <!-- <input v-bind:value="posisi.find(x => x.id_posisi == pegawai.posisi).nama_posisi" type="text" class="form-control" disabled> -->
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
                                        <!-- <input v-bind:value="kelompokKompetensi.find(x => x.id_kelompok_kompetensi == pegawai.kompetensi).nama_kelompok_kompetensi" type="text" class="form-control"> -->
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
                <a href="#profil-pegawai" class="btn btn-success float-sm-right btn-simpan" v-on:click="saveProfilPegawai">
                    Simpan <i class="fas fa-check"></i>
                    </a>
                <a href="#profil-pegawai" class="btn btn-danger float-sm-right" v-on:click="cancelProfilPegawai">
                    Batal <i class ="fas fa-times"></i>
                </a>
            </div>
        </div>

        <br>

        <div class="card" id="data-kepegawaian">
            <div class="card-header">
                Data Kepegawaian
                <button class="btn btn-primary float-sm-right" v-on:click="editDataKepegawaian" v-bind:disabled="disableEdit">
                    Edit <i class="fas fa-edit"></i>
                </button>
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
                Riwayat Pendidikan dan Pekerjaan<button class="btn btn-primary float-sm-right" v-on:click="editRiwayatPegawai" v-bind:disabled="disableEdit">
                    Edit <i class="fas fa-edit"></i>
                    </button>
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
                        <table class="table" align="left">
                            <tbody v-for="dk in sertifikat">
                            <div v-if="!isEditSertifikat">
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
                                    <br>
                                    <div v-if="dk.nama_file !== NULL">
                                        <button v-bind:id="sertifikat.indexOf(dk)" v-on:click="delSertifikat($event)" class="btn btn-primary" type="button">
                                            Ganti Foto
                                        </button>
                                    </div>
                                    <div v-if="dk.nama_file == NULL">
                                        <button v-bind:id="sertifikat.indexOf(dk)" v-on:click="delSertifikat($event)" class="btn btn-primary" type="button">
                                            Tambah Foto
                                        </button>
                                    </div>
                                </td>
                                <td rowspan="4">
                                    <img id="img-sertifikat-1" v-bind:src="dk.nama_file" class="img-thumbnail" width="200">
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
                            <tbody v-for="dk in dataKinerja">
                            <tr v-if="!isEditDataKinerja">
                                <td v-text="dk.tahun" ></td>
                                <td v-text="dk.semester" ></td>
                                <td v-text="dk.nilai" ></td>
                                <td v-text="dk.catatan" ></td>
                            </tr>

                            <tr v-if="isEditDataKinerja">
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
                Hasil Kompetensi
            </div>

            <div class="card-body">
                <div class="container">

                    Belum ditambahkan.

                </div>
            </div>
        </div>

        <br>

        <div class="card" id="rekomendasi">
            <div class="card-header">
                Rekomendasi
            </div>

            <div class="card-body">
                <div class="container">

                    <h5>Rekomendasi Training</h5>

                    <div v-if="rekomendasiTraining.length === 0" class="no-rekomendasi-trainiing">
                        <hr>
                        Belum dimtambahkan.
                        <br>
                    </div>

                    <div v-if="rekomendasiTraining.length !== 0" class="rekomendasi-trainiing">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Nama Training</th>
                                <th scope="col">Penyelenggara</th>
                                <th scope="col">Bidang</th>
                            </tr>
                            </thead>
                            <tbody v-for="rp in rekomendasiTraining">
                            <tr>
                                <td v-text="rp.namaTraining" ></td>
                                <td v-text="rp.penyelenggara" ></td>
                                <td v-text="rp.bidang" ></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>

                    <br><br>


                    <h5>Rekomendasi Lain-lain</h5>

                    <hr>

                    Tidak ada.

                </div>
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        props: ['id', 'kinerja', 'unit-kerja', 'posisi', 'kelompok-kompetensi'],

        data() {
            return {
                //dummy
                dataKinerja: [
                    {tahun : 2010, semester:1, nilai:2.50, catatan:"ini catatan"}
                ],
                sertifikat: [
                    {
                        judul : "Personal Care Worker",
                        lembaga : "Harvard University",
                        tahun_diterbitkan : 1990,
                        catatan: "Ex numquam perspiciatis impedit fugit quam id. Harum et eos iure consequatur. Itaque inventore quia aut velit.",
                        nama_file: "simage/" + "harvard.jpg",
                    },
                    {
                        judul : "Best Pilot",
                        lembaga : "NASA",
                        tahun_diterbitkan : 2010,
                        catatan: "Ex numquam perspiciatis impedit fugit quam id. Harum et eos iure consequatur. Itaque inventore quia aut velit.",
                        nama_file: "simage/" + "nasa.jpg",
                    }
                ],
                rekomendasiTraining : [],
                ////////   

                disableEdit: false,
                isEditProfile: false,
                isEditKepegawaian: false,
                isEditRiwayat: false,
                isEditSertifikat: false,
                isEditDataKinerja: false,
                cachedPegawai: null,
                cachedDataKepegawaian: null,
                cachedRiwayatPendidikan: null,
                cachedRiwayatPekerjaan: null,
                cachedSertifikat: null,
                cachedDataKinerja: null,
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
                riwayatPekerjaan: []
            }
               
        },  

        mounted() {
            
        },

        created() {

            axios.get('/api/pegawai/' + this.id)
                .then((response) => {
                    //get data from api response
                    var responsePegawai = response.data["data"];

                    this.dataKepegawaian = responsePegawai["kepegawaian"];
                    this.riwayatPendidikan = responsePegawai["pendidikan"];

                    this.riwayatPekerjaan = responsePegawai["pekerjaan"];
                    this.updateDataKepegawaian();

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

                })
                .catch(function (error) {
                    console.log(error);
                });

            //caching others
            this.cachedDataKinerja = JSON.parse(JSON.stringify(this.dataKinerja));
            this.cachedSertifikat = JSON.parse(JSON.stringify(this.sertifikat));
            
        },

        methods: {
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
                    id_riwayat_pendidikan : null,
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

            saveProfilPegawai() {
                this.enableEditButton();

                this.updateProfilPegawai();
                this.updateDataKepegawaianAfterEditProfile();

                this.cachedPegawai = JSON.parse(JSON.stringify(this.pegawai));
                this.isEditProfile = false;

                // axios.patch('/api/pegawai/4', {
                //     name: this.user.nama,
                //     email: this.user.email,
                //     password: '1234',
                //     nip: this.user.nopeg
                // })
                // .then(function (response) {
                //     alert(response);
                // })
                // .catch(function (error) {
                //     alert(error);
                // });

            },

            saveDataKepegawaian() {
                this.updateDataKepegawaian();
                this.updateProfilPegawai();
                this.enableEditButton();
                this.cachedDataKepegawaian = JSON.parse(JSON.stringify(this.dataKepegawaian));
                this.isEditKepegawaian = false;

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

                
            },

            saveSertifikat() {
                //sort
                
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
            },

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
            }
        }
    }
</script>

<style>

</style>