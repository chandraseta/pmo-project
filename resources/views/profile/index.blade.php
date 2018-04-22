@extends('layout-profile.master')

@section('content')

    <br>

<profil-pegawai
    id="{{ Auth::user()->id}}"
    :kinerja="{{ $kinerja }}"
    :unit-kerja="{{ $unit_kerja }}"
></profil-pegawai>

    <br>


    {{-- 

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