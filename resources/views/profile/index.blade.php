@extends('layout-profile.master')

@section('content')

    <div class="card">
        <div class="card-header">
            Profil Pegawai<a href="#" class="btn btn-primary float-sm-right">Edit</a>
        </div>

        <div class="card-body">
            <div class="card-container">
                <div class="row">
                    <div class="col-sm-3 img-responsive">
                        <img id="img-profile" src="https://i.pinimg.com/236x/34/ba/c1/34bac13dd65ab3b81267f727e5633549--patrick-dempsey-handsome-man.jpg" class="img-thumbnail">
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-7">
                        <div class="row">
                            <div class="col-sm-3 text-right">
                                Nama
                            </div>
                            <div class="col-sm-5">
                                <b>Joko Susilo</b>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-3 text-right">
                                No. Pegawai
                            </div>
                            <div class="col-sm-5">
                                <b>12349200022</b>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-3 text-right">
                                Tempat, Tanggal Lahir
                            </div>
                            <div class="col-sm-5">
                                <b>Bandung, 17 Agustus 1962</b>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-3 text-right">
                                Email
                            </div>
                            <div class="col-sm-5">
                                <b>joko.susilo@gmail.com</b>
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
            Riwayat Pendidikan dan Pekerjaan<a href="#" class="btn btn-primary float-sm-right">Edit</a>
        </div>

        <div class="card-body">
            <div class="container">

                

            </div>
        </div>
    </div>



@endsection