@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('admin.genre.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Название жанра</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   name="title" value="{{ old('title') }}">

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Добавить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
