@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('admin.book.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Название</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   name="title" value="{{ old('title') }}">

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Автор</label>

                        <div class="col-md-6">
                            <select class="form-select  @error('author_id') is-invalid @enderror" name="author_id">
                                @foreach($data['authors'] as $author)
                                    <option
                                        value="{{ $author->id }}">{{ $author->firstname }} {{ $author->lastname }}</option>
                                @endforeach
                            </select>
                            @error('author_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                    </div>
                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Автор</label>

                        <div class="col-md-6">
                            <select class="form-select  @error('genre_ids') is-invalid @enderror" multiple name="genre_ids[]">
                                @foreach($data['genres'] as $genre)
                                    <option
                                        value="{{ $genre->id }}">{{ $genre->title }}</option>
                                @endforeach
                            </select>
                            @error('genre_ids')
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
