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
                        <img id="img-profile" v-bind:src="imageProfileUrl" class="img-thumbnail">
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-7">
                        <div class="row">
                            <div class="col-sm-3 text-right">
                                Nama
                            </div>
                            <div class="col-sm-5">

                                <b v-if="!isEditProfile" v-text="nama"></b>

                                <div id="edit-nama" class="form-group" v-if="isEditProfile">
                                    <input v-model="nama" type="text" class="form-control">
                                    <small class="form-text text-muted">*Wajib diisi</small>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-3 text-right">
                                Tempat, Tanggal Lahir
                            </div>
                            <div class="col-sm-5">
                                <b><span v-text="tempatLahir"></span>, <span v-text="tanggalLahir"></span></b>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-3 text-right">
                                Email
                            </div>
                            <div class="col-sm-5">
                                <b v-text="email"></b>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-3 text-right">
                                No. Pegawai
                            </div>
                            <div class="col-sm-5">
                                <b v-text="nopeg"></b>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-3 text-right">
                                Unit Kerja
                            </div>
                            <div class="col-sm-5">
                                <b v-text="unitKerja"></b>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-3 text-right">
                                Posisi
                            </div>
                            <div class="col-sm-5">
                                <b v-text="posisi"></b>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-3 text-right">
                                Kompetensi
                            </div>
                            <div class="col-sm-5">
                                <b v-text="kompetensi"></b>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-3 text-right">
                                Tahun Masuk
                            </div>
                            <div class="col-sm-5">
                                <b v-text="tahunMasuk"></b>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-3 text-right">
                                Tahun Keluar
                            </div>
                            <div class="col-sm-5">
                                <b v-text="tahunKeluar"></b>
                            </div>
                        </div>

                    </div>
                </div>
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

                <div v-if="isRiwayatPendidikanEmpty" class="no-riwayat-pendidikan">
                    <hr>
                    Belum dimtambahkan.
                    <br>
                </div>

                <div v-if="!isRiwayatPendidikanEmpty" class="riwayat-pendidikan">
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

                <div v-if="isRiwayatPekerjaanEmpty" class="no-riwayat-pekerjaan">
                    <hr>
                    Belum dimtambahkan.
                    <br>
                </div>

                <div v-if="!isRiwayatPekerjaanEmpty" class="riwayat-pekerjaan">
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

                <div v-if="isRekomendasiTrainingEmpty" class="no-rekomendasi-trainiing">
                    <hr>
                    Belum dimtambahkan.
                    <br>
                </div>

                <div v-if="!isRekomendasiTrainingEmpty" class="rekomendasi-trainiing">
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