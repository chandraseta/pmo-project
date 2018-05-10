@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="flash-message">
                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(session()->has('alert-' . $msg))
                            <p class="alert alert-{{ $msg }}">{{ session()->get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                    @endforeach
                    @if ($errors->has('email'))
                        <p class="alert alert-danger">
                            <strong>{{ $errors->first('email') }}</strong> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </p>
                    @endif
                    @if ($errors->has('nip'))
                        <p class="alert alert-danger">
                            <strong>{{ $errors->first('nip') }}</strong> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </p>
                    @endif
                </div>
                <div class="card">
                    <div class="card-header">{{ __('Tambah User') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama Lengkap') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Alamat Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nip" class="col-md-4 col-form-label text-md-right">{{ __('NIP/Nopeg') }}</label>

                                <div class="col-md-6">
                                    <input id="nip" type="text" class="form-control{{ $errors->has('nip') ? ' is-invalid' : '' }}" name="nip" required>

                                    @if ($errors->has('nip'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('nip') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="checkbox-admin" class="col-md-4 col-form-label text-md-right">{{ __('Administrator') }}</label>
                                <div class="col-md-6">
                                    <div class="pretty p-icon p-round p-pulse">
                                        <input id="checkbox-admin" type="checkbox" name="isAdmin">
                                        <div class="state p-primary">
                                            <i class="icon material-icons"></i>
                                            <label></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="checkbox-pmo" class="col-md-4 col-form-label text-md-right">{{ __('Anggota PMO') }}</label>
                                <div class="col-md-6">
                                    <div class="pretty p-icon p-round p-pulse">
                                        <input id="checkbox-pmo" type="checkbox" name="isPMO">
                                        <div class="state p-primary">
                                            <i class="icon material-icons"></i>
                                            <label></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="checkbox-pegawai" class="col-md-4 col-form-label text-md-right">{{ __('Pegawai') }}</label>
                                <div class="col-md-6">
                                    <div class="pretty p-icon p-round p-pulse">
                                        <input name="isPegawai" type="hidden" value="on">
                                        <input id="checkbox-pegawai" type="checkbox" name="dummyIsPegawai" disabled="disabled" checked>
                                        <div class="state p-primary">
                                            <i class="icon material-icons"></i>
                                            <label></label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
