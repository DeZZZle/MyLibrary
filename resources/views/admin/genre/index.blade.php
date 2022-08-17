@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($data['genre'] as $genre)
                    <div class="card mb-2">
                        <div class="card-header"><a href="{{ route('admin.genre.show', $genre->id) }}">{{ $genre->title }}</a></div>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('admin.genre.create') }}">Добавить новый жанр</a>
        </div>
    </div>
@endsection
