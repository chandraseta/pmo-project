@extends('layout-profile.master')

@section('content')

    <profil-pegawai id="{{ Auth::user()->id}}"></profil-pegawai>

    <br>

    {{-- <div class="card">
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
    </div> --}}

    <br>

@endsection