@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('admin.user.update', $data['user']->id) }}" method="POST" >
                    @csrf
                    @method('PATCH')
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Имя</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ $data['user']->firstname }}" required autocomplete="firstname" autofocus>

                            @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Фамилия</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ $data['user']->lastname }}" required autocomplete="lastname" autofocus>

                            @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>php
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $data['user']->email }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">Пароль</label>

                        <div class="col-md-6">
                            <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="api_token" class="col-md-4 col-form-label text-md-end">Токен</label>

                        <div class="col-md-6">
                            <input id="api_token" type="text" class="form-control @error('api_token') is-invalid @enderror" name="api_token" value="{{ $data['user']->api_token }}">

                            @error('api_token')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Изменить данные пользователя
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
