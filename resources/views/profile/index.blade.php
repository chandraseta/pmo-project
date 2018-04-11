@extends('layout-profile.master')

@section('content')

    <div class="card">
        <div class="card-header">
            Profil Pegawai<a href="#" class="btn btn-primary float-sm-right" v-on:click="editProfilPegawai">Edit</a>
        </div>

        <div class="card-body">
            <div class="card-container">
                <div class="row">
                    <div class="col-sm-3 img-responsive">
                        <img id="img-profile" v-bind:src="user.imageProfileUrl" class="img-thumbnail">
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

                                <b v-if="!isEditProfile" v-text="user.nama"></b>

                                <div id="edit-nama" class="form-group" v-if="isEditProfile">
                                    <input v-model="user.nama" type="text" class="form-control">
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
                                <b v-if="!isEditProfile"><span v-text="user.tempatLahir"></span>, <span v-text="user.tanggalLahir"></span></b>

                                <div class="form-row" v-if="isEditProfile">
                                    <div id="edit-tempat-lahir" class="form-group">
                                        <input v-model="user.tempatLahir" type="text" class="form-control">
                                        <small class="form-text text-muted">*Tempat lahir. Wajib diisi</small>
                                    </div>
                                    <div id="edit-tanggal-lahir" class="form-group">
                                        <input v-model="user.tanggalLahir" type="text" class="form-control">
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
                                <b v-if="!isEditProfile" v-text="user.email"></b>

                                <div v-if="isEditProfile" id="edit-email" class="form-group">
                                    <input v-model="user.email" type="email" class="form-control">
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
                                <b v-if="!isEditProfile" v-text="user.nopeg"></b>

                                <div v-if="isEditProfile" id="edit-nopeg" class="form-group">
                                    <input v-model="user.nopeg" type="text" class="form-control">
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
                                <b v-if="!isEditProfile" v-text="user.unitKerja"></b>

                                <div v-if="isEditProfile" id="edit-unit-kerja" class="form-group">
                                    <input v-model="user.unitKerja" type="text" class="form-control">
                                    <small class="form-text text-muted">*Wajib diisi</small>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-3 text-right">
                                Posisi
                            </div>
                            <div class="col-sm-9">
                                <b v-if="!isEditProfile" v-text="user.posisi"></b>

                                <div v-if="isEditProfile" id="edit-posisi" class="form-group">
                                    <input v-model="user.posisi" type="text" class="form-control">
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
                                <b v-if="!isEditProfile" v-text="user.kompetensi"></b>

                                <div v-if="isEditProfile" id="edit-kompetensi" class="form-group">
                                    <input v-model="user.kompetensi" type="text" class="form-control">
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
                                <b v-if="!isEditProfile" v-text="user.tahunMasuk"></b>

                                <div v-if="isEditProfile" id="edit-tahun-masuk" class="form-group">
                                    <input v-model="user.tahunMasuk" type="text" class="form-control">
                                    <small class="form-text text-muted">*Wajib diisi</small>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-3 text-right">
                                Tahun Keluar
                            </div>
                            <div class="col-sm-9">
                                <b v-if="!isEditProfile" v-text="user.tahunKeluar"></b>

                                <div v-if="isEditProfile" id="edit-tahun-keluar" class="form-group">
                                    <input v-model="user.tahunKeluar" type="text" class="form-control">
                                    <small class="form-text text-muted">*Wajib diisi</small>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer text-muted" v-if="isEditProfile">
            <a href="#" class="btn btn-success float-sm-right btn-simpan" v-on:click="saveProfilPegawai">Simpan</a>
            <a href="#" class="btn btn-danger float-sm-right" v-on:click="cancelProfilPegawai">Batal</a>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-header">
            Data Kepegawaian<a href="#" class="btn btn-primary float-sm-right" v-on:click="editDataKepegawaian">Edit</a>
        </div>

        <div class="card-body">
            <div class="container">

                <div v-if="dataKepegawaian.length === 0" class="no-data-kepegawaian">
                    <hr>
                    Belum ditambahkan.
                    <br>
                </div>

                <div v-if="dataKepegawaian.length !== 0" class="data-kepegawaian">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Unit Kerja</th>
                            <th scope="col">Posisi</th>
                            <th scope="col">Kompetensi</th>
                            <th scope="col">Tahun Masuk</th>
                            <th scope="col">Tahun Keluar</th>
                        </tr>
                        </thead>
                        <tbody v-for="dk in dataKepegawaian">
                        <tr>
                            <td v-text="dk.unitKerja" ></td>
                            <td v-text="dk.posisi" ></td>
                            <td v-text="dk.kompetensi" ></td>
                            <td v-text="dk.tahunMasuk" ></td>
                            <td v-text="dk.tahunKeluar" ></td>
                            <td v-if="isEditKepegawaian"><button class="btn btn-danger" type="button">Hapus</button></td>
                        </tr>
                        </tbody>
                    </table>

                </div>

                <br>

            </div>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-header">
            Riwayat Pendidikan dan Pekerjaan<a href="#" class="btn btn-primary float-sm-right" v-on:click="editRiwayatPegawai">Edit</a>
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
                            <td v-text="rp.tingkatPendidikan" ></td>
                            <td v-text="rp.namaInstitusi" ></td>
                            <td v-text="rp.jurusan" ></td>
                            <td v-text="rp.tahunMasuk" ></td>
                            <td v-text="rp.tahunKeluar" ></td>
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
                            <td v-text="rp.namaInstitusi" ></td>
                            <td v-text="rp.posisi" ></td>
                            <td v-text="rp.tahunMasuk" ></td>
                            <td v-text="rp.tahunKeluar" ></td>
                        </tr>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-header">
            Hasil Kinerja
        </div>

        <div class="card-body">
            <div class="container">

                Belum ditambahkan.

            </div>
        </div>
    </div>

    <br>

    <div class="card">
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

    <div class="card">
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


                <h5>Rekomendasi Posisi</h5>

                <hr>

                Tidak ada.

            </div>
        </div>
    </div>

    <br>

@endsection