@extends('layout-profile.master')

@section('content')

    <br>

<profil-pegawai-specific
    id="{{ $id }}"
    :data-kinerja-temp="{{ $data_kinerja }}"
    :unit-kerja="{{ $unit_kerja }}"
    :posisi="{{ $posisi }}"
    :kelompok-kompetensi="{{ $kelompok_kompetensi }}"
    :rekomendasi-training-temp="{{ $rekomendasi_training }}"
    :training-list="{{ $training_list }}"
    :rekomendasi-posisi-temp="{{ $rekomendasi_posisi }}"
></profil-pegawai-specific>

    <br>

@endsection