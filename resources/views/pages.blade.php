@extends('layouts.app')

@section('content')
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Landing Page</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>

            .full-height {
                height: 80vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 24px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                text-align: center;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="row">
                @if(Auth::check())
                <div class="col">
                    <a href="/pages/profile">
                        <img src="/icons/pegawai.png" alt="Profile">
                    </a>
                    <div class="links">
                        <a href="/pages/profile">Profil</a>
                    </div>
                </div>
                @endif
                @if(Auth::check())
                    @if(\App\PMO::find(Auth::user()->id))
                        <div class="col">
                            <a href="/pages/pmo">
                                <img src="/icons/pmo.png" alt="PMO">
                            </a>
                            <div class="links">
                                <a href="/pages/pmo">PMO</a>
                            </div>
                        </div>
                    @endif
                @endif

                @if(Auth::check())
                    @if(\App\Pegawai::find(Auth::user()->id))
                        <div class="col">
                            <a href="/pages/admin">
                                <img src="/icons/admin.png" alt="Admin">
                            </a>
                            <div class="links">
                                <a href="/pages/admin">Admin</a>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
